<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TriPayWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $signature = $request->header('X-Callback-Signature');
        $privateKey = config('services.tripay.private_key');
        
        $rawJson = $request->getContent();
        
        $localSignature = hash_hmac('sha256', $rawJson, $privateKey);

        if (config('app.env') !== 'local' && $signature !== $localSignature) {
            Log::warning('TriPay Webhook Signature Mismatch', [
                'received' => $signature,
                'expected' => $localSignature,
            ]);
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
        }

        $event = $request->header('X-Callback-Event');
        if ($event !== 'payment_status') {
            return response()->json(['success' => false, 'message' => 'Unrecognized event'], 400);
        }

        $payload = json_decode($rawJson, true);
        Log::info('TriPay Webhook Received', $payload);

        $merchantRef = $payload['merchant_ref'] ?? null;
        $status = strtoupper($payload['status'] ?? '');

        if (!$merchantRef) {
            return response()->json(['success' => false, 'message' => 'Missing merchant_ref'], 400);
        }

        $deposit = Deposit::where('external_id', $merchantRef)->first();

        if (!$deposit) {
            Log::warning('Deposit not found for merchant_ref: ' . $merchantRef);
            return response()->json(['success' => false, 'message' => 'Deposit not found'], 404);
        }

        if ($deposit->status !== 'pending') {
            return response()->json(['success' => true, 'message' => 'Deposit already processed'], 200);
        }

        if ($status === 'PAID') {
            DB::transaction(function () use ($deposit) {
                $deposit->status = 'success';
                $deposit->save();

                $user = $deposit->user;
                $user->saldo += $deposit->amount;
                $user->save();

                Log::info('User saldo successfully topped up via TriPay', [
                    'user_id' => $user->id,
                    'amount' => $deposit->amount,
                    'new_saldo' => $user->saldo,
                ]);
            });
        } elseif (in_array($status, ['EXPIRED', 'FAILED'])) {
            $deposit->status = 'failed';
            $deposit->save();
            Log::info('Deposit failed/expired via TriPay', ['merchant_ref' => $merchantRef]);
        }

        return response()->json(['success' => true, 'message' => 'Callback processed successfully'], 200);
    }
}

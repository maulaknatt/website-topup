<?php

namespace App\Filament\User\Resources\DepositResource\Pages;

use App\Filament\User\Resources\DepositResource;
use App\Models\Deposit;
use App\Services\TriPayService;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateDeposit extends CreateRecord
{
    protected static string $resource = DepositResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $deposit = new Deposit();
        $deposit->user_id = auth()->id();
        $deposit->amount = $data['amount'];
        $deposit->payment_method = $data['payment_method'];
        $deposit->status = 'pending';
        $deposit->save();

        $externalId = 'DEP-' . str_pad($deposit->id, 8, '0', STR_PAD_LEFT) . '-' . time();
        
        try {
            $tripay = new TriPayService();
            $transaction = $tripay->createTransaction(
                $deposit->payment_method,
                $externalId,
                $deposit->amount,
                auth()->user()->name,
                auth()->user()->email
            );
            
            $deposit->update([
                'external_id' => $externalId,
                'checkout_url' => $transaction['checkout_url'],
            ]);
            
        } catch (\Exception $e) {
            $deposit->delete();
            throw $e;
        }

        return $deposit;
    }

    protected function getRedirectUrl(): string
    {
        return $this->record->checkout_url;
    }
}

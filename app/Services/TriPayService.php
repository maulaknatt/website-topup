<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TriPayService
{
    protected string $apiKey;
    protected string $privateKey;
    protected string $merchantCode;
    protected bool $isProduction;
    protected string $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.tripay.api_key', '');
        $this->privateKey = config('services.tripay.private_key', '');
        $this->merchantCode = config('services.tripay.merchant_code', '');
        $this->isProduction = (bool) config('services.tripay.is_production', false);
        
        $this->baseUrl = $this->isProduction 
            ? 'https://tripay.co.id/api/transaction/create'
            : 'https://tripay.co.id/api-sandbox/transaction/create';
    }

    public function createTransaction(string $paymentMethod, string $merchantRef, int $amount, string $customerName, string $customerEmail): array
    {
        // Calculate TriPay SHA256 Signature
        // Formula: merchantCode + merchantRef + amount
        $signature = hash_hmac('sha256', $this->merchantCode . $merchantRef . $amount, $this->privateKey);

        $payload = [
            'method' => $paymentMethod,
            'merchant_ref' => $merchantRef,
            'amount' => $amount,
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'order_items' => [
                [
                    'sku' => 'DEPOSIT',
                    'name' => 'Top Up Saldo User',
                    'price' => $amount,
                    'quantity' => 1,
                ]
            ],
            'callback_url' => route('tripay.webhook'),
            'return_url' => route('filament.user.resources.deposits.index'),
            'signature' => $signature,
        ];

        Log::info('TriPay Request Payload', ['url' => $this->baseUrl, 'payload' => $payload]);

        $response = Http::withToken($this->apiKey)
            ->post($this->baseUrl, $payload);

        if ($response->failed()) {
            Log::error('TriPay Transaction Creation Failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \Exception('TriPay API Error: ' . ($response->json('message') ?? $response->body()));
        }

        $responseData = $response->json();
        
        if (!$responseData || !($responseData['success'] ?? false)) {
            Log::error('TriPay API responded with success = false', (array) $responseData);
            throw new \Exception('TriPay API Error: ' . ($responseData['message'] ?? 'Unknown error'));
        }

        return $responseData['data'];
    }
}

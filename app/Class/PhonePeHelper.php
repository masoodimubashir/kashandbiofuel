<?php

namespace App\Class;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\{Http, Log, Session};

class PhonePeHelper
{
    private const ENDPOINTS = [
        // 'TOKEN' => 'https://api-preprod.phonepe.com/apis/pg-sandbox/v1/oauth/token',
        // 'PAYMENT' => 'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/pay',
        // 'STATUS' => 'https://api-preprod.phonepe.com/apis/pg-sandbox/checkout/v2/order/',
        // 'REFUND' => 'https://api-preprod.phonepe.com/apis/pg-sandbox/payments/v2/refund',

        'TOKEN' => 'https://api.phonepe.com/apis/identity-manager/v1/oauth/token',
        'PAYMENT' => 'https://api.phonepe.com/apis/pg/checkout/v2/pay',
        'STATUS' => 'https://api.phonepe.com/apis/pg/checkout/v2/order/',
        'REFUND' => 'https://api.phonepe.com/apis/pg/payments/v2/refund' 
    ];

    

    public function getAccessToken(): string
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded'
            ])->asForm()->post(self::ENDPOINTS['TOKEN'], [
                'client_id' => config('services.phonePe.client_id'),
                'client_version' => 1,
                'client_secret' => config('services.phonePe.client_secret'),
                'grant_type' => 'client_credentials'
            ]);

            $tokenData = $response->json();

            if (!isset($tokenData['access_token'])) {
                throw new Exception('Invalid token response');
            }

            $this->storeTokenInSession($tokenData);
            return $tokenData['access_token'];
        } catch (Exception $e) {
            Log::error('PhonePe Token Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function validateToken(): string
    {
        $expiresAt = Session::get('token_expires_at');
        return (!$expiresAt || Carbon::now()->timestamp >= $expiresAt)
            ? $this->getAccessToken()
            : Session::get('phonepe_token');
    }

    public function makePaymentRequest(string $accessToken, array $payload): array
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'O-Bearer ' . $accessToken
        ])->post(self::ENDPOINTS['PAYMENT'], $payload)->json();
    }

    public function fetchOrderStatus(string $accessToken, string $merchantOrderId): array
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'O-Bearer ' . $accessToken
        ])->get(self::ENDPOINTS['STATUS'] . $merchantOrderId . '/status')->json();
    }

    public function initiateRefundRequest(string $accessToken, array $refundData)
    {
        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'O-Bearer ' . $accessToken
        ])->post(self::ENDPOINTS['REFUND'], $refundData);
    }

    public function fetchRefundStatus(string $accessToken, string $merchantRefundId): array
    {

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'O-Bearer ' . $accessToken
        ])->get(self::ENDPOINTS['REFUND'] . '/' . $merchantRefundId . '/status')->json();
    }

    private function storeTokenInSession(array $tokenData): void
    {
        Session::put([
            'phonepe_token' => $tokenData['access_token'],
            'token_expires_at' => $tokenData['expires_at']
        ]);
    }

    public function formatSuccessResponse(array $data): array
    {
        return array_merge(['status' => true], $data);
    }

    public function formatErrorResponse(string $message, array $data = []): array
    {
        return [
            'status' => false,
            'message' => $message,
            'error' => $data
        ];
    }
}

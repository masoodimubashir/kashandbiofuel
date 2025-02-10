<?php

namespace App\Service;

use App\Models\Order;
use App\Models\Transaction;
use App\Repository\CartRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PhonepeService
{
    private CartRepository $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function checkout($request)
    {
        try {
            $amount = (float)$request->input('total_price');
            $payload = $this->generatePayload($amount);
            $headers = $this->generateHeaders($payload);

            $response = Http::withHeaders($headers)->post(
                'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay',
                ['request' => $payload]
            );

            if ($response->successful()) {
                $responseData = $response->json();

                if (!empty($responseData['data']['instrumentResponse']['redirectInfo']['url'])) {
                    $redirectUrl = $responseData['data']['instrumentResponse']['redirectInfo']['url'];

                    session()->put('merchantTransactionId', $responseData['data']['merchantTransactionId']);
                    $this->makeTransaction($responseData['data']['merchantTransactionId'], $request, 0);

                    return $redirectUrl;
                }

                throw new Exception('Invalid Payment Response from PhonePe.');
            }

            throw new Exception('Payment transaction failed.');
        } catch (Exception $e) {
            Log::error('PhonePe Checkout Error: ' . $e->getMessage());
            throw new HttpException(500, 'An error occurred during checkout: ' . $e->getMessage());
        }
    }

    public function handlePaymentResponse()
    {
        try {

            // Verify the payment status from PhonePe
            $merchantTransactionId = session()->pull('merchantTransactionId');;
            $paymentStatus = $this->verifyPaymentStatus($merchantTransactionId);

            if ($paymentStatus['success']) {
                // Update transaction status to success (1)
                $transaction = Transaction::where('transaction_id', $merchantTransactionId)
                    ->first();

                if (!$transaction) {
                    throw new Exception('Transaction not found');
                }

                $transaction->update(['status' => 1]);

                // Create order and related items
                $order = $this->createOrder($request, $transaction);

                // Clear cart after successful order creation
                $cartItems = $this->getCartItems();
                $this->clearCart($cartItems);

                return [
                    'success' => true,
                    'order' => $order,
                    'message' => 'Payment successful and order created'
                ];
            }

            // Payment failed - transaction status remains 0
            return [
                'success' => false,
                'message' => 'Payment failed'
            ];

        } catch (Exception $e) {
            Log::error('Payment Response Error: ' . $e->getMessage());
            throw new HttpException(500, 'Error processing payment response: ' . $e->getMessage());
        }
    }

    private function verifyPaymentStatus($merchantTransactionId)
    {
        // Add your PhonePe payment status verification logic here
        $endpoint = "/pg/v1/status/{$merchantTransactionId}";
        $saltKey = config('services.phonePe.salt_key');
        $saltIndex = 1;

        $checksum = hash('sha256', $endpoint . $saltKey);
        $xVerify = $checksum . '###' . $saltIndex;

        $response = Http::withHeaders([
            'X-VERIFY' => $xVerify,
            'X-MERCHANT-ID' => config('services.phonePe.merchantId'),
            'Content-Type' => 'application/json',
        ])->get("https://api-preprod.phonepe.com/apis/pg-sandbox{$endpoint}");

        dd($response);

        if ($response->successful()) {
            $data = $response->json();
            return [
                'success' => $data['code'] === 'PAYMENT_SUCCESS',
                'data' => $data
            ];
        }

        return ['success' => false];
    }

    private function makeTransaction($merchantTransactionId, $request, $status = 0)
    {
        return Transaction::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->total_price,
            'status' => $status,
            'payment_method' => $request->input('payment_method'),
            'transaction_id' => $merchantTransactionId,
        ]);
    }

    private function createOrder($request, $transaction)
    {
        $cartItems = $this->getCartItems();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'custom_order_id' => uniqid('cus_'),
            'address_id' => $request->input('address'),
            'total_amount' => $transaction->amount,
            'date_of_purchase' => now(),
            'transaction_id' => $transaction->transaction_id,
            'payment_method' => $transaction->payment_method,
        ]);

        foreach ($cartItems as $item) {
            $order->orderedItems()->create([
                'product_id' => $item->product_id,
                'order_id' => $order->id,
                'quantity' => $item->qty,
                'price' => $item->product->price * $item->qty,
                'date_of_purchase' => now(),
                'custom_order_id' => $order->custom_order_id,
            ]);
        }

        return $order;
    }

    private function generatePayload(float $amount)
    {
        $payload = [
            "merchantId" => config('services.phonePe.merchantId'),
            "merchantTransactionId" => uniqid('txn_'),
            "merchantUserId" => auth()->user()->id,
            "amount" => $amount * 100,
            "redirectUrl" => route('payment.redirect'),
            "callbackUrl" => route('payment.redirect'),
            "mobileNumber" => auth()->user()->address()->first()->phone,
            "paymentInstrument" => [
                "type" => "PAY_PAGE"
            ]
        ];

        return base64_encode(json_encode($payload));
    }

    private function generateHeaders($payload): array
    {
        $endpoint = '/pg/v1/pay';
        $saltKey = config('services.phonePe.salt_key');
        $saltIndex = 1;

        $checksum = hash('sha256', $payload . $endpoint . $saltKey);
        $xVerify = $checksum . '###' . $saltIndex;

        return [
            'X-VERIFY' => $xVerify,
            'Content-Type' => 'application/json',
        ];
    }

    public function getCartItems()
    {
        $values = [
            'user_id' => auth()->user()->id,
            'guest_id' => Cookie::get('guest_id'),
        ];

        return $this->repository->getItems($values);
    }

    private function clearCart($cartItems)
    {
        foreach ($cartItems as $item) {
            $product = $item->product;
            $product->qty -= $item->qty;
            $product->save();

            if ($item->productAttribute) {
                $item->productAttribute->delete();
            }

            $this->repository->deleteItem($item->id);
        }
    }
}

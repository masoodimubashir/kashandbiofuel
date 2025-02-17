<?php

namespace App\Service;

use App\Models\Order;
use Http;

class ShipRocketService
{
    private const TOKEN_CACHE_KEY = 'shiprocket_token';
    private const TOKEN_CACHE_DURATION = 60 * 24;

    public function pushOrder(Order $order): array
    {
        if (!$order->is_confirmed) {
            throw new \Exception('Order must be confirmed before pushing to ShipRocket', 422);
        }

        try {
            $response = Http::withToken($this->getToken())
                ->post(
                    'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
                    $this->prepareOrderData($order)
                );

            if ($response->failed()) {
                throw new \Exception('ShipRocket API request failed: ' . $response->body(), $response->status());
            }

            return [
                'status' => $response->status(),
                'message' => 'Order successfully pushed to ShipRocket',
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode() ?: 500);
        }
    }

    private function getToken(): string
    {
        $response = Http::post(config('services.shiprocket.base_url') . 'auth/login', [
            'email' => config('services.shiprocket.shiprocket_email'),
            'password' => config('services.shiprocket.shiprocket_password'),
        ]);

        if ($response->failed()) {
            throw new \Exception('ShipRocket authentication failed', 401);
        }

        return $response->json()['token'];
    }

    private function prepareOrderData(Order $order): array
    {
        $address = $order->address;

        return [
            'order_id' => $order->custom_order_id,
            'order_date' => now()->format('Y-m-d H:i:s'),
            'billing_customer_name' => $address->user->name,
            'billing_last_name' => '',
            'billing_address' => $address->address,
            'billing_city' => $address->city,
            'billing_pincode' => $address->pin_code,
            'billing_state' => $address->state,
            'billing_country' => 'India',
            'billing_email' => $address->user->email,
            'billing_phone' => $address->phone,
            'shipping_is_billing' => true,
            'order_items' => $this->formatOrderItems($order->orderedItems),
            'payment_method' => $order->payment_method,
            'sub_total' => $order->total_amount,
            'length' => 1,
            'breadth' => 1,
            'height' => 1,
            'weight' => 1,
        ];
    }

    private function formatOrderItems($orderedItems): array
    {
        return $orderedItems->map(fn($item) => [
            'name' => $item->product->name,
            'sku' => $item->product->name,
            'units' => $item->quantity,
            'selling_price' => $item->product->selling_price,
            'discount' => 0,
            'tax' => 0,
            'hsn' => '1',
        ])->toArray();
    }
}

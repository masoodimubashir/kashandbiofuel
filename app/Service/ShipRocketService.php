<?php

namespace App\Service;

use App\Events\OrderShippedEvent;
use App\Models\Order;
use Http;
use Illuminate\Support\Facades\Mail;
use Log;

class ShipRocketService
{
    private const API_BASE_URL = 'https://apiv2.shiprocket.in/v1/external/';
    
    public function pushOrder(Order $order)
    {
        $this->validateOrder($order);
        
        $token = $this->getToken();

        $orderData = $this->prepareOrderData($order);
        
        $response = Http::withToken($token)
            ->post(self::API_BASE_URL . 'orders/create/adhoc', $orderData);
            
        if ($response->failed()) {
            Log::error(''. $response);
            throw new \Exception('ShipRocket API request failed: ' , 422);
        }

        $order->update([
            'is_shipped' => true,
            'order_message' => 'Shipped'
        ]);

        event(new OrderShippedEvent($order));


        return [
            'status' => $response->status(),
            'message' => 'Order successfully pushed to ShipRocket',
            'data' => $response->json()
        ];
    }

    private function validateOrder(Order $order): void 
    {

        if ($order->is_shipped) {
            throw new \Exception('Order Has Been Already Pushed To Ship Rocket', 422);
        }

        if (!$order->is_confirmed) {
            throw new \Exception('Order must be confirmed before pushing to ShipRocket', 422);
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
            'payment_method' => 'Prepaid',
            'sub_total' => $order->total_amount,
            'length' => 1,
            'breadth' => 1,
            'height' => 1,
            'weight' => 1,
        ];
    }

    private function formatOrderItems($orderedItems): array
    {
        return $orderedItems->map(function($item) {
            return [
                'name' => $item->product->name,
                'sku' => $item->id,
                'units' => $item->quantity,
                'selling_price' => $item->product->selling_price,
                'discount' => 0,
                'tax' => 0,
                'hsn' => '1',
            ];
        })->toArray();
    }
}

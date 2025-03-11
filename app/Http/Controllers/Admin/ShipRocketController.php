<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Service\ShipRocketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShipRocketController extends Controller
{

    public function __construct(private ShipRocketService $shipRocketService) {}

    public function pushOrder(Order $order)
    {

        try {


            $response = app(ShipRocketService::class)->pushOrder($order);

            return response()->json([
                'success' => true,
                'message' => $response['message'],
                'data' => $response['data']
            ], $response['status']);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], $e->getCode() ?: 500);
        }
    }

}

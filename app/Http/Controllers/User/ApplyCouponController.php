<?php

namespace App\Http\Controllers\User;

use App\Class\HelperClass;
use App\Http\Controllers\Controller;
use App\Service\ItemService;
use Illuminate\Http\Request;

class ApplyCouponController extends Controller
{

    use HelperClass;

    public function __construct(private ItemService $itemService)
    {
    }


    public function viewCart(Request $request)
    {
        try {
            if ($request->ajax()) {


                [$items, $check_out_price, $discount] = $this->itemService->getItems($request, 'cart');


                return response()->json([
                    'status' => true,
                    'data' => $items,
                    'check_out_price' => $check_out_price,
                    'discount' => $discount,
                ]);

            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.',
            ]);
        }

        return view('frontend.Cart.cart');
    }

}

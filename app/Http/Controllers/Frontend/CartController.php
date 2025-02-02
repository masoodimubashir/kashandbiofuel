<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;
use App\Service\ItemService;
use Illuminate\Http\Request;
use Exception;

class CartController extends Controller
{

    public function __construct(protected ItemService $itemService)
    {
    }

    public function viewCart(Request $request)
    {

        if ($request->ajax()) {


            [$items, $check_out_price] = $this->itemService->getItems($request, 'cart');

            return response()->json([

                'data' => $items,
                'check_out_price' => $check_out_price,

            ]);

        }

        return view('frontend.Cart.cart');
    }


    public function addToCart(CartStoreRequest $request)
    {

        try {


            $this->itemService->addOrUpdateItem($request->validated(), 'cart');

            return response()->json([
                'status' => true,
                'redirect_url' => route('cart.view-cart'),
                'message' => 'Item added to cart successfully'
            ]);


        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }


    }

    public function updateQty(Request $request, $id)
    {
        try {

            $updatedItem = $this->itemService->updateItemQty(
                $id,
                $request->qty,
                'cart'
            );

            return response()->json([
                'status' => true,
                'message' => 'Item updated successfully',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }


    public function removeFromCart(int $id)
    {

        try {

            $item = $this->itemService->findItem($id, 'cart');

            if (!$item) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item cannot Be Deleted.',
                ], 404);
            }

            $this->itemService->removeItem($id, 'cart');


            return response()->json([
                'message' => 'Item removed from cart successfully'
            ]);

        } catch (Exception $e) {

            return response()->json([

                'status' => false,
                'message' => 'Something Went Wrong...',
                'error' => $e->getMessage(),

            ]);
        }
    }


    public function returnToWishlist(Request $request, $id)
    {

        try {

            $item = $this->itemService->findItem($id, 'cart');

            $this->itemService->returnToCart($item, $id, 'cart');

            return response()->json([
                'status' => true,
                'message' => 'Item added to cart successfully'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);

        }

    }


}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;
use App\Service\ItemService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{


    public function __construct(protected ItemService $itemService)
    {
    }

    public function viewWishlist(Request $request)
    {

        if ($request->ajax()) {


            [$items, $check_out_price] = $this->itemService->getItems($request, 'wishlist');

       
            return response()->json([
                'data' => $items,
                'check_out_price' => $check_out_price
            ]);

        }

        return view('frontend.Wishlist.wishlist');
    }


    public function addToWishlist(CartStoreRequest $request)
    {

        try {


            $this->itemService->addOrUpdateItem($request->validated(), 'wishlist');

            return response()->json([
                'status' => true,
                'redirect_url' => route('wishlist.view-wishlist'),
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


    public function returnToCart(Request $request, $id)
    {

        try {

            $item = $this->itemService->findItem($id, 'wishlist');

            $this->itemService->returnToCart($item, $id, 'wishlist');

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


    public function removeFromWishlist(int $id)
    {

        try {

            $item = $this->itemService->findItem($id, 'wishlist');

            if (!$item) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item cannot Be Deleted.',
                ], 404);
            }

            $this->itemService->removeItem($id, 'wishlist');

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


}

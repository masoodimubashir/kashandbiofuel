<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;
use App\Models\Cart;
use App\Models\ProductAttribute;
use App\Models\Wishlist;
use App\Service\ItemService;
use Illuminate\Http\Request;
use Exception;
use Log;

class CartController extends Controller
{

    public function __construct(protected ItemService $itemService) {}

    public function viewCart(Request $request)
    {

        if ($request->ajax()) {

            [$items, $check_out_price, $discount] = $this->itemService->getItems($request, 'cart');

            return response()->json([

                'data' => $items,
                'check_out_price' => $check_out_price,
                'discount' => $discount,

            ]);
        }

        return view('frontend.Cart.cart');
    }


    public function addToCart(CartStoreRequest $request)
    {

        try {


            $product =  Cart::query()
                ->where(function ($query) {
                    if (auth()->check()) {
                        $query->where('user_id', auth()->user()->id);
                    }
                })
                ->orWhere(function ($query) {
                    if (isset($_COOKIE['guest_id']) || session()->has('guest_id')) {
                        $guestId = $_COOKIE['guest_id'] ?? session()->get('guest_id');
                        $query->where('guest_id', $guestId);
                    }
                })
                ->first();

            if ($product) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item already Exists',
                ], 404);
            }


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

            $product_attribute = ProductAttribute::find($request->product_attribute_id);

            if ($product_attribute->qty < $request->qty) {

                return response()->json([
                    'status' => false,
                    'message' => 'We Dont Have enough items in the stock yet',
                ], 404);
            }

            $this->itemService->updateItemQty($id, $request->qty, 'cart');

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

            $wish_list_item = Wishlist::where([
                'product_id' => $request->product_id,
                'product_attribute_id' => $request->product_attribute_id,
            ])->first();


            if ($wish_list_item) {
                return response()->json([
                    'status' => false,
                    'message' => 'Item already Exists',
                ], 404);
            }

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

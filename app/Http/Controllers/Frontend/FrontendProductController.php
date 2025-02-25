<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{


    public function show(string $slug)
    {

        $product = Product::query()
            ->InStock()

            ->with([
                'productAttributes',
                'reviews.user',
            ])
            ->withAvg('reviews', 'rating')
            ->withCount([
                'reviews',
                'reviews as one_star_count' => fn($q) => $q->where('rating', 1),
                'reviews as two_star_count' => fn($q) => $q->where('rating', 2),
                'reviews as three_star_count' => fn($q) => $q->where('rating', 3),
                'reviews as four_star_count' => fn($q) => $q->where('rating', 4),
                'reviews as five_star_count' => fn($q) => $q->where('rating', 5),
            ])
            ->where('slug', $slug)
            ->first();




        // Calculate percentages
        $totalReviews = $product->reviews_count ?? 0;
        $product->star_percentages = [
            5 => $totalReviews ? round(($product->five_star_count / $totalReviews) * 100) : 0,
            4 => $totalReviews ? round(($product->four_star_count / $totalReviews) * 100) : 0,
            3 => $totalReviews ? round(($product->three_star_count / $totalReviews) * 100) : 0,
            2 => $totalReviews ? round(($product->two_star_count / $totalReviews) * 100) : 0,
            1 => $totalReviews ? round(($product->one_star_count / $totalReviews) * 100) : 0,
        ];


        return view('frontend.Product.product-detail', compact('product'));
    }


    public function checkProductQuantity(Request $request, string $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();

            dd($request->input('qty'));

            $requestedQty = $request->input('qty');

            if ($requestedQty > $product->qty) {

                return response()->json([
                    'status' => false,
                    'message' => "Only {$product->qty} items available in stock"
                ], 422);
            }

            if ($requestedQty <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Quantity must be greater than zero'
                ], 422);
            }

            return response()->json([
                'status' => true,
                'message' => 'Product quantity is available',
                'data' => [
                    'requested_qty' => $requestedQty,
                    'available_qty' => $product->qty
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to check product quantity'
            ], 500);
        }
    }
}

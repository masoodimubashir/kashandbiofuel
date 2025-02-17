<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Log;

class CategoryShoppingController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {


            // Build the query
            $query = Product::query()
                ->has('productAttribute')
                ->has('category')
                ->has('subCategory')
                ->with(['productAttribute', 'review', 'category', 'subCategory'])
                ->withAvg('review', 'rating');

            // Apply category filters
            if ($request->has('categories')) {
                $query->whereIn('category_id', $request->categories);
            }

            // Apply subcategory filters
            if ($request->has('subcategories')) {
                $query->whereIn('sub_category_id', $request->subcategories);
            }

            // Apply price range filter
            if ($request->has('price')) {
                [$minPrice, $maxPrice] = explode(';', $request->price);
                $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
            }

            // Apply rating filter
            if ($request->has('rating')) {
                $query->whereHas('review', function ($query) use ($request) {
                    $query->whereIn('rating', $request->rating);
                });
            }

            // Fetch paginated products
            $products = $query->latest()->paginate(20);

            // Return response with the products (this should be a valid response for the AJAX call)
            return response()->json([
                'products' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'next_page_url' => $products->nextPageUrl(),
                    'prev_page_url' => $products->previousPageUrl(),
                ],
                'success' => true,
                'message' => 'Products fetched successfully'
            ]);
        }

        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $reviews = Reviews::latest()->get();

        return view('frontend.Category.category-shopping', compact(
            'categories',
            'subCategories',
            'reviews'
        ));
    }
}

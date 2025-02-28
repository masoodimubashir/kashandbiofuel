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

    public function index(Request $request, $category_id)
    {
        $query = Product::query()
            ->where('category_id', $category_id)
            ->InStock()
            ->has('productAttribute')
            ->has('category')
            ->has('subCategory')
            ->with(['productAttribute', 'review', 'category', 'subCategory'])
            ->withAvg('review', 'rating');

        if ($request->filled('subcategories')) {
            $query->whereIn('sub_category_id', $request->subcategories);
        }

        if ($request->filled('price')) {
            [$minPrice, $maxPrice] = explode(';', $request->price);
            $query->whereBetween('price', [(float)$minPrice, (float)$maxPrice]);
        }

        if ($request->filled('rating')) {
            $query->whereHas('review', function ($q) use ($request) {
                $q->whereIn('rating', $request->rating);
            });
        }

        $products = $query->latest()->paginate(20);

        return view('frontend.Category.category-shopping', [
            'category_id'  => $category_id, // Pass category_id to view
            'categories'   => Category::where('status', 1)->get(),
            'subCategories' => SubCategory::where('status', 1)->get(),
            'products'     => $products,
            'reviews'      => Reviews::latest()->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SubCategory;

class SubCategoryShoppingController extends Controller
{

    public function index(string $slug)
    {

        $products = Product::query()
            ->whereHas('subCategory', fn($query) => $query->where('slug', $slug))
            ->has('productAttribute')
            ->has('category')
            ->has('subCategory')
            ->with(['productAttribute', 'review', 'category', 'subCategory'])
            ->withAvg('review', 'rating')
            ->latest()
            ->paginate(20);

        return view('frontend.Sub-category.sub-category-shopping', compact('products'));

    }
}

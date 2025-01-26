<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class CategoryShoppingController extends Controller
{
    public function index()
    {

        $categories = Category::latest()->get();
        $subCategories = SubCategory::latest()->get();
        $products = Product::with('productAttributes')->latest()->get();
        $reviews = Reviews::latest()->get();

//        dd($reviews);

        return view('frontend.Category.category-shopping', compact(
            'categories',
            'subCategories',
            'products',
            'reviews'
        ));
    }
}

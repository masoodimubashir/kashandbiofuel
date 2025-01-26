<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class FrontendProductController extends Controller
{


    public function show(string $slug)
    {


        $product = Product::query()
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
        $totalReviews = $product->reviews_count;
        $product->star_percentages = [
            5 => $totalReviews ? round(($product->five_star_count / $totalReviews) * 100) : 0,
            4 => $totalReviews ? round(($product->four_star_count / $totalReviews) * 100) : 0,
            3 => $totalReviews ? round(($product->three_star_count / $totalReviews) * 100) : 0,
            2 => $totalReviews ? round(($product->two_star_count / $totalReviews) * 100) : 0,
            1 => $totalReviews ? round(($product->one_star_count / $totalReviews) * 100) : 0,
        ];


        return view('frontend.Product.product-detail', compact('product'));
    }
}

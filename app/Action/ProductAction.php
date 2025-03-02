<?php

namespace App\Action;

use App\Models\Product;

trait ProductAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getProducts()
    {

        return Product::query()
            ->inStock()
            ->has('productAttributes')
            ->with([
                'productAttributes' => fn($attribute) => $attribute->take(1),
                'reviews'
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('status', 1)
            ->select([
                'id',
                'name',
                'slug',
                'selling_price',
                'price'
            ])
            ->latest()
            ->take(10)
            ->get();
    }
}

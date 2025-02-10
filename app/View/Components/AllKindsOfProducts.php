<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AllKindsOfProducts extends Component
{

    public $allProducts;

    public function __construct()
    {
        $this->allProducts = Product::query()
            ->has('productAttributes')
            ->with([
                'productAttributes' => function ($query) {
                    $query->select('product_id', 'image_path')
                        ->take(1);
                },
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

    public function render(): View
    {
        return view('components.all-kinds-of-products');
    }
}

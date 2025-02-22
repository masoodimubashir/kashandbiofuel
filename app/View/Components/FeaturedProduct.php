<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeaturedProduct extends Component
{


    public $featuredProduct;


    public function __construct()
    {
        $this->featuredProduct = Product::query()
            ->inStock()
            ->with([
                'review',
                'productAttribute',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where([
                'status' => 1,
                'featured' => 1
            ])
            ->take(3)
            ->get();
    }

    public function render(): View
    {
        return view('components.featured-product');
    }
}

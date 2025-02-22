<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopRated extends Component
{

    public $topRatedProducts;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $this->topRatedProducts = Product::query()
            ->inStock()
            ->with([
                'review',
                'productAttribute',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('status', 1)
            ->orderByDesc('reviews_avg_rating')
            ->take(3)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top-rated');
    }
}

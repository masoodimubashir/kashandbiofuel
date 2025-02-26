<?php

namespace App\View\Components;

use App\Models\OrderedItem;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopSelling extends Component
{

    public $topSellingProducts;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->topSellingProducts =  Product::query()
            ->inStock()
            ->with([
                'review',
                'productAttribute',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where([
                'status' => 1,
            ])
            ->take(3)
            ->latest()
            ->get();

            
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.top-selling');
    }
}

<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewlyArrived extends Component
{

    public $new_arrivals;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {


        $this->new_arrivals = Product::query()
            ->inStock()
            ->with([
                'review',
                'productAttribute',
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where([
                'status' => 1,
                'new_arrival' => 1
            ])
            ->take(3)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.newly-arrived');
    }
}

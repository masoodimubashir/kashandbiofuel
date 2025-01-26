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
            ->has('productAttributes')
            ->with(['productAttributes' => function ($query) {
                $query->select('product_id', 'image_path')
                    ->take(1);
            }])
            ->select([
                'id',
                'name',
                'slug',
                'selling_price'
            ])
            ->where('new_arrival', 1)
            ->latest()
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

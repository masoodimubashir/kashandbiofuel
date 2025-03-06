<?php

namespace App\View\Components;

use App\Models\Order;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecentOrders extends Component
{

    public $orders;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $this->orders = Order::where([
            'user_id' => auth()->user()->id,
            'is_confirmed' => 1
        ])
        ->get();

        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recent-orders');
    }
}

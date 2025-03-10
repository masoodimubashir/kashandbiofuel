<?php

namespace App\View\Components;

use App\Models\Order;
use App\Models\OrderedItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class UserOrderComponent extends Component
{


    public $orders;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $this->orders = Order::with(['transaction'])
            ->withSum('orderedItems', 'quantity')
            ->where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();

       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-order-component');
    }
}

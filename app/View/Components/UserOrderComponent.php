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


    public $orderedItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->orderedItems = $orders = OrderedItem::query()
            ->with([
                'product' => fn($query) => $query->with('productAttribute'),
            ])
            ->whereHas('order', function ($query) {
                $query->where([
                    'user_id' => Auth::id(),
                    'is_confirmed' => 1,
                    'is_delivered' => 0,
                    'is_cancelled' => 0,
                ]);
            })
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

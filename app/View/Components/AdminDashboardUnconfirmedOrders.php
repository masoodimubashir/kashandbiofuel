<?php

namespace App\View\Components;

use App\Models\OrderedItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDashboardUnconfirmedOrders extends Component
{

    public  $unConfirmedOrders;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->unConfirmedOrders = OrderedItem::query()
        ->with([
            'product' => fn($query) => ($query->with('productAttribute')),
            'order' => fn($query) => ($query->where('is_confirmed', 1))
        ])
        ->whereHas('order', function($query) {
            $query->where([
                'is_confirmed' => 0,
                'is_delivered' => 0,
                'is_cancelled' => 0
            ]);
        })
        ->latest()
        ->take(5)
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard-unconfirmed-orders');
    }
}

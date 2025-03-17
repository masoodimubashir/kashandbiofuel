<?php

namespace App\View\Components;

use App\Models\Order;
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
        $this->unConfirmedOrders = Order::query()
        ->where('is_confirmed', 0)
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

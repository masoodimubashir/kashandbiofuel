<?php

namespace App\View\Components;

use App\Models\OrderedItem;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDashboardTotalOrderComponent extends Component
{

    public $totalOrders;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->totalOrders = OrderedItem::query()
            ->with(['product' => fn($query) => ($query->with('productAttribute')), 'order'])
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard-total-order-component');
    }
}

<?php

namespace App\View\Components;

use App\Models\Order;
use App\Service\DashboardSalesService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminSaleComponent extends Component
{

    public $orders_confirmed;

    public $total_revenue;

    public $daily_orders;

    public $daily_revenue;


    /**
     * Create a new component instance.
     */
    public function __construct(DashboardSalesService $dashboardSalesService)
    {

        $this->orders_confirmed = $dashboardSalesService->getConfirmedOrders();

        $this->total_revenue = $dashboardSalesService->getTotalRevenue();

        $this->daily_orders = $dashboardSalesService->getDailyOrders();

        $this->daily_revenue = $dashboardSalesService->getDailyRevenue();


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-sale-component');
    }
}

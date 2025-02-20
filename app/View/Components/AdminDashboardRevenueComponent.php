<?php

namespace App\View\Components;

use App\Charts\OrderRevenueChart;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminDashboardRevenueComponent extends Component
{

    public $chart;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $orderChart = new OrderRevenueChart();
        $this->chart = $orderChart->makeChart();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-dashboard-revenue-component');
    }
}

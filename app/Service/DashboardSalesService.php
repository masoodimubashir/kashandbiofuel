<?php

namespace App\Service;

use App\Models\Order;

class DashboardSalesService
{

    private $orders;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->orders = Order::query()
            ->latest()
            ->get();
            
    }

    public function getConfirmedOrders()
    {
        return $this->orders
            ->where('is_confirmed', 1)
            ->count();
    }

    public function getTotalRevenue()
    {
        return $this->orders
            ->where('is_confirmed', 1)
            ->sum('total_amount');
    }

    public function getDailyOrders()
    {
        return Order::query()
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->count();
    }


    public function getDailyRevenue()
    {
        return $this->orders
            ->where('is_confirmed', 1)
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->sum('total_amount');
    }


}

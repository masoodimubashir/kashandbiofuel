<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OrderRevenueChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $chart = new OrderRevenueChart();
        $chart->makeChart();

        return view('layouts.dashboard.dashboard', compact('chart'));
    }
}

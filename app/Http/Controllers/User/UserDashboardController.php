<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{

    public function index()
    {

        return view('user.user-dashboard');

    }

    public function store()
    {


    }

    public function trackOrder(){

        $order = Order::with(['transaction', 'address'])->find(9);

        return view('user.track-order', compact('order'));
    }
}

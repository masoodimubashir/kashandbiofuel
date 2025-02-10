<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{


    public function index()
    {

        return view('layouts.dashboard.Checkout.checkout');
    }

}

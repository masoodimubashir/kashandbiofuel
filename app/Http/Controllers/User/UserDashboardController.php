<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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
}

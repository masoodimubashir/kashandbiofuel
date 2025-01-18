<?php

namespace App\Http\Controllers;

use App\Enum\BannerPosition;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $headerBanner = Banner::where('position', BannerPosition::HEADER)->first();

        return view('frontend.home', compact('headerBanner'));
    }

}

<?php

namespace App\Http\Controllers\Frontend;

use App\Enum\BannerPosition;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function index()
    {

        $headerBanner = Banner::where('position', BannerPosition::HEADER)->first();

        return view('frontend.home', compact('headerBanner'));
    }

    public function shipingPolicy(){
        return view('frontend.Miscellaneous.shipping-policy');
    }
}

<div class="banner-slider">
    <div>


        <div class="banner-contain hover-effect">
            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER_BANNER_1->value)->first())
                <img src="{{ asset('storage/' . $banner->image_path ?? null) }}"
                     class="bg-img blur-up lazyload"
                     alt="">
            @endif
            {{-- <div class="banner-details">
                <div class="banner-box">
                    <h6 class="text-danger">5% OFF</h6>
                    <h5>Hot Deals on New Items</h5>
                    <h6 class="text-content">Daily Essentials Eggs & Dairy</h6>
                </div>
                <a href="shop-left-sidebar.html" class="banner-button text-white">Shop Now <i
                        class="fa-solid fa-right-long ms-2"></i></a>
            </div> --}}
        </div>
    </div>

    <div>
        <div class="banner-contain hover-effect">
            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER_BANNER_2->value)->first())
                <img src="{{ asset('storage/' . $banner->image_path ?? null) }}"
                     class="bg-img blur-up lazyload"
                     alt="">
            @endif
            {{-- <div class="banner-details">
                <div class="banner-box">
                    <h6 class="text-danger">5% OFF</h6>
                    <h5>Buy More & Save More</h5>
                    <h6 class="text-content">Fresh Vegetables</h6>
                </div>
                <a href="shop-left-sidebar.html" class="banner-button text-white">Shop Now <i
                        class="fa-solid fa-right-long ms-2"></i></a>
            </div> --}}
        </div>
    </div>

    <div>
        <div class="banner-contain hover-effect">
            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER_BANNER_3->value)->first())
                <img src="{{ asset('storage/' . $banner->image_path ?? null) }}"
                     class="bg-img blur-up lazyload"
                     alt="">
            @endif
            {{-- <div class="banner-details">
                <div class="banner-box">
                    <h6 class="text-danger">5% OFF</h6>
                    <h5>Organic Meat Prepared</h5>
                    <h6 class="text-content">Delivered to Your Home</h6>
                </div>
                <a href="shop-left-sidebar.html" class="banner-button text-white">Shop Now <i
                        class="fa-solid fa-right-long ms-2"></i></a>
            </div> --}}
        </div>
    </div>

    <div>
        <div class="banner-contain hover-effect">
            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER_BANNER_4->value)->first())
                <img src="{{ asset('storage/' . $banner->image_path ?? null) }}"
                     class="bg-img blur-up lazyload"
                     alt="">
            @endif
            {{-- <div class="banner-details">
                <div class="banner-box">
                    <h6 class="text-danger">5% OFF</h6>
                    <h5>Buy More & Save More</h5>
                    <h6 class="text-content">Nuts & Snacks</h6>
                </div>
                <a href="shop-left-sidebar.html" class="banner-button text-white">Shop Now <i
                        class="fa-solid fa-right-long ms-2"></i></a>
            </div> --}}
        </div>
    </div>
</div>

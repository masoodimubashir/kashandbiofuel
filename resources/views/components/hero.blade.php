<div class="row g-4">
    <div class="col-xl-9 col-lg-8">
        <div class="home-contain h-100">


            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::HEADER->value)->first())
                <img src="{{ asset('storage/' . $banner->image_path ?? null) }}"
                     class="bg-img blur-up lazyload"
                     alt="">
            @endif


            <div class="home-detail p-center-left w-75 position-relative mend-auto">
                <div>
                    <h6>Exclusive offer <span>30% Off</span></h6>
                    <h1 class="w-75 text-uppercase poster-1">Stay home & delivered your <span
                            class="daily">Daily Needs</span></h1>
                    <p class="w-58 d-none d-sm-block">Many organizations have issued official
                        statements encouraging people to reduce their intake of sugary drinks.</p>
                    <button onclick="location.href = 'shop-left-sidebar.html';"
                            class="btn btn-animation mt-xxl-4 mt-2 home-button mend-auto">Shop Now <i
                            class="fa-solid fa-right-long ms-2 icon"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none ratio_156">
        <div class="home-contain h-100">


            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER->value)->first())
                <img src="{{ asset('storage/' . $banner->image_path) }}"/>
            @endif
            <div class="home-detail p-top-left home-p-sm w-75">
                <div>
                    <h2 class="mt-0 text-danger">45% <span class="discount text-title">OFF</span>
                    </h2>
                    <h3 class="theme-color">Real Refreshment</h3>
                    <h5 class="text-content">Only this week, Don't miss..</h5>
                    <a href="shop-left-sidebar.html" class="shop-button">Shop Now <i
                            class="fa-solid fa-right-long ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

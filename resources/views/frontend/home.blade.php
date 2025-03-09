@extends('welcome')

@section('main')
    <!-- Home Section Start -->
    <section class="home-section pt-2">
        <div class="container-fluid-lg">
            <x-hero />
        </div>
    </section>
    <!-- Home Section End -->



    <!-- Category Section Start -->
    <section class="category-section-2">
        <x-shop-by-category />
    </section>
    <!-- Category Section End -->

    <!-- Banner Section Start -->

    
    <section class="banner-section ratio_60 wow fadeInUp">
        <div class="container-fluid-lg">
            <x-hot-deals />
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    <section>
        <div class="container-fluid-lg">
            <x-all-kinds-of-products />
        </div>
    </section>
    <!-- Product Section End -->


    <!-- Banner Section Start -->
    <section>
        <div class="container-fluid-lg">
            {{-- <x-limit-time-offer /> --}}
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Top Selling Section Start -->

    <section class="top-selling-section mb-4">
        <div class="container-fluid-lg">
            <div class="slider-4-1">

                <x-top-selling />

                <x-top-rated />

                <x-newly-arrived />

                <x-featured-product />

            </div>
        </div>
    </section>


    <!-- coupon Section Start -->
    {{-- <section>
        <div class="container-fluid-lg" style="margin-bottom: 10px;">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain hover-effect">
                        @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::FEATURED->value)->first())
                            <img src="{{ asset('storage/' . $banner->image_path ?? null) }}" class="bg-img blur-up lazyload"
                                alt="">
                        @endif
                        <div class="banner-details p-center p-sm-4 p-3 text-white text-center">
                            <div>
                                <h3 class="lh-base fw-bold text-white">
                                    Get $3 Cashback! Min Order of $30
                                </h3>
                                <h6 class="coupon-code code-2">Use Code : GROCERY1920</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Discount Section End -->

   
@endsection

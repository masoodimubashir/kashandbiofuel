@extends('welcome')

@section('main')

    <!-- Home Section Start -->
    <section class="home-section pt-2">
        <div class="container-fluid-lg">
            <x-hero/>
        </div>
    </section>
    <!-- Home Section End -->

    <!-- Category Section Start -->
    <section class="category-section-2">
        <x-shop-by-category/>
    </section>
    <!-- Category Section End -->

    <!-- Banner Section Start -->
    <section class="banner-section ratio_60 wow fadeInUp">
        <div class="container-fluid-lg">
            <x-hot-deals/>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Start -->
    <section>
        <div class="container-fluid-lg">
            {{--   All Kinds Of Products Start--}}
            <x-all-kinds-of-products/>
            {{--  All Kinds Of Products End--}}
        </div>
    </section>
    <!-- Product Section End -->


    <!-- Banner Section Start -->
    <section>
        <div class="container-fluid-lg">
            <x-limit-time-offer/>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Top Selling Section Start -->

    <section class="top-selling-section">
        <div class="container-fluid-lg">
            <div class="slider-4-1">

                <x-top-selling/>

                <x-top-rated/>

                <x-newly-arrived/>

                <x-featured-product/>

            </div>
        </div>
    </section>


    <!-- Top Selling Section End -->


    <!-- Blog Section Start -->
    {{--    <section>--}}
    {{--        <div class="container-fluid-lg">--}}
    {{--                        <x-featured-blog/>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- Blog Section End -->

    <!-- Newsletter Section Start -->
    <!-- <section class="newsletter-section section-b-space">
                            <div class="container-fluid-lg">
                                <div class="newsletter-box newsletter-box-2">
                                    <div class="newsletter-contain py-5">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                                    <div class="newsletter-detail">
                                                        <h2>Join our newsletter and get...</h2>
                                                        <h5>$20 discount for your first order</h5>
                                                        <div class="input-box">
                                                            <input type="email" class="form-control" id="exampleFormControlInput1"
                                                                placeholder="Enter Your Email">
                                                            <i class="fa-solid fa-envelope arrow"></i>
                                                            <button class="sub-btn  btn-animation">
                                                                <span class="d-sm-block d-none">Subscribe</span>
                                                                <i class="fa-solid fa-arrow-right icon"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section> -->
    <!-- Newsletter Section End -->

    <!-- coupon Section Start -->
    <section>
        <div class="container-fluid-lg" style="margin-bottom: 10px;">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain hover-effect">
                        @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::SLIDER_BANNER_3->value)->first())
                            <img src="{{ asset('storage/' . $banner->image_path ?? null) }}"
                                 class="bg-img blur-up lazyload"
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
    </section>
    <!-- Discount Section End -->
@endsection

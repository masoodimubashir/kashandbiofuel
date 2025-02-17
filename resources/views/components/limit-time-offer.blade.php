<div class="row">
    <div class="col-12">
        <div class="home-contain hover-effect">
            @if ($banner = App\Models\Banner::where('position', App\Enum\BannerPosition::LIMITED_OFFERS->value)->first())
                <img src="{{asset('storage/' . $banner->image_path ?? null )}}" class="bg-img blur-up lazyload" alt="">
            @endif
            <div class="home-detail p-center position-relative text-center">
                <div>
                    <h3 class="text-danger text-uppercase fw-bold mb-0">
                        limited Time Offer
                    </h3>
                    <h2 class="theme-color text-pacifico fw-normal mb-0 super-sale text-center">
                        Super
                    </h2>
                    <h2 class="home-name text-uppercase">sale</h2>
                    <h3 class="text-pacifico fw-normal text-content text-center">
                        www.fastkart.com
                    </h3>
                    <ul class="social-icon">
                        <li>
                            <a href="https://www.instagram.com/">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>

                        <li>
                            <a href="https://www.facebook.com/">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>

                        <li>
                            <a href="https://twitter.com/">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>

                        <li>
                            <a href="https://www.whatsapp.com/">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

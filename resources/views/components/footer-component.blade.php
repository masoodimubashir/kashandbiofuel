    <footer class="section-t-space">

        <div class="container-fluid-lg">
            <div class="main-footer section-b-space section-t-space">
                <div class="row g-md-4 g-3">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-logo">
                            <div class="theme-logo">
                                <a href="index.html">
                                    <img src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}"
                                        class="blur-up lazyload" alt="">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Categories</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>

                                @if (isset($navigations))
                                    @foreach ($navigations as $navigation)
                                        <li>
                                            <a href="{{ route('category.index', $navigation) }}"
                                                class="text-content">{{ $navigation->name }}</a>
                                        </li>
                                    @endforeach
                                @else
                                @endif


                            </ul>
                        </div>
                    </div>

                    <div class="col-xl col-lg-2 col-sm-3">
                        <div class="footer-title">
                            <h4>Useful Links</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}" class="text-content">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('wishlist.view-wishlist') }}" class="text-content">Shop</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact-us.index') }}" class="text-content">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-2 col-sm-3">
                        <div class="footer-title">
                            <h4>Help Center</h4>
                        </div>

                        <div class="footer-contain">
                            <ul>
                                <li>
                                    <a href="{{ route('user.dashboard') }}" class="text-content">Your Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('user.dashboard') }}" class="text-content">Your Account</a>
                                </li>
                                <li>
                                    <a href="{{ route('user.dashboard') }}" class="text-content">Track Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('ship.policy') }}" class="text-content">Return & Refund Policy</a>
                                </li>
                                <li>
                                    <a href="{{ route('terms.and.conditions') }}" class="text-content">Terms &
                                        Condition</a>
                                </li>
                                <li>
                                    <a href="{{ route('privacy.policy') }}" class="text-content">Privacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="footer-title">
                            <h4>Contact Us</h4>
                        </div>

                        <div class="footer-contact">
                            <ul>
                                <li>
                                    <div class="footer-number">
                                        <i data-feather="phone"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Hotline 24/7 :</h6>
                                            <a href="tel:+918881042340">+918881042340</a>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="footer-number">
                                        <i data-feather="mail"></i>
                                        <div class="contact-number">
                                            <h6 class="text-content">Email Address :</h6>
                                            <a href="mailto:kasshandbiofuels@gmail.com"> kasshandbiofuels@gmail.com</a>
                                        </div>
                                    </div>
                                </li>

                                <li class="social-app mb-0">
                                    <h5 class="mb-2 text-content">Download App :</h5>
                                    <ul>
                                        <li class="mb-0">
                                            <a href="https://play.google.com/store/apps" target="_blank">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/playstore.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li class="mb-0">
                                            <a href="https://www.apple.com/in/app-store/" target="_blank">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/appstore.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content">©2022 Developed By Digifista</h6>
                </div>

                <div class="payment">
                    <img src="../assets/images/payment/1.png" class="blur-up lazyload" alt="">
                </div>

                <div class="social-link">
                    <h6 class="text-content">Stay connected :</h6>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://in.pinterest.com/" target="_blank">
                                <i class="fa-brands fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

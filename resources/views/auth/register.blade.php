<x-guest-layout>

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart pb-4">
        <ul>
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <span>
                        <i data-feather="home"></i>

                        {{-- Home --}}
                    </span>
                </a>
            </li>

            <li class="{{ request()->routeIs('wishlist.view-wishlist') ? 'active' : '' }}">
                <a href="{{ route('wishlist.view-wishlist') }}" class="notifi-wishlist">

                    <span>
                        <i data-feather="heart"></i>
                        {{-- My Wish --}}
                    </span>
                </a>
            </li>

            <li class="{{ request()->routeIs('cart.view-cart') ? 'active' : '' }}">

                <a href="{{ route('cart.view-cart') }}" class="fly-cate">
                    <span>
                        <i data-feather="shopping-cart"></i>

                        {{-- Cart --}}
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->



    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Sign In</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Sign In</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- log in section start -->
    <section class="log-in-section section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-6 col-xl-5 col-lg-6 d-lg-block d-none ms-auto">
                    <div class="image-contain">
                        <img src="{{ asset('front/assets/images/inner-page/sign-up.png') }}" class="img-fluid"
                            alt="">
                    </div>
                </div>

                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h4>Create New Account</h4>
                        </div>

                        <div class="input-box">

                            <form class="row g-4" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input class="form-control" id="fullname" type="text" name="name"
                                            value="{{ old('name') }}" placeholder="Full Name">
                                        <label for="fullname">Full Name</label>
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                </div>
                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input class="form-control" id="email" type="email" name="email"
                                            value="{{ old('email') }}" placeholder="Email Address">
                                        <label for="email">Email Address</label>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input class="form-control" id="password" type="password" name="password"
                                            placeholder="Password">
                                        <label for="password">Password</label>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-floating theme-form-floating">
                                        <input class="form-control" id="password_confirmation" type="password"
                                            name="password_confirmation" placeholder="Password">
                                        <label for="password_confirmation">Confirm Password</label>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox"
                                                id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">I agree with
                                                <span>Terms</span> and <span>Privacy</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="btn btn-animation w-100" type="submit">
                                        {{ __('Register') }}

                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="other-log-in">
                            <h6>or</h6>
                        </div>


                        <div class="other-log-in">
                            <h6></h6>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{ url('/login') }}">Log In</a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-6 col-lg-6"></div>
            </div>
        </div>
    </section>
    <!-- log in section end -->



</x-guest-layout>

<div class="top-nav top-header sticky-header">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="navbar-top">
                    <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                            data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                           <span class="navbar-toggler-icon">
                               <i class="fa-solid fa-bars"></i>
                           </span>
                    </button>
                    <a href="{{ url('/') }}" class="web-logo nav-logo">
                        <img src="{{ asset('front/assets/images/logo/kassh & biofuels (1) (1).png') }}"
                             class="img-fluid blur-up lazyload" alt="">
                    </a>

                    <div class="middle-box">

                        <div class="search-box">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="I'm searching for...">
                                <button class="btn" type="button" id="button-addon2">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="rightside-box">
                        <div class="search-full">
                            <div class="input-group">
                                   <span class="input-group-text">
                                       <i data-feather="search" class="font-light"></i>
                                   </span>
                                <input type="text" class="form-control search-type" placeholder="Search here..">
                                <span class="input-group-text close-search">
                                       <i data-feather="x" class="font-light"></i>
                                   </span>
                            </div>
                        </div>
                        <ul class="right-side-menu">
                            <li class="right-side">
                                <div class="delivery-login-box">
                                    <div class="delivery-icon">
                                        <div class="search-box">
                                            <i data-feather="search"></i>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="right-side">
                                <a href="{{ route('contact-us.index') }}" class="delivery-login-box">
                                    <div class="delivery-icon">
                                        <i data-feather="phone-call"></i>
                                    </div>
                                    <div class="delivery-detail">
                                        <h6>24/7 Delivery</h6>
                                        <h5>+91 888 104 2340</h5>
                                    </div>
                                </a>
                            </li>
                            <li class="right-side">
                                <a href="{{route('wishlist.index')}}" class="btn p-0 position-relative header-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                            <li class="right-side">
                                <div class="onhover-dropdown header-badge">
                                    <button type="button" class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="shopping-cart"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge">2
                                               <span class="visually-hidden">unread messages</span>
                                           </span>
                                    </button>

                                    <div class="onhover-div">
                                        <ul class="cart-list">
                                            <li class="product-box-contain">
                                                <div class="drop-cart">
                                                    <a href="product-left-thumbnail.html" class="drop-image">
                                                        <img
                                                            src="{{ asset('front/assets/images/vegetable/Product/1.png') }}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="drop-contain">
                                                        <a href="product-left-thumbnail.html">
                                                            <h5>Fantasy Crunchy Choco Chip Cookies</h5>
                                                        </a>
                                                        <h6><span>1 x</span> $80.58</h6>
                                                        <button class="close-button close_button">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="product-box-contain">
                                                <div class="drop-cart">
                                                    <a href="product-left-thumbnail.html" class="drop-image">
                                                        <img
                                                            src="{{ asset('front/assets/images/vegetable/Product/2.png') }}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="drop-contain">
                                                        <a href="product-left-thumbnail.html">
                                                            <h5>Peanut Butter Bite Premium Butter Cookies 600 g
                                                            </h5>
                                                        </a>
                                                        <h6><span>1 x</span> $25.68</h6>
                                                        <button class="close-button close_button">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>

                                        <div class="price-box">
                                            <h5>Total :</h5>
                                            <h4 class="theme-color fw-bold">$106.58</h4>
                                        </div>

                                        <div class="button-group">
                                            <a href="{{route('cart.index')}}" class="btn btn-sm cart-button">View
                                                Cart</a>
                                            <a href="{{route('checkout.index')}}"
                                               class="btn btn-sm cart-button theme-bg-color
                                                text-white">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="right-side onhover-dropdown">

                                @auth
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>{{ auth()->user()->name }},</h6>
                                            <h5>{{ auth()->user()->email }}</h5>
                                        </div>
                                    </div>
                                @else
                                    <div class="delivery-login-box">
                                        <div class="delivery-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                        <div class="delivery-detail">
                                            <h6>Hello,</h6>
                                            <h5>My Account</h5>
                                        </div>
                                    </div>
                                @endauth


                                <div class="onhover-div onhover-div-login">
                                    @auth
                                        <ul class="user-box-name">

                                            @role('admin')
                                            <li class="product-box-contain">
                                                @role('admin')
                                                <a href="{{ route('admin.dashboard') }}">
                                                    Dashboard
                                                </a>
                                                @endrole
                                            </li>
                                            @endrole

                                            @role('user')
                                            <li class="product-box-contain">
                                                <a href="{{ route('user.dashboard') }}">
                                                    Dashboard
                                                </a>
                                            </li>
                                            @endrole

                                            <li class="product-box-contain">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <a href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                                                         this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    @else
                                        <ul class="user-box-name">
                                            <li class="product-box-contain">
                                                <i></i>
                                                <a href="{{ route('login') }}">Log In</a>
                                            </li>
                                            @if (Route::has('register'))
                                                <li class="product-box-contain">
                                                    <a href="{{ route('register') }}">Register</a>
                                                </li>
                                            @endif

                                            <li class="product-box-contain">
                                                <a href="{{ route('password.request') }}">Forgot Password</a>
                                            </li>
                                        </ul>
                                    @endauth
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

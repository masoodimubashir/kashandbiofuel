<div class="modal-dialog modal-fullscreen-sm-down">
</div>

@php
    $items = \App\Models\Cart::where('user_id', auth()->id())->count();
@endphp

<style>
    .search-popup {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        height: 500px;
        width: 700px
        overflow-y: auto;
        border: 1px solid #red;

    }

    .popup-content {
        padding: 15px;
    }

    .product-result {
        padding: 10px;
        border-bottom: 1px solid #eee;
        transition: background 0.2s;
    }

    .product-result:hover {
        background: #f8f9fa;
    }

    .product-result a {
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .product-result h4 {
        margin: 0;
        font-size: 16px;
        color: #333;
    }

    .product-result p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666;
    }
</style>



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

                    <!-- In your Blade view (frontend.home) -->

                    <div class="middle-box">
                        <div class="search-box">
                            <form class="input-group" action="{{ route('home') }}" method="GET">
                                <input type="search" name="search" class="form-control"
                                    placeholder="I'm searching for..." id="search-input">
                                <button class="btn" type="submit" id="button-addon2">
                                    <i data-feather="search"></i>
                                </button>
                            </form>
                        </div>

                        <div id="live-search-results" class="search-results">
                            <!-- The search results will be dynamically inserted here -->
                        </div>
                    </div>

                    <!-- Add Ajax Script for Live Search -->




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
                                <a href="{{ route('wishlist.view-wishlist') }}"
                                    class="btn p-0 position-relative header-wishlist">
                                    <i data-feather="heart"></i>
                                </a>
                            </li>
                            <li class="right-side">
                                <div class="onhover-dropdown header-badge">
                                    <a href="{{ route('cart.view-cart') }}" type="button"
                                        class="btn p-0 position-relative header-wishlist">
                                        <i data-feather="shopping-cart"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge">
                                            {{ $items }}

                                            <span class="visually-hidden">unread messages</span>
                                        </span>
                                    </a>
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

@push('frontend.scripts')
    <script>
        $(document).ready(function() {


            $('<div id="search-popup" class="search-popup"></div>').insertAfter('#search-input');

            $('#search-input').on('input', function(event) {

                event.preventDefault();

                var query = $(this).val();

                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('live.search') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            var resultsHtml = '<div class="popup-content">';

                            if (data.length > 0) {
                                data.forEach(function(product) {
                                    resultsHtml += `
                                <div class="product-result">
                                    <a href="/product/${product.slug}">
                                        <h4>${product.name}</h4>
                                        <p>${product.description}</p>
                                    </a>
                                </div>
                            `;
                                });
                            } else {
                                resultsHtml += '<p>No results found.</p>';
                            }

                            resultsHtml += '</div>';
                            $('#search-popup').html(resultsHtml).show();
                        },
                        error: function(xhr, status, error) {
                            console.log("Error: " + error);
                        }
                    });
                } else {
                    $('#search-popup').hide();
                }
            });

            // Close popup when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-input, #search-popup').length) {
                    $('#search-popup').hide();
                }
            });
        });
    </script>
@endpush

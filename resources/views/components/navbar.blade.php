@php
    $items = \App\Models\Cart::checkCartItems()->count();
@endphp


<style>
    .search-box {
        position: relative;
    }

    .search-results-container {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: white;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin-top: 5px;
    }

    #search-results {
        max-height: 400px;
        overflow-y: auto;
        padding: 10px;
    }

    .search-results-container {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: white;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin-top: 5px;
        display: none;
    }

    .product-result {
        transition: all 0.2s ease;
    }

    .product-result:hover {
        background-color: #f9f9f9;
    }

    .product-image {
        border-radius: 4px;
        overflow: hidden;
    }

    .price-info {
        font-size: 0.9rem;
    }

    .total-price {
        font-size: 0.95rem;
        color: #333;
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
                            <div class="search-results-container">
                                <div id="search-results"></div>
                            </div>
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
                                        <h5>9560221309|7005432898</h5>
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

            $('#search-input').on('input', function() {
                var query = $(this).val().trim();
                var $searchResults = $('#search-results');

                if (query.length >= 3) {
                    $.ajax({
                        url: "{{ route('live.search') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        beforeSend: function() {
                            // Show loading indicator
                            $searchResults.html(
                                '<div class="text-center p-3"><div class="spinner-border text-primary" role="status"></div></div>'
                            ).show();
                        },
                        success: function(data) {
                            var resultsHtml = '';

                            if (data.length > 0) {
                                data.forEach(function(product) {
                                    // Calculate total price
                                    const sellingPrice = parseFloat(product
                                        .selling_price) || 0;
                                    const gstAmount = parseFloat(product.gst_amount) ||
                                        0;
                                    const totalPrice = (sellingPrice + gstAmount)
                                        .toFixed(2);

                                    // Get first image if available
                                    const productImage = product.product_attribute
                                        ?.images ?
                                        (Array.isArray(product.product_attribute
                                                .images) ?
                                            product.product_attribute.images[0] :
                                            product.product_attribute.images) :
                                        null;

                                    resultsHtml += `
                            <div class="product-result d-flex align-items-start p-3 border-bottom">
                                <div class="flex-shrink-0 me-3">
                                    <a href="/product/${product.slug}">
                                       ${productImage ? 
                                            `<img src="${productImage}" alt="${product.name}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">` : 
                                            `<div class="img-thumbnail d-flex align-items-center justify-content-center bg-light" style="width: 80px; height: 80px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>`
                                        }
                                    </a>
                                </div>
                                <div class="flex-grow-1">
                                    <a href="/product/${product.slug}" class="text-decoration-none text-dark">
                                        <h6 class="mb-1">${product.name}</h6>
                                    </a>
                                    <div class="price-section mt-2">
                                        <span class="selling-price fw-bold">₹${sellingPrice.toFixed(2)}</span>
                                        ${gstAmount > 0 ? `<span class="text-muted small ms-2">+ GST: ₹${gstAmount.toFixed(2)}</span>` : ''}
                                        <div class="total-price mt-1">
                                            <small class="text-muted">Total: </small>
                                            <span class="fw-bold text-primary">₹${totalPrice}</span>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        `;
                                });
                            } else {
                                resultsHtml =
                                    '<div class="p-3 text-center text-muted">No products found matching your search</div>';
                            }

                            $searchResults.html(resultsHtml).show();
                        },
                        error: function(xhr) {
                            $searchResults.html(
                                '<div class="p-3 text-center text-danger">Error loading search results</div>'
                            ).show();
                        }
                    });
                } else {
                    $searchResults.hide();
                }
            });

            // Close search results when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-input, #search-results').length) {
                    $('#search-results').hide();
                }
            });

            // Additional: Keyboard navigation for search results
            $('#search-input').on('keydown', function(e) {
                if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                    e.preventDefault();
                    const $results = $('#search-results .product-result');
                    if ($results.length > 0) {
                        const $current = $results.filter('.active');
                        let $next;

                        if (e.key === 'ArrowDown') {
                            $next = $current.length ? $current.next() : $results.first();
                        } else {
                            $next = $current.length ? $current.prev() : $results.last();
                        }

                        $results.removeClass('active');
                        $next.addClass('active').find('a')[0].focus();
                    }
                } else if (e.key === 'Enter') {
                    const $active = $('#search-results .product-result.active');
                    if ($active.length) {
                        window.location.href = $active.find('a').attr('href');
                    }
                }
            });


        });

        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var query = $(this).val();

                if (query.length >= 3) {
                    $('.search-results-container').show();
                    // Rest of your AJAX code
                } else {
                    $('.search-results-container').hide();
                }
            });

            // Hide on click outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.search-box').length) {
                    $('.search-results-container').hide();
                }
            });
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-box').length) {
                $('#search-results').hide();
            }
        });
    </script>
@endpush

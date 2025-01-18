<!DOCTYPE html>
<html e>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif --}}

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link id="color-link" rel="stylesheet" type="text/css" href=" {{ asset('front/assets/css/style.css') }}">
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/v4-shims.min.js"
        integrity="sha512-Ny27nj/CA4kOUa/2b2bhjr8YiJ+OfttH2314Wg8drWh4z9JqGO1PVEqPvo/kM+PjN5UEY4gFxo+ADkhXoGiaSg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    @stack('styles')

</head>

<body class="bg-effect">



    <header class="pb-md-4 pb-0">

        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <i class="iconly-Location icli text-white"></i>
                            <span class="text-white">1418 Riverwood Drive, CA 96052, US</span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">
                                <div>
                                    <div class="timer-notification">
                                        <h6><strong class="me-1">Welcome to Fastkart!</strong>Wrap new offers/gift
                                            every single day on Weekends.<strong class="ms-1">New Coupon Code: Fast024
                                            </strong>

                                        </h6>
                                    </div>
                                </div>

                                <div>
                                    <div class="timer-notification">
                                        <h6>Something you love is now on sale!
                                            <a href="shop-left-sidebar.html" class="text-white">Buy Now
                                                !</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-language"
                                        data-bs-toggle="dropdown">
                                        <img src="../assets/images/country/united-states.png"
                                            class="img-fluid blur-up lazyload" alt="">
                                        <span>English</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="english">
                                                <img src="../assets/images/country/united-kingdom.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="france">
                                                <img src="../assets/images/country/germany.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>Germany</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0)" id="chinese">
                                                <img src="../assets/images/country/turkish.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                                <span>Turki</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <button class="btn dropdown-toggle" type="button" id="select-dollar"
                                        data-bs-toggle="dropdown">
                                        <span>USD</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end sm-dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="aud" href="javascript:void(0)">AUD</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="eur" href="javascript:void(0)">EUR</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="cny" href="javascript:void(0)">CNY</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('components.navbar')

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">


                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>Menu</h5>
                                        <button class="btn-close lead" type="button"
                                            data-bs-dismiss="offcanvas"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Pages</a>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('home') }}">Home</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-2.html">Sweetshop</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-3.html">Organic</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-4.html">Supershop</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-5.html">Classic shop</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-6.html">Furniture</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-7.html">Search
                                                            Oriented</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-8.html">Category
                                                            Focus</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-9.html">Fashion</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="index-10.html">Book</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('contact-us.index') }}">Contact Us</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Shop</a>

                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="shop-category-slider.html">Shop
                                                            Category Slider</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-category.html">Shop
                                                            Category Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-banner.html">Shop
                                                            Banner</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-left-sidebar.html">Shop
                                                            Left
                                                            Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-right-sidebar.html">Shop
                                                            Right Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="shop-top-filter.html">Shop Top
                                                            Filter</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Product</a>

                                                <div class="dropdown-menu dropdown-menu-3 dropdown-menu-2">
                                                    <div class="row">
                                                        <div class="col-xl-3">
                                                            <div class="dropdown-column m-0">
                                                                <h5 class="dropdown-header">
                                                                    Product Pages </h5>
                                                                <a class="dropdown-item"
                                                                    href="product-left-thumbnail.html">Product
                                                                    Thumbnail</a>
                                                                <a class="dropdown-item"
                                                                    href="product-4-image.html">Product
                                                                    Images</a>
                                                                <a class="dropdown-item"
                                                                    href="product-slider.html">Product
                                                                    Slider</a>
                                                                <a class="dropdown-item"
                                                                    href="product-sticky.html">Product
                                                                    Sticky</a>
                                                                <a class="dropdown-item"
                                                                    href="product-accordion.html">Product
                                                                    Accordion</a>
                                                                <a class="dropdown-item"
                                                                    href="product-circle.html">Product
                                                                    Tab</a>
                                                                <a class="dropdown-item"
                                                                    href="product-digital.html">Product
                                                                    Digital</a>

                                                                <h5 class="custom-mt dropdown-header">Product Features
                                                                </h5>
                                                                <a class="dropdown-item"
                                                                    href="product-circle.html">Bundle
                                                                    (Cross Sale)</a>
                                                                <a class="dropdown-item"
                                                                    href="product-left-thumbnail.html">Hot
                                                                    Stock
                                                                    Progress <label class="menu-label">New</label>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="product-sold-out.html">SOLD
                                                                    OUT</a>
                                                                <a class="dropdown-item" href="product-circle.html">
                                                                    Sale Countdown</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <div class="dropdown-column m-0">
                                                                <h5 class="dropdown-header">
                                                                    Product Variants Style </h5>
                                                                <a class="dropdown-item"
                                                                    href="product-rectangle.html">Variant
                                                                    Rectangle</a>
                                                                <a class="dropdown-item"
                                                                    href="product-circle.html">Variant
                                                                    Circle <label class="menu-label">New</label></a>
                                                                <a class="dropdown-item"
                                                                    href="product-color-image.html">Variant Image
                                                                    Swatch</a>
                                                                <a class="dropdown-item"
                                                                    href="product-color.html">Variant
                                                                    Color</a>
                                                                <a class="dropdown-item"
                                                                    href="product-radio.html">Variant
                                                                    Radio Button</a>
                                                                <a class="dropdown-item"
                                                                    href="product-dropdown.html">Variant
                                                                    Dropdown</a>
                                                                <h5 class="custom-mt dropdown-header">Product Features
                                                                </h5>
                                                                <a class="dropdown-item"
                                                                    href="product-left-thumbnail.html">Sticky
                                                                    Checkout</a>
                                                                <a class="dropdown-item"
                                                                    href="product-dynamic.html">Dynamic
                                                                    Checkout</a>
                                                                <a class="dropdown-item"
                                                                    href="product-sticky.html">Secure
                                                                    Checkout</a>
                                                                <a class="dropdown-item"
                                                                    href="product-bundle.html">Active
                                                                    Product view</a>
                                                                <a class="dropdown-item" href="product-bundle.html">
                                                                    Active
                                                                    Last Orders
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3">
                                                            <div class="dropdown-column m-0">
                                                                <h5 class="dropdown-header">
                                                                    Product Features </h5>
                                                                <a class="dropdown-item"
                                                                    href="product-image.html">Product
                                                                    Simple</a>
                                                                <a class="dropdown-item"
                                                                    href="product-rectangle.html">
                                                                    Product Classified <label
                                                                        class="menu-label">New</label>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="product-size-chart.html">Size
                                                                    Chart <label class="menu-label">New</label></a>
                                                                <a class="dropdown-item"
                                                                    href="product-size-chart.html">Delivery &
                                                                    Return</a>
                                                                <a class="dropdown-item"
                                                                    href="product-size-chart.html">Product Review</a>
                                                                <a class="dropdown-item"
                                                                    href="product-expert.html">Ask
                                                                    an Expert</a>
                                                                <h5 class="custom-mt dropdown-header">Product Features
                                                                </h5>
                                                                <a class="dropdown-item"
                                                                    href="product-bottom-thumbnail.html">Product
                                                                    Tags</a>
                                                                <a class="dropdown-item"
                                                                    href="product-image.html">Store
                                                                    Information</a>
                                                                <a class="dropdown-item"
                                                                    href="product-image.html">Social
                                                                    Share <label
                                                                        class="menu-label warning-label">Hot</label>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="product-left-thumbnail.html">Related Products
                                                                    <label class="menu-label warning-label">Hot</label>
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="product-right-thumbnail.html">Wishlist &
                                                                    Compare</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-3 d-xl-block d-none">
                                                            <div class="dropdown-column m-0">
                                                                <div class="menu-img-banner">
                                                                    <a class="text-title" href="product-circle.html">
                                                                        <img src="../assets/images/mega-menu.png"
                                                                            alt="banner">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="nav-item dropdown dropdown-mega">
                                                <a class="nav-link dropdown-toggle ps-xl-2 ps-0"
                                                    href="javascript:void(0)" data-bs-toggle="dropdown">Mega Menu</a>

                                                <div class="dropdown-menu dropdown-menu-2">
                                                    <div class="row">
                                                        <div class="dropdown-column col-xl-3">
                                                            <h5 class="dropdown-header">Daily Vegetables</h5>
                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Beans
                                                                & Brinjals</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Broccoli &
                                                                Cauliflower</a>

                                                            <a href="shop-left-sidebar.html"
                                                                class="dropdown-item">Chilies,
                                                                Garlic</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Vegetables
                                                                & Salads</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Gourd,
                                                                Cucumber</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Herbs
                                                                & Sprouts</a>

                                                            <a href="demo-personal-portfolio.html"
                                                                class="dropdown-item">Lettuce & Leafy</a>
                                                        </div>

                                                        <div class="dropdown-column col-xl-3">
                                                            <h5 class="dropdown-header">Baby Tender</h5>
                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Beans
                                                                & Brinjals</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Broccoli &
                                                                Cauliflower</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Chilies,
                                                                Garlic</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Vegetables
                                                                & Salads</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Gourd,
                                                                Cucumber</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Potatoes &
                                                                Tomatoes</a>

                                                            <a href="shop-left-sidebar.html"
                                                                class="dropdown-item">Peas
                                                                & Corn</a>
                                                        </div>

                                                        <div class="dropdown-column col-xl-3">
                                                            <h5 class="dropdown-header">Exotic Vegetables</h5>
                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Asparagus &
                                                                Artichokes</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Avocados &
                                                                Peppers</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Broccoli &
                                                                Zucchini</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Celery,
                                                                Fennel &
                                                                Leeks</a>

                                                            <a class="dropdown-item"
                                                                href="shop-left-sidebar.html">Chilies &
                                                                Lime</a>
                                                        </div>

                                                        <div class="dropdown-column dropdown-column-img col-3"></div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Blog</a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="blog-detail.html">Blog
                                                            Detail</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="blog-grid.html">Blog Grid</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="blog-list.html">Blog List</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown new-nav-item">
                                                <label class="new-dropdown">New</label>
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Pages</a>
                                                <ul class="dropdown-menu">
                                                    <li class="sub-dropdown-hover">
                                                        <a class="dropdown-item" href="javascript:void(0)">Email
                                                            Template <span class="new-text"><i
                                                                    class="fa-solid fa-bolt-lightning"></i></span></a>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/email-templete/abandonment-email.html">Abandonment</a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/email-templete/offer-template.html">Offer
                                                                    Template</a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/email-templete/order-success.html">Order
                                                                    Success</a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/email-templete/reset-password.html">Reset
                                                                    Password</a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/email-templete/welcome.html">Welcome
                                                                    template</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li class="sub-dropdown-hover">
                                                        <a class="dropdown-item" href="javascript:void(0)">Invoice
                                                            Template <span class="new-text"><i
                                                                    class="fa-solid fa-bolt-lightning"></i></span></a>
                                                        <ul class="sub-menu">
                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/invoice/invoice-1.html">Invoice
                                                                    1</a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/invoice/invoice-2.html">Invoice
                                                                    2</a>
                                                            </li>

                                                            <li>
                                                                <a
                                                                    href="https://themes.pixelstrap.com/fastkart/invoice/invoice-3.html">Invoice
                                                                    3</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="404.html">404</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="about-us.html">About Us</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="cart.html">Cart</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="contact-us.html">Contact</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="checkout.html">Checkout</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="coming-soon.html">Coming
                                                            Soon</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="compare.html">Compare</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="faq.html">Faq</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="order-success.html">Order
                                                            Success</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="order-tracking.html">Order
                                                            Tracking</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="otp.html">OTP</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="search.html">Search</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="user-dashboard.html">User
                                                            Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="wishlist.html">Wishlist</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                    data-bs-toggle="dropdown">Seller</a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="seller-become.html">Become a
                                                            Seller</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="seller-dashboard.html">Seller
                                                            Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="seller-detail.html">Seller
                                                            Detail</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="seller-detail-2.html">Seller
                                                            Detail 2</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="seller-grid.html">Seller
                                                            Grid</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="seller-grid-2.html">Seller Grid
                                                            2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- Header Start -->



    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="index.html">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="search.html" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="wishlist.html" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li>
                <a href="cart.html">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->

    {{--  Main Section Start  --}}

    @yield('main')

    {{-- Main Section End  --}}

    <!-- Footer Section Start -->
    @include('components.footer')
    <!-- Footer Section End -->

    <!-- Quick View Modal Box Start -->
    <div class="modal fade theme-modal view-modal" id="view" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-sm-4 g-2">
                        <div class="col-lg-6">
                            <div class="slider-image">
                                <img src="../assets/images/product/category/1.jpg" class="img-fluid blur-up lazyload"
                                    alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">Peanut Butter Bite Premium Butter Cookies 600 g</h4>
                                <h4 class="price">$36.99</h4>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span class="ms-2">8 Reviews</span>
                                    <span class="ms-2 text-danger">6 sold in last 16 hours</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>Candy canes sugar plum tart cotton candy chupa chups sugar plum chocolate I love.
                                        Caramels marshmallow icing dessert candy canes I love soufflé I love toffee.
                                        Marshmallow pie sweet sweet roll sesame snaps tiramisu jelly bear claw. Bonbon
                                        muffin I love carrot cake sugar plum dessert bonbon.</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>Black Forest</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>W0690034</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Type:</h5>
                                            <h6>White Cream Cake</h6>
                                        </div>
                                    </li>
                                </ul>

                                <div class="select-size">
                                    <h4>Cake Size :</h4>
                                    <select class="form-select select-form-size">
                                        <option selected>Select Size</option>
                                        <option value="1.2">1/2 KG</option>
                                        <option value="0">1 KG</option>
                                        <option value="1.5">1/5 KG</option>
                                        <option value="red">Red Roses</option>
                                        <option value="pink">With Pink Roses</option>
                                    </select>
                                </div>

                                <div class="modal-button">
                                    <button onclick="location.href = 'cart.html';"
                                        class="btn btn-md add-cart-button icon">Add
                                        To Cart</button>
                                    <button onclick="location.href = 'product-left.html';"
                                        class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                        View More Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Box End -->

    <!-- Location Modal Start -->
    <div class="modal location-modal fade theme-modal" id="locationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Choose your Delivery Location</h5>
                    <p class="mt-1 text-content">Enter your address and we will specify the offer for your area.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="location-list">
                        <div class="search-input">
                            <input type="search" class="form-control" placeholder="Search Your Area">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <div class="disabled-box">
                            <h6>Select a Location</h6>
                        </div>

                        <ul class="location-select custom-height">
                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Alabama</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Arizona</h6>
                                    <span>Min: $150</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>California</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Colorado</h6>
                                    <span>Min: $140</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Florida</h6>
                                    <span>Min: $160</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Georgia</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Kansas</h6>
                                    <span>Min: $170</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Minnesota</h6>
                                    <span>Min: $120</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>New York</h6>
                                    <span>Min: $110</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <h6>Washington</h6>
                                    <span>Min: $130</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Modal End -->

    <!-- Cookie Bar Box Start -->
    <div class="cookie-bar-box">
        <div class="cookie-box">
            <div class="cookie-image">
                <img src="../assets/images/cookie-bar.png" class="blur-up lazyload" alt="">
                <h2>Cookies!</h2>
            </div>

            <div class="cookie-contain">
                <h5 class="text-content">We use cookies to make your experience better</h5>
            </div>
        </div>

        <div class="button-group">
            <button class="btn privacy-button">Privacy Policy</button>
            <button class="btn ok-button">OK</button>
        </div>
    </div>
    <!-- Cookie Bar Box End -->

    <!-- Deal Box Modal Start -->
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title w-100" id="deal_today">Deal Today</h5>
                        <p class="mt-1 text-content">Recommended deals for you.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/10.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-2">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/11.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-3">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/12.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>

                            <li class="list-1">
                                <div class="deal-offer-contain">
                                    <a href="shop-left-sidebar.html" class="deal-image">
                                        <img src="../assets/images/vegetable/product/13.png" class="blur-up lazyload"
                                            alt="">
                                    </a>

                                    <a href="shop-left-sidebar.html" class="deal-contain">
                                        <h5>Blended Instant Coffee 50 g Buy 1 Get 1 Free</h5>
                                        <h6>$52.57 <del>57.62</del> <span>500 G</span></h6>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Box Modal End -->

    <!-- Tap to top and theme setting button start -->
    <!-- <div class="theme-option">
        <div class="setting-box">
            <button class="btn setting-button">
                <i class="fa-solid fa-gear"></i>
            </button>

            <div class="theme-setting-2">
                <div class="theme-box">
                    <ul>
                        <li>
                            <div class="setting-name">
                                <h4>Color</h4>
                            </div>
                            <div class="theme-setting-button color-picker">
                                <form class="form-control">
                                    <label for="colorPick" class="form-label mb-0">Theme Color</label>
                                    <input type="color" class="form-control form-control-color" id="colorPick"
                                        value="#0da487" title="Choose your color">
                                </form>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>Dark</h4>
                            </div>
                            <div class="theme-setting-button">
                                <button class="btn btn-2 outline" id="darkButton">Dark</button>
                                <button class="btn btn-2 unline" id="lightButton">Light</button>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>RTL</h4>
                            </div>
                            <div class="theme-setting-button rtl">
                                <button class="btn btn-2 rtl-unline">LTR</button>
                                <button class="btn btn-2 rtl-outline">RTL</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div> -->
    <!-- Tap to top and theme setting button end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('front/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('front/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('front/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('front/assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('front/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('front/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('front/assets/js/auto-height.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('front/assets/js/timer1.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('front/assets/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('front/assets/js/quantity-2.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('front/assets/js/script.js') }}"></script>

    <!-- theme setting js -->
    <script src="{{ asset('front/assets/js/theme-setting.js') }}"></script>

    @stack('scripts')
</body>

</html>

<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/vendors/animate.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href=" {{ asset('front/assets/css/style.css') }}">


    <!-- Template css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- Nouislider Css --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/nouislider@15.6.0/dist/nouislider.min.css"
          rel="stylesheet"> --}}

    {{--    <!-- Styles / Scripts --> --}}
    {{--    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))) --}}
    {{--        @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    {{--    @else --}}
    {{--    @endif --}}

    <!-- Google font -->
    {{--
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"> --}}


    {{--    @stack('styles')--}}

</head>


{{--rgba(119,10,15,255)--}}





{{--#729822--}}
<body class="bg-effect">


<!-- Header Start -->

<header class="pb-md-4 pb-0">

    {{--    <x-header-top/>--}}

    <x-navbar/>

    <x-navigation/>


</header>

<!-- Header End -->

<!-- mobile fix menu start -->
<div class="mobile-menu d-md-none d-block mobile-cart">
    <ul>
        <li class="active">
            <a href="{{ route('home') }}">
                <i class="iconly-Home icli"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="mobile-category">
            <a href="{{ route('category.index') }}" class="js-link">
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
            <a href="{{ route('wishlist.view-wishlist') }}" class="notifi-wishlist">
                <i class="iconly-Heart icli"></i>
                <span>My Wish</span>
            </a>
        </li>

        <li>
            <a href="{{ route('cart.view-cart') }}" class="fly-cate">
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
<x-footer/>
<!-- Footer Section End -->


<!-- Tap to top and theme setting button start -->
{{-- <div class="theme-option">
    <div class="back-to-top">
        <a id="back-to-top" href="#">
            <i class="fas fa-chevron-up fs-4"></i>
        </a>
    </div>
</div> --}}
<!-- Tap to top and theme setting button end -->

{{-- <!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End --> --}}

<!-- latest jquery-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
{{--<script src="{{ asset('front/assets/js/fly-Cart.js') }}"></script>--}}

<!-- Quantity js -->
<script src="{{ asset('front/assets/js/quantity-2.js') }}"></script>

<!-- WOW js -->
<script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('front/assets/js/custom-wow.js') }}"></script>

<!-- script js -->
<script src="{{ asset('front/assets/js/script.js') }}"></script>

<!-- theme setting js -->
{{--<script src="{{ asset('front/assets/js/theme-setting.js') }}"></script>--}}

{{-- Noui Slider --}}
{{--<script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.0/dist/nouislider.min.js"></script>--}}


<!-- Price Range Js -->
<script src="{{ asset('front/assets/js/ion.rangeSlider.min.js') }}"></script>

<!-- Quantity js -->
<script src="{{ asset('front/assets/js/quantity-2.js') }}"></script>

<!-- sidebar open js -->
<script src="{{ asset('front/assets/js/filter-sidebar.js') }}"></script>

<!-- Quantity js -->
<script src="{{ asset('front/assets/js/quantity-2.js') }}"></script>

<!-- Zoom Js -->
<script src="{{ asset('front/assets/js/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('front/assets/js/zoom-filter.js') }}"></script>


@stack('frontend.scripts')
</body>

</html>

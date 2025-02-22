<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="../assets/images/favicon/1.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/vendors/bootstrap.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>

<body>

<!-- Loader Start -->
<div class="fullpage-loader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<!-- Loader End -->

<!-- Header Start -->


   


    <header class="pb-md-4 pb-0">

        {{--    <x-header-top/> --}}

        <x-navbar/>

        <x-navigation/>


    </header>

<!-- Header End -->

{{ $slot }}

<!-- Tap to top and theme setting button start -->
<div class="theme-option">
   
    <div class="back-to-top">
        <a id="back-to-top" href="#">
            <i class="fas fa-chevron-up"></i>
        </a>
    </div>

</div>
<!-- Tap to top and theme setting button end -->

<!-- Bg overlay Start -->
<div class="bg-overlay"></div>
<!-- Bg overlay End -->

<!-- latest jquery-->
<script src="{{ asset('front/assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ asset('front/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap/popper.min.js') }}"></script>

<!-- feather icon js-->
<script src="{{ asset('front/assets/js/feather/feather.min.js') }}"></script>
<script src="{{ asset('front/assets/js/feather/feather-icon.js') }}"></script>

<!-- Slick js-->
<script src="{{ asset('front/assets/js/slick/slick.js') }}"></script>
<script src="{{ asset('front/assets/js/slick/slick-animation.min.js') }}"></script>
<script src="{{ asset('front/assets/js/slick/custom_slick.js') }}"></script>

<!-- Lazyload Js -->
<script src="{{ asset('front/assets/js/lazysizes.min.js') }}"></script>

<!-- script js -->
<script src="{{ asset('front/assets/js/script.js') }}"></script>

<!-- theme setting js -->
<script src="{{ asset('front/assets/js/theme-setting.js') }}"></script>
</body>

</html>

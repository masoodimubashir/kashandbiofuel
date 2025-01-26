<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from admin.pixelstrap.net/kabul/template/dashboard-02.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Dec 2024 10:29:33 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Google font-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/font-awesome.css') }}"> --}}
    <!-- ico-font-->

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/icofont.css') }}"> --}}

    <!-- Themify icon-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/themify.css') }}"> --}}

    <!-- Flag icon-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/flag-icon.css') }}"> --}}

    <!-- Feather icon-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/feather-icon.css') }}"> --}}

    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/scrollbar.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/datatables.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/vector-map.css') }}"> --}}

    <!-- Plugins css Ends-->





    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/bootstrap.css') }}">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/style.css') }}">
    {{-- <link id="color" rel="stylesheet" href="{{ asset('dashboard/assets/css/color-1.css') }}" media="screen"> --}}

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/responsive.css') }}">


    <link href="https://cdn.datatables.net/2.2.0/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/colreorder/2.0.4/css/colReorder.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/datetime/1.5.5/css/dataTables.dateTime.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedcolumns/5.0.4/css/fixedColumns.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/keytable/2.12.1/css/keyTable.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowgroup/1.5.1/css/rowGroup.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/searchbuilder/1.8.1/css/searchBuilder.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/searchpanes/2.3.3/css/searchPanes.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/3.0.0/css/select.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/staterestore/1.4.1/css/stateRestore.bootstrap5.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- include summernote css/js-->

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    {{-- DropZone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />


    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">


    {{-- Filepond --}}
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">


    {{-- Dropzone --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">


</head>

<body>

    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="snippet" data-title="dot-floating">
                <div class="stage">
                    <div class="dot-floating"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- loader ends-->

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper modern-type" id="pageWrapper">

        <!-- Page Header Start-->
        @include('components.dashboard.header')
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('components.dashboard.sidebar')
            <!-- Page Sidebar Ends-->


            <div class="page-body">

                <!-- Container-fluid starts-->
                @if (isset($header))
                    <div class="container-fluid">
                        <div class="page-title">
                            {{ $header }}
                        </div>
                    </div>
                @endif
                <!-- Container-fluid Ends-->


                {{-- main section starts  --}}
                <main>
                    {{ $slot }}
                </main>
                {{-- main section ends --}}

            </div>

            <!-- footer start-->
            @include('components.dashboard.footer')

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- latest jquery-->
    {{-- <script src="{{ asset('dashboard/assets/js/jquery.min.js') }}"></script> --}}
    <!-- Bootstrap js-->
    {{-- <script src="{{ asset('dashboard/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script> --}}
    <!-- feather icon js-->
    {{-- <script src="{{ asset('dashboard/assets/js/icons/feather-icon/feather.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/icons/feather-icon/feather-icon.js') }}"></script> --}}
    <!-- scrollbar js-->
    <script src="{{ asset('dashboard/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    {{-- <script src="{{ asset('dashboard/assets/js/config.js') }}"></script> --}}
    <!-- Plugins JS start-->
    {{-- <script src="{{ asset('dashboard/assets/js/chart/apex-chart/apex-chart.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/chart/apex-chart/stock-prices.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/clipboard/clipboard.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/custom-card/custom-card.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-au-mill.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-in-mill.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/typeahead/handlebars.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/typeahead/typeahead.bundle.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/typeahead/typeahead.custom.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/vector-map/map-vector.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/dashboard/dashboard_2.js') }}"></script> --}}
    {{-- <script src="{{ asset('dashboard/assets/js/height-equal.js') }}"></script> --}}
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <!-- Plugin used-->




    <script src="{{ asset('dashboard/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('dashboard/assets/js/sidebar-pin.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/assets/js/theme-customizer/customizer.js') }}"></script> --}}

    <script src="{{ asset('dashboard/assets/js/script.js') }}"></script>

    <script src="{{ asset('dashboard/assets/js/animation/wow/wow.min.js') }}"></script>

    <script>
        new WOW().init();
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/2.2.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.7.0/js/autoFill.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.js"></script>
    <script src="https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.5/js/dataTables.dateTime.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/5.0.4/js/dataTables.fixedColumns.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
    <script src="https://cdn.datatables.net/keytable/2.12.1/js/dataTables.keyTable.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.5.1/js/dataTables.rowGroup.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.8.1/js/dataTables.searchBuilder.js"></script>
    <script src="https://cdn.datatables.net/searchbuilder/1.8.1/js/searchBuilder.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.3/js/dataTables.searchPanes.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/2.3.3/js/searchPanes.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/select/3.0.0/js/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/staterestore/1.4.1/js/dataTables.stateRestore.js"></script>
    <script src="https://cdn.datatables.net/staterestore/1.4.1/js/stateRestore.bootstrap5.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    {{-- DropZone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <!-- Add these in your layout file before your scripts -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>

    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>


    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>


    @stack('dashboard.script')

</body>

<!-- Mirrored from admin.pixelstrap.net/kabul/template/dashboard-02.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 29 Dec 2024 10:29:40 GMT -->

</html>

<x-app-layout>

    <style>
        .fixed-image {
            width: 500px;
            /* Set your desired width */
            height: 400px;
            /* Set your desired height */
            object-fit: cover;
            /* Ensures the image covers the area without distortion */
            object-position: center;
            /* Centers the image within the fixed dimensions */
        }

        .fixed-thumbnail {
            width: 100px;
            /* Set your desired width for thumbnails */
            height: 80px;
            /* Set your desired height for thumbnails */
            object-fit: cover;
            /* Ensures the image covers the area without distortion */
            object-position: center;
            /* Centers the image within the fixed dimensions */
        }

        /* Responsive fixed dimensions for main carousel images */
        .fixed-image {
            width: 100%;
            /* Full width of the container */
            height: 300px;
            /* Fixed height */
            object-fit: cover;
            object-position: center;
        }

        /* Responsive fixed dimensions for thumbnail images */
        .fixed-thumbnail {
            width: 100%;
            /* Full width of the container */
            height: 80px;
            /* Fixed height */
            object-fit: cover;
            object-position: center;
        }

        @media (max-width: 768px) {
            .fixed-image {
                height: 200px;
                /* Adjust height for smaller screens */
            }

            .fixed-thumbnail {
                height: 60px;
                /* Adjust height for smaller screens */
            }
        }
    </style>

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>View Product</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i data-feather="home"></i>
                        </a>
                    </li>

                    <li class="breadcrumb-item {{ Request::routeIs('products.index') }}">
                        <a href="{{ route('products.index') }}">
                            Products
                        </a>
                    </li>

                    <li class="breadcrumb-item {{ Request::routeIs('products.show', $product->id) ? 'active' : '' }}">
                        {{ $product->name }}</li>

                </ol>
            </div>
        </div>
    </x-slot>


    <div class="container-fluid">
        <div>
            <div class="row product-page-main p-0">
                <div class="col-xxl-4 col-md-6 box-col-6">
                    <div class="card">
                        <!-- Main Image Carousel -->
                        <div class="card-body">
                            <!-- Main Carousel -->
                            <div class="product-slider owl-carousel owl-theme" id="sync1">
                                @foreach ($product->productAttributes as $attribute)
                                    @foreach (json_decode($attribute->images) as $image)
                                        <div class="item" data-hex-code="{{ $attribute->hex_code }}">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Product Image"
                                                class="img-fluid fixed-image">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>

                            <!-- Thumbnail Navigation -->
                            <div class="owl-carousel owl-theme mt-3" id="sync2">
                                @foreach ($product->productAttributes as $attribute)
                                    @foreach (json_decode($attribute->images) as $image)
                                        <div class="item" data-hex-code="{{ $attribute->hex_code }}">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Product Image"
                                                class="img-fluid fixed-thumbnail">
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-xxl-5 box-col-6 order-xxl-0 order-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-page-details">
                                <h3 class="f-w-600">{{ $product->name }}</h3>
                            </div>
                            <div class="product-price">{{ Number::currency($product->selling_price) }}
                                <del>{{ Number::currency($product->price) }} </del>
                            </div>

                            <!-- Color Selection -->
                            <ul class="product-color">
                                @foreach ($product->productAttributes as $attribute)
                                    <li class="color-swatch" data-hex-code="{{ $attribute->hex_code }}"
                                        style="background-color: {{ $attribute->hex_code }}"
                                        onclick="filterImages('{{ $attribute->hex_code }}')">
                                    </li>
                                @endforeach
                            </ul>

                            <hr>
                            <div>
                                <table class="product-page-width">
                                    <tbody>
                                        <tr>
                                            <td><b>Category &nbsp;&nbsp;&nbsp;:</b></td>
                                            <td>{{ $product->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Sub Category &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                            <td class="txt-success">{{ $product->subCategory->name }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>SKU &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                            <td>{{ $product->sku }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Quantity &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                            <td>{{ $product->qty }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Quantity &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                            <td>{{ number_format($product->gst_amount) }}%</td>

                                        </tr>
                                        <tr>
                                            <td><b>Carfted Date &nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;&nbsp;</b></td>
                                            <td>{{ $product->crafted_date }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="row gy-1">
                                <div class="col-md-4">
                                    <h5 class="f-w-600 product-title">share it</h5>
                                </div>
                                <div class="col-md-8">
                                    <div class="product-icon">
                                        <ul class="product-social">
                                            <li class="d-inline-block">
                                                <a href="https://www.facebook.com/" target="_blank"><i
                                                        class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li class="d-inline-block"><a href="https://accounts.google.com/"
                                                    target="_blank"><i class="fa-brands fa-google-plus"></i></a></li>
                                            <li class="d-inline-block"><a href="https://twitter.com/" target="_blank"><i
                                                        class="fa-brands fa-twitter"></i></a></li>
                                            <li class="d-inline-block"><a href="https://www.instagram.com/"
                                                    target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="m-t-15 btn-showcase">
                                <a class="btn btn-success" href="{{ route('products.edit', $product->id) }}"
                                    title="">
                                    <i class="fa-solid fa-pen-to-square me-1"></i>
                                    Edit Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-6 box-col-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="collection-filter-block">
                                <ul class="pro-services">
                                    <li>
                                        <div class="d-flex"><i data-feather="truck"></i>
                                            <div class="flex-grow-1">
                                                <h5 class="fw-bold">Meta Title</h5>
                                                <p>{{ $product->meta_title }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex"><i data-feather="clock"></i>
                                            <div class="flex-grow-1">
                                                <h5 class="fw-bold">Meta keyword</h5>
                                                <p>{{ $product->meta_keyword }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex"><i data-feather="gift"></i>
                                            <div class="flex-grow-1">
                                                <h5 class="fw-bold">Meta Description</h5>
                                                <p>{{ $product->meta_description }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex"><i data-feather="gift"></i>
                                            <div class="flex-grow-1">
                                                <p>
                                                <ul>
                                                    {{ $product->featured ? 'Featured' : '' }}
                                                    <br>
                                                    {{ $product->discounted ? 'Discounted' : '' }}
                                                    <br>
                                                    {{ $product->new_arrival ? 'New Arrival' : '' }}

                                                </ul>

                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <!-- silde-bar colleps block end here-->
                    </div>


                </div>


            </div>
        </div>
        <div class="card">
            <div class="row product-page-main">
                <div class="col-sm-12">
                    <ul class="nav nav-pills nav-primary mb-0" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="contact-top-tab" data-bs-toggle="tab"
                                href="#top-contact" role="tab" aria-controls="top-contact"
                                aria-selected="true">Short Description</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link " id="top-home-tab" data-bs-toggle="tab"
                                href="#top-home" role="tab" aria-controls="top-home"
                                aria-selected="false">Description</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab"
                                href="#top-profile" role="tab" aria-controls="top-profile"
                                aria-selected="false">Addtional Description</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content" id="top-tabContent">
                        <div class="tab-pane fade active show" id="top-contact" role="tabpanel"
                            aria-labelledby="contact-top-tab">
                            <p class="mb-0 m-t-20">
                                {!! $product->short_description !!}
                            </p>
                        </div>
                        <div class="tab-pane fade" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <p class="mb-0 m-t-20">
                                {!! $product->description !!}
                            </p>
                            <p class="mb-0 m-t-20">
                            </p>
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel"
                            aria-labelledby="profile-top-tab">
                            <p class="mb-0 m-t-20">

                                {!! $product->additional_description !!}

                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('dashboard.script')
        <script>
            $(document).ready(function() {
                var sync1 = $("#sync1");
                var sync2 = $("#sync2");
                var slidesPerPage = 4; // Number of thumbnails per page

                sync1.owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: true,
                    autoplay: false,
                    dots: false,
                    loop: true,
                    responsiveRefreshRate: 200,
                    navText: [
                        '<i class="fa fa-chevron-left"></i>',
                        '<i class="fa fa-chevron-right"></i>'
                    ],
                }).on('changed.owl.carousel', syncPosition);

                sync2.on('initialized.owl.carousel', function() {
                    sync2.find(".owl-item").eq(0).addClass("current");
                }).owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    nav: false,
                    margin: 10,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: slidesPerPage,
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', syncPosition2);

                function syncPosition(el) {
                    var count = el.item.count - 1;
                    var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                    if (current < 0) {
                        current = count;
                    }
                    if (current > count) {
                        current = 0;
                    }

                    sync2
                        .find(".owl-item")
                        .removeClass("current")
                        .eq(current)
                        .addClass("current");
                    var onscreen = sync2.find('.owl-item.active').length - 1;
                    var start = sync2.find('.owl-item.active').first().index();
                    var end = sync2.find('.owl-item.active').last().index();

                    if (current > end) {
                        sync2.data('owl.carousel').to(current, 100, true);
                    }
                    if (current < start) {
                        sync2.data('owl.carousel').to(current - onscreen, 100, true);
                    }
                }

                function syncPosition2(el) {
                    if (syncedSecondary) {
                        var number = el.item.index;
                        sync1.data('owl.carousel').to(number, 100, true);
                    }
                }

                sync2.on("click", ".owl-item", function(e) {
                    e.preventDefault();
                    var number = $(this).index();
                    sync1.data('owl.carousel').to(number, 300, true);
                });
            });
            
        </script>
    @endpush

   

</x-app-layout>

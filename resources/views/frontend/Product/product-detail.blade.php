@extends('welcome')

@section('main')

    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse; /* Display stars right-to-left */
            justify-content: flex-start;
        }

        .star-rating input {
            display: none; /* Hide the radio buttons */
        }

        .star-rating label {
            font-size: 2rem; /* Adjust size of the stars */
            color: lightgray; /* Default color of stars */
            cursor: pointer; /* Pointer cursor for selection */
        }

        .star-rating input:checked ~ label {
            color: gold; /* Highlight selected stars */
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold; /* Highlight stars on hover */
        }
    </style>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{$product->name}}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{route('home')}}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{$product->name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-sm-4 g-2">
                                    <div class="col-12">
                                        <div class="product-main no-arrow">

                                            @foreach($product->productAttributes as $product_attribute)
                                                <div>
                                                    <div class="slider-image">
                                                        <img
                                                            src="{{asset('storage/' . $product_attribute->image_path)}}"
                                                            id="img-1"
                                                            data-zoom-image="{{asset('storage/' . $product_attribute->image_path)}}"
                                                            class="
                                                        img-fluid image_zoom_cls-0 blur-up lazyload" alt="">
                                                    </div>
                                                </div>

                                            @endforeach


                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="left-slider-image left-slider no-arrow slick-top">

                                            @foreach($product->productAttributes as $product_attribute)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img
                                                            src="{{asset('storage/' . $product_attribute->image_path)}}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>

                                            @endforeach


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp">
                            <div class="right-box-contain">
                                <h6 class="offer-top">30% Off</h6>
                                <h2 class="name">{{$product->name}}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">{{$product->selling_price}}
                                        <del class="text-content">
                                            {{$product->price}}
                                        </del>
                                        <span
                                            class="offer theme-color">(8% off)</span></h3>
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">

                                            @for($i = 0; $i < round($product->reviews_avg_rating); $i++)

                                                <li>
                                                    <i data-feather="star"
                                                       class="{{$i <= round($product->reviews_avg_rating) ? 'fill' : 'star'}}"></i>
                                                </li>
                                            @endfor


                                        </ul>
                                        <span
                                            class="review">{{round($product->reviews_count)}} Customer Review</span>
                                    </div>
                                </div>

                                <div class="product-contain">
                                    <p class="w-100">
                                        {!! $product->short_description !!}
                                    </p>
                                </div>

                                <div class="product-package">
                                    <div class="product-title">
                                        <h4>Color </h4>
                                    </div>

                                    <ul class="color circle select-package">

                                        @foreach($product->productAttributes->unique('hex_code') as $product_attribute)
                                            <li class="form-check">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="color"
                                                       id="color-{{ $product_attribute->id }}"
                                                       value="{{ $product_attribute->hex_code }}">
                                                <!-- Ensure value is set -->

                                                <label class="form-check-label"
                                                       for="color-{{ $product_attribute->id }}">
                                                    <span
                                                        style="background-color: {{ $product_attribute->hex_code }};"></span>
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>


                                </div>


                                <div class="note-box product-package">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <!-- - Button -->
                                            <button type="button" class="qty-left-minus" data-type="minus"
                                                    data-field="">
                                                <i class="fa fa-minus"></i>
                                            </button>

                                            <!-- Input Field -->
                                            <input class="form-control input-number qty-input" type="text" name="qty"
                                                   value="1">

                                            <!-- + Button -->
                                            <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <button id="cart-btn"
                                            class="btn btn-md bg-dark cart-button text-white w-100">Add To Cart
                                    </button>
                                </div>

                                <div class="buy-box">
                                    <a id="wishlist-btn">

                                        <i data-feather="heart"></i>
                                        <span>Add To Wishlist</span>
                                    </a>


                                </div>


                                <div class="payment-option">
                                    <div class="product-title">
                                        <h4>Guaranteed Safe Checkout</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img
                                                    src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img
                                                    src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img
                                                    src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img
                                                    src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img
                                                    src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-contain">
                                <div class="vendor-image">
                                    <img src="../assets/images/product/vendor.png" class="blur-up lazyload" alt="">
                                </div>

                                <div class="vendor-name">
                                    <h5 class="fw-500">Noodles Co.</h5>

                                    <div class="product-rating mt-1">
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
                                        <span>(36 Reviews)</span>
                                    </div>

                                </div>
                            </div>

                            <p class="vendor-detail">Noodles & Company is an American fast-casual
                                restaurant that offers international and American noodle dishes and pasta.</p>

                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>Address: <span class="text-content">1288 Franklin Avenue</span></h5>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="headphones"></i>
                                            <h5>Contact Seller: <span class="text-content">(+1)-123-456-789</span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pt-25">
                            <div class="hot-line-number">
                                <h5>Hotline Order:</h5>
                                <h6>Mon - Fri: 07:00 am - 08:30PM</h6>
                                <h3>(+1) 123 456 789</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->



    <!-- Nav Tab Section Start -->
    <section>
        <div class="container-fluid-lg mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="product-section-box m-0">
                        <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab">Description
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                        type="button" role="tab">Additional
                                    info
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review"
                                        type="button" role="tab">Review
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content custom-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                <div class="product-description">
                                    <div class="nav-desh">
                                        <p>
                                            {!! $product->description !!}
                                        </p>
                                    </div>


                                </div>
                            </div>

                            <div class="tab-pane fade" id="info" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table info-table">
                                        <tbody>
                                        <tr>
                                            <td>{!! $product->additional_description !!}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="review" role="tabpanel">
                                <div class="review-box">
                                    <div class="row">
                                        <div class="col-xl-5">
                                            <div class="product-rating-box">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="product-main-rating">
                                                            <h2>
                                                                {{round($product->reviews_avg_rating, 2) ?? 0}}
                                                                <i data-feather="star"></i>
                                                            </h2>

                                                            <h5>{{$product->reviews_count}} Overall Rating</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <ul class="product-rating-list">

                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>5<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                             style="width: {{$product->star_percentages[5]}}%"></div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{$product->five_star_count}}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>4<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                             style="width: {{$product->star_percentages[4]}}%"></div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{$product->four_star_count}}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>3<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                             style="width: {{$product->star_percentages[3]}}%"></div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{$product->three_star_count}}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>2<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                             style="width: {{$product->star_percentages[2]}}%"></div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{$product->two_star_count}}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>1<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                             style="width: {{$product->star_percentages[1]}}%"></div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{$product->one_star_count}}
                                                                    </h5>
                                                                </div>
                                                            </li>

                                                        </ul>

                                                        <div class="review-title-2">
                                                            <h4 class="fw-bold">Review this product</h4>
                                                            <p>Let other customers know what you think</p>
                                                            <button class="btn" type="button" data-bs-toggle="modal"
                                                                    data-bs-target="#writereview">Write a
                                                                review
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-7">
                                            <div class="review-people">
                                                <ul class="review-list" id="review-list">
                                                    @foreach($product->reviews as $review)
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                             src="../assets/images/review/1.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a
                                                                            href="javascript:void(0)"
                                                                            class="name">Jack Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content">
                                                                                {{$review->created_at->format('d M Y h:i A')}}
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">

                                                                                    @for($i = 0; $i < $review->rating; $i++)
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                               class="{{$i <= $review->rating ? 'fill' : ''}}"></i>
                                                                                        </li>
                                                                                    @endfor


                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>
                                                                            {{$review->comment}}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>

                                                    @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Nav Tab Section End -->










    <!-- Add to cart Modal Start -->
    <div class="add-cart-box">
        <div class="add-image">
            <img src="../assets/images/cake/pro/1.jpg" class="img-fluid" alt="">
        </div>

        <div class="add-contain">
            <h6>Added to Cart</h6>
        </div>
    </div>
    <!-- Add to cart Modal End -->

    <!-- Tap to top and theme setting button start -->
    <div class="theme-option theme-option-2">
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
    </div>
    <!-- Tap to top and theme setting button end -->

    <!-- Sticky Cart Box Start -->
    <div class="sticky-bottom-cart">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="cart-content">
                        <div class="product-image">
                            <img src="../assets/images/product/category/1.jpg" class="img-fluid blur-up lazyload"
                                 alt="">
                            <div class="content">
                                <h5>{{$product->name}}</h5>
                                <h6>$32.96
                                    <del class="text-danger">$96.00</del>
                                    <span>55% off</span></h6>
                            </div>
                        </div>
                        <div class="selection-section">
                            <div class="form-group mb-0">
                                <select id="input-state" class="form-control form-select">
                                    <option selected disabled>Choose Weight...</option>
                                    <option>1/2 KG</option>
                                    <option>1 KG</option>
                                    <option>1.5 KG</option>
                                </select>
                            </div>
                            <div class="cart_qty qty-box product-qty m-0">
                                <div class="input-group h-100">
                                    <button type="button" class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text" name="quantity"
                                           value="1">
                                    <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="add-btn">
                            <a class="btn theme-bg-color text-white wishlist-btn" href="wishlist.html"><i
                                    class="fa fa-bookmark"></i> Wishlist</a>
                            <a class="btn theme-bg-color text-white" href="cart.html"><i
                                    class="fas fa-shopping-cart"></i> Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Cart Box End -->

    <!-- Review Modal Start -->
    <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <form id="product-review-form" class="product-review-form">

                        <input type="hidden" name="product_id" value="{{$product->id}}">

                        <div class="review-box">
                            <!-- Star Rating Section -->
                            <div class="product-rating">
                                <label>Your Rating *</label>

                                <div class="star-rating">
                                    <!-- Radio input with labels for rating -->
                                    <input type="radio" id="star5" name="rating" value="5">
                                    <label for="star5">★</label>
                                    <input type="radio" id="star4" name="rating" value="4">
                                    <label for="star4">★</label>
                                    <input type="radio" id="star3" name="rating" value="3">
                                    <label for="star3">★</label>
                                    <input type="radio" id="star2" name="rating" value="2">
                                    <label for="star2">★</label>
                                    <input type="radio" id="star1" name="rating" value="1">
                                    <label for="star1">★</label>
                                </div>
                            </div>

                            <!-- Review Content Section -->
                            <div class="review-box">
                                <label for="comment" class="form-label">Your Comment *</label>
                                <textarea
                                    id="comment"
                                    name="comment"
                                    rows="3"
                                    class="form-control"
                                    placeholder="Write your review here"

                                ></textarea>
                            </div>

                            <!-- Form Submission Buttons -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                                        data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-md fw-bold text-light theme-bg-color">
                                    Submit Review
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Modal End -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

@endsection

@push('frontend.scripts')

    <script>
        $(document).ready(function () {
            // Constants
            const selectedColor = $('input[name="color"]');
            const qtyInput = $('input[name="qty"]');
            const productSlug = window.location.pathname.split('/')[2];
            const product_id = $('input[name="product_id"]').val();

            // Event Listeners
            setupEventListeners();

            // Function to register event listeners
            function setupEventListeners() {
                // Handle color selection
                selectedColor.on('change', handleColorChange);

                // Handle quantity increment and decrement
                $('.qty-left-minus').on('click', handleDecreaseQuantity);
                $('.qty-right-plus').on('click', handleIncreaseQuantity);

                // Add to Cart
                $('#cart-btn').on('click', async function (event) {
                    event.preventDefault();
                    console.log(event);
                    await handleCartAction('{{route('cart.store')}}', addToCart);
                });

                // Add to Wishlist
                $('#wishlist-btn').on('click', async function (event) {
                    event.preventDefault();
                    console.log(event);
                    await handleCartAction('{{route('wishlist.store')}}', addToWishlist);
                });

                // Submit Review Form
                $('#product-review-form').on('submit', handleReviewFormSubmit);
            }

            // Handlers
            function handleColorChange(event) {
                event.preventDefault();
                const selectedColorId = $(this).attr('id');
                console.log(`Selected Color ID: ${selectedColorId}`);
            }

            function handleDecreaseQuantity(event) {
                event.preventDefault();
                adjustQuantity($(this), -1);
            }

            function handleIncreaseQuantity(event) {
                event.preventDefault();
                adjustQuantity($(this), 1);
            }

            async function handleCartAction(url, action) {
                const selectedColor = $('input[name="color"]:checked').val();
                const qty = qtyInput.val();
                console.log('Action Data:', {selectedColor, qty, productSlug});

                const data = createFormData({selectedColor, qty, productSlug});
                const response = await action(data, url);

                console.log('Response:', response);
            }


            // Utility Functions
            function adjustQuantity(button, adjustment) {
                const qtyField = button.parent().find('.qty-input');
                let qty = parseInt(qtyField.val()) || 0;
                qty = Math.max(1, qty + adjustment); // Ensure quantity is at least 1
                qtyField.val(qty);
            }

            async function addToCart(formData, url) {
                return ajaxRequest(formData, url);
            }

            async function addToWishlist(formData, url) {
                return ajaxRequest(formData, url);
            }

            async function handleReviewFormSubmit(event) {

                event.preventDefault();

                if (!validateReviewForm()) return;

                const formData = new FormData(this);

                const reviewList = $('#review-list');
                const url = "{{ route('product.review.store') }}";

                try {
                    const response = await submitReview(formData, url);

                    if (response.status === 'success') {

                        refreshReviewList(reviewList, response.data);
                        resetForm('#product-review-form');
                        $('#writereview').modal('hide');

                    } else {
                        showAlert('Error!', response.message, 'error');
                    }
                } catch (error) {
                    console.log(error)
                    if (error.status === 422) {
                        handleError(error);
                        console.log(error.response);

                    } else if (error.status === 401) {
                        window.location.href = '/login';

                    } else {
                        handleError(error);
                    }

                }
            }


            async function submitReview(formData, url) {
                return ajaxRequest(formData, url);
            }

            async function ajaxRequest(formData, url) {
                return $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    processData: false,
                    contentType: false,
                });
            }

            function createFormData(data) {
                const formData = new FormData();
                for (const [key, value] of Object.entries(data)) {
                    formData.append(key, value);
                }
                return formData;
            }

            function validateReviewForm() {
                const rating = $('input[name="rating"]:checked').val();
                const comment = $('#comment').val();

                if (!rating || !comment) {
                    showAlert('Error!', 'Rating and comment are required.', 'error');
                    return false;
                }
                return true;
            }

            function refreshReviewList(reviewList, reviews) {
                reviewList.empty();
                reviews.forEach(review => {
                    appendReview(reviewList, review);
                });
            }

            function appendReview(reviewList, review) {
                const fallbackImage = '/front/assets/images/review/no-image.jpg';
                const userImage = review.user.profile_image || fallbackImage;
                const userName = review.user.name || 'Anonymous';
                const reviewDate = formatDate(review.created_at) || 'Just now';
                const stars = generateRatingStars(review.rating || 0);

                const reviewHtml = `
            <li>
                <div class="people-box">
                    <div>
                        <div class="people-image people-text">
                            <img alt="user" class="img-fluid" src="${userImage}">
                        </div>
                    </div>
                    <div class="people-comment">
                        <div class="people-name">
                            <a href="javascript:void(0)" class="name">${userName}</a>
                            <div class="date-time">
                                <h6 class="text-content">${reviewDate}</h6>
                                <div class="product-rating">
                                    <ul class="rating">${stars}</ul>
                                </div>
                            </div>
                        </div>
                        <div class="reply">
                            <p>${review.comment}</p>
                        </div>
                    </div>
                </div>
            </li>
        `;
                reviewList.prepend(reviewHtml);
            }

            function generateRatingStars(rating) {
                const maxStars = 5;
                return Array.from({length: maxStars}, (_, index) => {
                    const filledClass = index < rating ? 'fill' : '';
                    return `<li><i data-feather="star" class="${filledClass}"></i></li>`;
                }).join('');
            }

            function formatDate(isoDate) {
                const options = {year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit'};
                return new Date(isoDate).toLocaleDateString('en-US', options);
            }

            function resetForm(formSelector) {
                $(formSelector)[0].reset();
            }

            function showAlert(title, message, type) {
                Swal.fire(title, message, type);
            }

            function handleError(error) {
                const errorMessage = error.responseJSON?.message || 'Something went wrong.';
                showAlert('Error!', errorMessage, 'error');
            }
        });
    </script>
@endpush



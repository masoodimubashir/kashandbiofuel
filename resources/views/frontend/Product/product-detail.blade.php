@extends('welcome')

@section('main')
    <style>
        .star-rating .fa-star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
            margin-right: 5px;
        }

        .star-rating .selected {
            color: #ffc107;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ $product->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $product->name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <input type="text" name="product_id" value="{{ $product->id }}" hidden>

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


                                            @foreach ($product->productAttributes as $attribute)
                                                @isset($attribute->images)
                                                    @php
                                                        $images = json_decode($attribute->images, true);
                                                    @endphp
                                                    @foreach ($images as $image)
                                                        <div>
                                                            <div class="slider-image">
                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                    data-zoom-image="{{ asset('storage/' . $image) }}"
                                                                    class=" img-fluid image_zoom_cls-0 blur-up lazyload"alt=""
                                                                    style="height: 500px;">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        <div class="slider-image">
                                                            <img src="{{ asset('default_images/product_image.png') }}"
                                                                id="img"
                                                                data-zoom-image="{{ asset('default_images/product_image.png') }}"
                                                                class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                @endisset
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="left-slider-image left-slider no-arrow slick-top">

                                            @foreach ($product->productAttributes as $attribute)
                                                @isset($attribute->images)
                                                    @php
                                                        $images = json_decode($attribute->images, true);
                                                    @endphp
                                                    @foreach ($images as $image)
                                                        <div>
                                                            <div class="sidebar-image">
                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div>
                                                        <div class="sidebar-image">
                                                            <img src="{{ asset('default_images/product_image.png') }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                    </div>
                                                @endisset
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp">
                            <div class="right-box-contain">
                                <h6 class="offer-top">
                                    {{ $product->percentage_amount_off }}% OFF
                                </h6>
                                <h2 class="name">{{ $product->name }}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">{{ Number::currency($product->selling_price, 'INR') }}
                                        <del class="text-content">
                                            {{ Number::currency($product->price, 'INR') }}
                                        </del>

                                        <p>
                                            Inclusive Of All Taxes ---
                                            GST({{ $product->gst_amount }}%)


                                        </p>
                                    </h3>



                                    <div class="product-rating custom-rate">
                                        <ul class="rating">

                                        </ul>
                                        <span class="review">
                                            {{ round($product->reviews_count) }}
                                            Customer Review
                                        </span>
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

                                        @foreach ($product->productAttributes as $attribute)
                                            <li class="form-check">
                                                <input class="form-check-input" checked type="radio" name="color"
                                                    id="{{ $attribute->id }}" value="{{ $attribute->id }}">
                                                <label class="form-check-label" for="{{ $attribute->id }}">
                                                    <span style="background-color: {{ $attribute->hex_code }};"></span>
                                                </label>
                                            </li>
                                        @endforeach

                                    </ul>

                                    <div class="product-title">
                                        <h4>Size </h4>
                                    </div>

                                    <ul class="image select-package">

                                        @foreach ($product->productAttributes as $attributes)
                                            @isset($attributes->images)
                                                @php
                                                    $images = json_decode($attributes->images, true);
                                                    $firstImage = $images[0];
                                                @endphp
                                                <li class="form-check">
                                                    <input class="form-check-input" type="radio" name="size"
                                                        id="color-{{ $attribute->id }}" {{ $loop->first ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="color-{{ $attribute->id }}">
                                                        <img src="{{ asset('storage/' . $firstImage) }}"
                                                            alt="{{ $product->name }}">
                                                    </label>
                                                </li>
                                            @else
                                                <li class="form-check">

                                                    <label class="form-check-label" for="color">
                                                        <img src="{{ asset('default_images/product_image.png') }}"
                                                            alt="#">
                                                    </label>
                                                </li>
                                            @endisset
                                        @endforeach

                                    </ul>

                                </div>
                                <div class="note-box product-package">

                                    <button id="cart-btn" class="btn btn-md bg-dark cart-button text-white w-100">Add To
                                        Cart
                                    </button>
                                </div>

                                <div class="buy-box">
                                    <a id="wishlist-btn">

                                        <i data-feather="heart"></i>
                                        <span>Add To Wishlist</span>
                                    </a>
                                </div>

                                <div class="pickup-box">

                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>MFG : <a href="javascript:void(0)">{{ $product->crafted_date }}</a></li>
                                            <li>Stock : <a href="javascript:void(0)">{{ $product->qty }} In Stock</a></li>
                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <div class="vendor-box">
                            <div class="vendor-list">
                                <ul>

                                    <li>
                                        <div class="address-contact">

                                            <i data-feather="box"> </i>

                                            <a href="tel:+918881042340">Sold By:
                                                <span class="text-content">
                                                    Kassh & BioFuel PVT LTD<br>
                                                    Papum Pare, Arunachal Pradesh, India - 791113
                                                </span>
                                            </a>
                                        </div>
                                    </li>



                                    <li>
                                        <div class="address-contact">

                                            <i data-feather="phone"></i>
                                            <a href="tel:+918881042340">Contact Seller: <span
                                                    class="text-content">+918881042340</span></a>
                                        </div>
                                    </li>


                                </ul>
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
                                                                {{ round($product->reviews_avg_rating, 2) ?? 0 }}
                                                                <i data-feather="star"></i>
                                                            </h2>

                                                            <h5>{{ $product->reviews_count }} Overall Rating</h5>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-12">
                                                        <ul class="product-rating-list">

                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>5<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ $product->star_percentages[5] }}%">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{ $product->five_star_count }}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>4<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ $product->star_percentages[4] }}%">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{ $product->four_star_count }}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>3<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ $product->star_percentages[3] }}%">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{ $product->three_star_count }}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>2<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ $product->star_percentages[2] }}%">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{ $product->two_star_count }}
                                                                    </h5>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="rating-product">
                                                                    <h5>1<i data-feather="star"></i></h5>
                                                                    <div class="progress">
                                                                        <div class="progress-bar"
                                                                            style="width: {{ $product->star_percentages[1] }}%">
                                                                        </div>
                                                                    </div>
                                                                    <h5 class="total">
                                                                        {{ $product->one_star_count }}
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
                                                    @foreach ($product->reviews as $review)
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                            src="{{ $review->user->image_path }}">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a href="javascript:void(0)"
                                                                            class="name">{{ $review->user->name }}</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content">
                                                                                {{ $review->created_at->format('d M Y h:i A') }}
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">

                                                                                    @for ($i = 0; $i < $review->rating; $i++)
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="{{ $i <= $review->rating ? 'fill' : '' }}"></i>
                                                                                        </li>
                                                                                    @endfor


                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>
                                                                            {{ $review->comment }}
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



    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->




    <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Write a review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body pt-0">
                    <form class="product-review-form" id="product-review-form">
                        <!-- Star Rating -->
                        <div class="review-box">
                            <label class="form-label d-block">Rating</label>
                            <div class="star-rating" id="star-rating">
                                <i class="fa fa-star" data-value="5"></i>
                                <i class="fa fa-star" data-value="4"></i>
                                <i class="fa fa-star" data-value="3"></i>
                                <i class="fa fa-star" data-value="2"></i>
                                <i class="fa fa-star" data-value="1"></i>
                            </div>
                            <input type="hidden" name="rating" id="rating">
                            <div class="text-danger" id="rating-error"></div>
                        </div>

                        <!-- Review Content -->
                        <div class="review-box mt-3">
                            <label for="content" class="form-label">Your Review *</label>
                            <textarea id="content" name="comment" rows="3" class="form-control"
                                placeholder="Write your review here..."></textarea>
                            <div class="text-danger" id="content-error"></div>
                        </div>

                        <!-- Modal Footer Buttons -->
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-md fw-bold text-light theme-bg-color">Save
                                changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('frontend.scripts')
    <script>
        $(document).ready(function() {
            const productAttributeInputs = $('input[name="color"]');
            const qtyInput = $('input[name="qty"]');
            const product_id = $('input[name="product_id"]').val();
            const productAttributes = @json($product->productAttributes);
            let selectedRating = 0;

            // Initialize all events
            initRatingStars();
            initQtyButtons();
            initColorImagePreview();
            initCartAndWishlist();
            initReviewForm();

            /** ========== STAR RATING ========== **/
            function initRatingStars() {
                const stars = $('#star-rating .fa-star');

                stars.on('mouseenter', function() {
                    highlightStars($(this).data('value'));
                });

                stars.on('mouseleave', function() {
                    highlightStars(selectedRating);
                });

                stars.on('click', function() {
                    selectedRating = $(this).data('value');
                    $('#rating').val(selectedRating);
                    highlightStars(selectedRating);
                });
            }

            function highlightStars(rating) {
                $('#star-rating .fa-star').each(function() {
                    const starValue = $(this).data('value');
                    $(this).toggleClass('selected', starValue <= rating);
                });
            }

            /** ========== COLOR CHANGE PREVIEW ========== **/
            function initColorImagePreview() {
                productAttributeInputs.on('change', function() {
                    const id = $(this).val();
                    const attr = productAttributes.find(a => a.id == id);

                    if (attr) {
                        const imgSrc = attr.image ? `{{ asset('storage') }}/${attr.image}` :
                            `{{ asset('default_images/product_image.png') }}`;
                        $('#img-1').attr('src', imgSrc).attr('data-zoom-image', imgSrc);

                        const thumb = $(`.sidebar-image[data-attribute-id="${id}"] img`);
                        thumb.attr('src', imgSrc);
                    }
                });
            }

            /** ========== CART / WISHLIST ========== **/
            function initCartAndWishlist() {
                $('#cart-btn').on('click', function(e) {
                    e.preventDefault();
                    submitCartOrWishlist('{{ route('cart.add-to-cart') }}');
                });

                $('#wishlist-btn').on('click', function(e) {
                    e.preventDefault();
                    submitCartOrWishlist('{{ route('wishlist.add-to-wishlist') }}');
                });
            }

            async function submitCartOrWishlist(url) {
                const selectedColor = $('input[name="color"]:checked').val();
                const qty = parseInt(qtyInput.val()) || 1;

                const formData = createFormData({
                    product_attribute_id: selectedColor,
                    qty,
                    product_id
                });

                await ajaxRequest(formData, url);
            }

            /** ========== REVIEW FORM SUBMIT ========== **/
            function initReviewForm() {
                $('#product-review-form').on('submit', async function(e) {

                    e.preventDefault();
                    const rating = $('#rating').val();
                    const content = $('#content').val().trim();



                    let hasError = false;
                    if (!rating) {
                        $('#rating-error').text('Rating is required.');
                        hasError = true;
                    } else {
                        $('#rating-error').text('');
                    }

                    if (!content) {
                        $('#content-error').text('Review content is required.');
                        hasError = true;
                    } else {
                        $('#content-error').text('');
                    }

                    if (hasError) return;

                    const formData = new FormData(this);
                    formData.append('product_id', product_id);

                    const url = "{{ route('product.review.store') }}";

                    try {
                        const response = await ajaxRequest(formData, url);
                        if (response.status === 'success') {
                            refreshReviewList($('#review-list'), response.data);
                            this.reset();
                            $('#rating').val('');
                            selectedRating = 0;
                            highlightStars(0);
                            $('#writereview').modal('hide');
                            showAlert('Success!', 'Review submitted successfully!', 'success');
                        }
                    } catch (error) {
                        if (error.status === 422) handleError(error);
                        if (error.status === 401) window.location.href = '{{ route('login') }}';
                    }
                });
            }

            /** ========== QUANTITY BUTTONS ========== **/
            function initQtyButtons() {
                $(document).on('click', '.qty-left-minus', function() {
                    const input = $(this).siblings('.qty-input');
                    let val = parseInt(input.val()) || 1;
                    if (val > 1) input.val(--val);
                    else showAlert('Error', 'Quantity cannot be less than 1.', 'error');
                });

                $(document).on('click', '.qty-right-plus', function() {
                    const input = $(this).siblings('.qty-input');
                    const max = $(this).data('qty');
                    let val = parseInt(input.val()) || 1;
                    if (val < max) input.val(++val);
                    else showAlert('Error', `You cannot add more than ${max} items.`, 'error');
                });
            }

            /** ========== HELPERS ========== **/
            function createFormData(data) {
                const formData = new FormData();
                for (let key in data) formData.append(key, data[key]);
                return formData;
            }

            async function ajaxRequest(formData, url) {
                return $.ajax({
                    url,
                    method: "POST",
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false
                });
            }

            function refreshReviewList(list, reviews) {
                list.empty();
                reviews.forEach(review => appendReview(list, review));
            }

            function appendReview(list, review) {
                const userImage = review.user?.profile_image || '/front/assets/images/review/no-image.jpg';
                const userName = review.user?.name || 'Anonymous';
                const reviewDate = formatDate(review.created_at);
                const stars = generateStars(review.rating || 0);

                const reviewHtml = `
                <li>
                    <div class="people-box">
                        <div class="people-image people-text">
                            <img src="${userImage}" class="img-fluid" alt="user" />
                        </div>
                        <div class="people-comment">
                            <div class="people-name">
                                <a href="#" class="name">${userName}</a>
                                <div class="date-time">
                                    <h6 class="text-content">${reviewDate}</h6>
                                    <div class="product-rating"><ul class="rating">${stars}</ul></div>
                                </div>
                            </div>
                            <div class="reply"><p>${review.comment}</p></div>
                        </div>
                    </div>
                </li>
            `;
                list.prepend(reviewHtml);
            }

            function generateStars(rating) {
                return [...Array(5)].map((_, i) =>
                    `<li><i data-feather="star" class="${i < rating ? 'fill' : ''}"></i></li>`
                ).join('');
            }

            function formatDate(iso) {
                return new Date(iso).toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            }

            function showAlert(title, text, type) {
                Swal.fire(title, text, type);
            }

            function handleError(error) {
                const msg = error.responseJSON?.message || 'Something went wrong.';
                showAlert('Error!', msg, 'error');
            }
        });
    </script>
@endpush

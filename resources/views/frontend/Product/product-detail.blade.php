@extends('welcome')

@section('main')
    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            /* Display stars right-to-left */
            justify-content: flex-start;
        }

        .star-rating input {
            display: none;
            /* Hide the radio buttons */
        }

        .star-rating label {
            font-size: 2rem;
            /* Adjust size of the stars */
            color: lightgray;
            /* Default color of stars */
            cursor: pointer;
            /* Pointer cursor for selection */
        }

        .star-rating input:checked~label {
            color: gold;
            /* Highlight selected stars */
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
            /* Highlight stars on hover */
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

                                            @foreach ($product->productAttributes as $attributes)
                                                @isset($attribute->images)
                                                    @php
                                                        $images = json_decode($attributes->images, true);
                                                    @endphp
                                                    @foreach ($images as $key => $image)
                                                        <div>
                                                            <div class="slider-image">
                                                                <img src="{{ asset('storage/' . $image) }}"
                                                                    id="img-{{ $key }}"
                                                                    data-zoom-image="{{ asset('storage/' . $image) }}"
                                                                    class="
                                                   img-fluid image_zoom_cls-0 blur-up lazyload"
                                                                    alt="">
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

                                            @foreach ($product->productAttributes as $attributes)
                                                @isset($attributes->images)
                                                    @php
                                                        $images = json_decode($attributes->images, true);
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
                                                                            src="../assets/images/review/1.jpg">
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
@endsection

@push('frontend.scripts')
    <script>
        $(document).ready(function() {

            const product_attribute_id = $('input[name="color"]');
            const qtyInput = $('input[name="qty"]');
            const productSlug = window.location.pathname.split('/')[2];
            const product_id = $('input[name="product_id"]').val();
            const productAttributes = @json($product->productAttributes);

            // Event Listeners
            setupEventListeners();

            // Function to register event listeners
            function setupEventListeners() {
                // Handle color selection
                product_attribute_id.on('change', handleColorChange);

                // Add to Cart
                $('#cart-btn').on('click', async function(event) {
                    event.preventDefault();
                    await handleCartAction('{{ route('cart.add-to-cart') }}', addToCart);
                });

                // Add to Wishlist
                $('#wishlist-btn').on('click', async function(event) {
                    event.preventDefault();
                    await handleCartAction('{{ route('wishlist.add-to-wishlist') }}', addToWishlist);
                });

                $('#product-review-form').on('submit', handleReviewFormSubmit);
            }

            function handleColorChange(event) {
                event.preventDefault();
                const productAttributeId = $(this).val(); // Get the selected color's product attribute ID

                // Find the corresponding product attribute
                const productAttribute = productAttributes.find(attr => attr.id == productAttributeId);

                if (productAttribute) {
                    // Update the main product image
                    const mainImage = $('#img-1');
                    mainImage.attr('src', productAttribute.image ?
                        `{{ asset('storage/') }}/${productAttribute.image}` :
                        `{{ asset('default_images/product_image.png') }}`);
                    mainImage.attr('data-zoom-image', productAttribute.image ?
                        `{{ asset('storage/') }}/${productAttribute.image}` :
                        `{{ asset('default_images/product_image.png') }}`);

                    // Update the thumbnail images
                    const thumbnailContainer = $(`.sidebar-image[data-attribute-id="${productAttributeId}"]`);
                    const thumbnailImage = thumbnailContainer.find('img');
                    thumbnailImage.attr('src', productAttribute.image ?
                        `{{ asset('storage/') }}/${productAttribute.image}` :
                        `{{ asset('default_images/product_image.png') }}`);
                }
            }
            async function handleCartAction(url, action) {
                const product_attribute_id = $('input[name="color"]:checked').val();
                const qty = 1;
                const data = createFormData({
                    product_attribute_id,
                    qty,
                    product_id
                });
                await action(data, url);
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
                    }
                } catch (error) {
                    if (error.status === 422) {
                        handleError(error);
                    } else if (error.status === 401) {
                        window.location.href = '{{ route('login') }}';
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
                    success: function(response) {

                        if (response.status === true) {
                            window.location.href = response.redirect_url;
                        } else {
                            showAlert('Success!', response.message, 'success');
                        }
                    },
                    error: function(error) {
                        if (error.status === 401) {
                            window.location.href = '{{ route('login') }}';
                        }
                        if (error.status === 422) {
                            handleError(error);
                        }
                        if (error.status === 404) {
                            showAlert('Error!', error.responseJSON.message, 'error');
                        }
                    }
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
                return Array.from({
                    length: maxStars
                }, (_, index) => {
                    const filledClass = index < rating ? 'fill' : '';
                    return `<li><i data-feather="star" class="${filledClass}"></i></li>`;
                }).join('');
            }

            function formatDate(isoDate) {
                const options = {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
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

            $(document).on('click', '.qty-left-minus', function() {
                const input = $(this).siblings('.qty-input');
                const maxQty = $(this).data('qty');
                let currentValue = parseInt(input.val());

                if (currentValue > 1) {
                    currentValue--;
                    input.val(currentValue);
                } else {
                    showAlert('Error', 'Quantity cannot be less than 1.', 'error');
                }
            });

            $(document).on('click', '.qty-right-plus', function() {
                const input = $(this).siblings('.qty-input');
                const maxQty = $(this).data('qty');
                let currentValue = parseInt(input.val());
                if (currentValue < maxQty) {
                    currentValue++;
                    input.val(currentValue);
                } else {
                    showAlert('Error', 'You cannot add more than ' + maxQty + ' items.', 'error');
                }
            });
        });
    </script>
@endpush

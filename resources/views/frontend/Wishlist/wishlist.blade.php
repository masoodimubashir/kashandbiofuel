@extends('welcome')
@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Wishlist</h2>

                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2" id="wishlist-items">
                {{--            Showing All Wishlisted Products Here . --}}
            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->


    @push('frontend.scripts')
        <script>
            $(document).ready(function() {
                // DOM Elements
                const wishlistContainer = $('#wishlist-items');

                // Helper Functions
                const showAlert = (title, message, type) => Swal.fire(title, message, type);
                const handleErrors = (error) => showAlert('Error!', error.responseJSON?.message ||
                    'Something Went Wrong', 'error');

                const renderWishlistItem = (item) => `
        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain" data-product-id="${item.product.id}">
            <div class="product-box-3 h-100">
                <div class="product-header">
                    <div class="product-image">
                        <a href="/product/${item.product.slug}">
                            <img src="${item.product.product_attribute?.image_path ? `storage/${item.product.product_attribute.image_path}` : 'default_images/product_image.png'}"
                                class="img-fluid blur-up lazyload"
                                alt="${item.product.name}">
                        </a>
                        <div class="product-header-top">
                            <button class="btn wishlist-button wishlist-remove" data-wishlist-id="${item.id}">
                                <i class="fa fa-x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-footer">
                    <div class="product-detail">
                        <span class="span-name">${item.product.category ?? 'Category'}</span>
                        <a href="/product/${item.product.slug}">
                            <h5 class="name">${item.product.name}</h5>
                        </a>
                        <h6 class="unit mt-1">Quantity (MAX) : ${item.product.product_attribute.qty ?? 'Unit'}</h6>
                        <div class="color-swatch mt-2" 
                            style="background-color: ${item.product.product_attribute.hex_code}; 
                                   width: 25px; 
                                   height: 25px; 
                                   display: inline-block; 
                                   border-radius: 50%;"
                            title="Color: ${item.product.product_attribute.hex_code}"
                            data-product-attribute-id="${item.product_attribute_id}">
                        </div>
                        <h5 class="price">
                            <span class="theme-color">&#8377;${parseFloat(item.product.selling_price)}</span>
                            <del>&#8377;${parseFloat(item.product.price)}</del>
                        </h5>
                        <div class="add-to-cart-box bg-white mt-2">
                            <button class="btn btn-add-cart" 
                                    data-wishlist-id="${item.id}" 
                                    data-product-attribute-id="${item.product_attribute_id}"
                                    data-product-id="${item.product_id}"
                                >
                                Add To Cart
                            </button>
                            <div class="cart_qty qty-box">
                                <div class="input-group bg-white">
                                    <button type="button" class="qty-left-minus bg-gray"
                                        data-type="minus" 
                                        data-product-id="${item.product.id}"
                                        data-product-attribute-id="${item.product_attribute_id}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" 
                                           type="text"
                                           name="quantity" 
                                           value="${item.qty}">
                                    <button type="button" class="qty-right-plus bg-gray"
                                        data-type="plus" 
                                        data-product-id="${item.product.id}"
                                        data-product-attribute-id="${item.product_attribute_id}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;

                // AJAX Functions
                const getWishlistItems = () => {
                    $.ajax({
                        url: "{{ route('wishlist.view-wishlist') }}",
                        type: "GET",
                        success: (response) => {
                            wishlistContainer.html(response.data.map(renderWishlistItem).join(''));
                        },
                        error: handleErrors
                    });
                };

                const addToCart = (wishlistId, productAttributeId, product_id) => {
                    $.ajax({
                        url: `/return-to-cart/${wishlistId}`,
                        type: "PUT",
                        data: {
                            product_attribute_id: productAttributeId,
                            product_id: product_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.status) {
                                showAlert('Success!', response.message, 'success');
                                getWishlistItems();
                            }
                        },
                        error: handleErrors
                    });
                };

                const removeFromWishlist = (wishlistId) => {
                    $.ajax({
                        url: `/wishlist/delete/${wishlistId}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: () => {
                            showAlert('Success!', 'Item removed from wishlist successfully', 'success');
                            getWishlistItems();
                        },
                        error: handleErrors
                    });
                };

                // Event Listeners
                $(document).on('click', '.btn-add-cart', function(e) {
                    e.preventDefault();
                    const wishlistId = $(this).data('wishlist-id');
                    const productAttributeId = $(this).data('product-attribute-id');
                    const product_id = $(this).data('product-id');
                    addToCart(wishlistId, productAttributeId, product_id);
                });

                $(document).on('click', '.wishlist-remove', function(e) {
                    e.preventDefault();
                    const wishlistId = $(this).data('wishlist-id');
                    removeFromWishlist(wishlistId);
                });

                // Initialize
                getWishlistItems();
            });
        </script>
    @endpush
@endsection

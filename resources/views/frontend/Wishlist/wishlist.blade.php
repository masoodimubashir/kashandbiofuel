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
                {{--            Showing All Wishlisted Products Here .--}}
            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->


    @push('frontend.scripts')
        <script>


            $('document').ready(function () {

                // Load cart items when the page is ready
                getCartItems();


                // Fetch and render cart items
                function getCartItems() {
                    $.ajax({
                        url: "{{route('wishlist.view-wishlist')}}",
                        type: "GET",
                        success: function (response) {
                            document.querySelector('#wishlist-items').innerHTML = getItem(response.data);
                        },
                        error: function (error) {
                            handleErrors(error);
                        }
                    });
                }

                function handleErrors(error) {
                    const errorMessage = error.message || 'Something went wrong.';
                    showAlert('Error!', errorMessage, 'error');
                }

                function showAlert(title, message, type) {
                    Swal.fire(title, message, type);
                }

                function getItem(wishlist) {
                    let wishlistHtml = '';

                    wishlist.forEach(wishlist_data_item => {
                        wishlistHtml += `
                              <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain" data-product-id="${wishlist_data_item.id}">
            <div class="product-box-3 h-100">
                <div class="product-header">
                    <div class="product-image">
                        <a href="product-left-thumbnail.html">
                          
    <img src="${wishlist_data_item.product.product_attribute?.image_path ? `storage/${wishlist_data_item.product.product_attribute.image_path}` : 'default_images/product_image.png'}"
                                class="img-fluid blur-up lazyload" 
                                alt="${wishlist_data_item.product.name}"> 
                        </a>

                        <div class="product-header-top">
                            <button class="btn wishlist-button close_button" data-id="${wishlist_data_item.id}">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="product-footer">
                    <div class="product-detail">
                        <span class="span-name">${wishlist_data_item.product.category ?? 'Category'}</span>
                        <a href="product-left-thumbnail.html">
                            <h5 class="name">${wishlist_data_item.product.name ?? 'Product Name'}</h5>
                        </a>
                        <h6 class="unit mt-1">${wishlist_data_item.product.unit ?? 'Unit'}</h6>
                        <h5 class="price">
                            <span class="theme-color">$${parseFloat(wishlist_data_item.product.selling_price).toFixed(2)}</span>
                            <del>$${parseFloat(wishlist_data_item.product.price).toFixed(2)}</del>
                        </h5>
                        <div class="add-to-cart-box bg-white mt-2">
                            <button class="btn btn-add-cart " data-wishlist-id="${wishlist_data_item.id}">

                                    Add To Cart

                            </button>
                            <div class="cart_qty qty-box">
                                <div class="input-group bg-white">
                                    <button type="button" class="qty-left-minus bg-gray"
                                            data-type="minus" data-product-id="${wishlist_data_item.id}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text"
                                           name="quantity" value="${wishlist_data_item.qty}">
                                    <button type="button" class="qty-right-plus bg-gray"
                                            data-type="plus" data-product-id="${wishlist_data_item.id}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
                    });

                    return wishlistHtml;
                }

                // Dynamically handle the Add to Cart button click
                $(document).on('click', '.btn-add-cart', function (e) {

                    e.preventDefault();

                    let product_id = $(this).data('product-id');
                    let wishlist_id = $(this).data('wishlist-id');

                    let qty = $('.qty-input').val();

                    if (!qty || isNaN(qty) || qty <= 0) {
                        showAlert('Error!', 'Quantity must be a valid positive number.', 'error');
                        return; // Stop further execution
                    }

                    let url = `{{ url('/return-to-cart/${wishlist_id}') }}`;

                    // Make the AJAX request
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            _method: 'PUT'
                        },
                        success: function (response) {
                            if (response.status) {

                                showAlert('Success!', response.message, 'success');

                                getCartItems();
                            }
                        },
                        error: function (error) {
                            showAlert('Error!', error.responseJSON?.message || 'Something went wrong. Please try again.', 'error');
                        }
                    });
                });

            });
        </script>
    @endpush

@endsection

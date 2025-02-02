@extends('welcome')
@section('main')

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody id="cart-items">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <form class="mb-3 coupon-box input-group" id="apply-coupon-form">
                                    <input type="text" class="form-control" id="apply-coupon" name="coupon"
                                           placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </form>
                            </div>
                            <ul>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price" id="price">

                                    </h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-) 0.00</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>Shipping</h4>
                                    <h4 class="price text-end">$6.90</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (USD)</h4>
                                <h4 class="price theme-color" id="check_out_price">

                                </h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = 'checkout.html';"
                                            class="btn btn-animation proceed-btn fw-bold">Process To Checkout
                                    </button>
                                </li>

                                <li>
                                    <button onclick="location.href = 'index.html';"
                                            class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->

    @push('frontend.scripts')
        <script>


            $('document').ready(function () {

                const check_out_price = $('#check_out_price');
                const price = $('#price');


                $('#cart-items').on('click', '.remove', function (e) {
                    e.preventDefault();

                    var cart_item_id = $(this).data('id');

                    $.ajax({
                        url: "/cart/delete/" + cart_item_id,
                        type: "DELETE",
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function (response) {
                            getCartItems(); // Refresh the cart items
                        },
                        error: function (error) {
                            handleErrors(error); // Optional error-handling function
                        }
                    });
                });

                // Load cart items when the page is ready
                getCartItems();

                // Fetch and render cart items
                function getCartItems() {
                    $.ajax({
                        url: "{{route('cart.view-cart')}}", // API endpoint for viewing cart
                        type: "GET",
                        success: function (response) {
                            // Dynamically render the cart items
                            document.querySelector('#cart-items').innerHTML = getItem(response.data);
                            check_out_price.text(response.check_out_price);
                            price.text(response.check_out_price);
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

                function getItem(cartItems) {


                    let cartHTML = '';

                    cartItems.forEach(cart_item_data => {

                        cartHTML += `
                        <tr class="product-box-contain" data-product-id=${cart_item_data.id}>
                            <td class="product-detail">
                                <div class="product border-0">
                                    <a href="product-left-thumbnail.html" class="product-image">
                                        <img src="storage/${cart_item_data.product.product_attribute.image_path}"
                                             class="img-fluid blur-up lazyload" alt="">
                                    </a>
                                    <div class="product-detail">
                                        <ul>
                                            <li class="name">
                                                <a href="product-left-thumbnail.html">${cart_item_data.product.name ?? 'Product Name'}</a>
                                            </li>
                                            <li class="text-content"><span class="text-title">Price Per Item</span> - ${cart_item_data.product.selling_price}</li>

                                            <li class="text-content"><span class="text-title">Quantity</span> - ${cart_item_data.qty}</li>
                                        </ul>
                                    </div>
                                </div>
                            </td>

                            <td class="price">
                                <h4 class="table-title text-content">Price</h4>
                                <h5>$${parseFloat(cart_item_data.product.selling_price).toFixed(2)}
                                    <del class="text-content">$${parseFloat(cart_item_data.product.price).toFixed(2)}</del>
                                </h5>
                                <h6 class="theme-color">You Save : $${cart_item_data.product.saving_amount} (${cart_item_data.product.saving_percentage}%)</h6>
                            </td>

                            <td class="quantity">
                                <h4 class="table-title text-content"></h4>
                                <div class="quantity-price">
                                    <div class="cart_qty">
                                        <div class="input-group">
                                            <button type="button" class="btn qty-left-minus" data-type="minus" data-product-id="${cart_item_data.id}">
                                                <i class="fa fa-minus ms-0"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text" name="quantity" value="${cart_item_data.qty}">
                                            <button type="button" class="btn qty-right-plus" data-type="plus" data-product-id="${cart_item_data.id}">
                                                <i class="fa fa-plus ms-0"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="subtotal">
                                <h4 class="table-title text-content">Total</h4>
                                <h5>$${cart_item_data.product.grand_total.toFixed(2)}</h5>
                            </td>

                            <td class="save-remove">
                                <h4 class="table-title text-content">Action</h4>
                                <a class="save save-for-later notifi-wishlist" data-cart-id=${cart_item_data.id}>Save for later</a>
                                <a class="remove close_button" data-id="${cart_item_data.id}">Remove</a>
                            </td>
                        </tr>`;
                    });

                    return cartHTML; // Return the dynamically generated cart HTML
                }

                $(document).on('click', '.qty-left-minus, .qty-right-plus', function () {
                    let button = $(this);
                    let input = button.closest('.input-group').find('.qty-input');
                    let qty = parseInt(input.val());
                    let type = button.data('type'); // "plus" or "minus"
                    let productId = button.data('product-id');

                    // Update quantity based on the button type
                    if (type === 'plus') {
                        qty += 1;
                    } else if (type === 'minus' && qty > 1) {
                        qty -= 1;
                    }

                    input.val(qty);

                    $.ajax({
                        url: `/cart/update-quantity/${productId}`,
                        method: "PATCH",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            qty: Number(qty),
                        },
                        success: function (response) {
                            if (response.status) {
                                getCartItems()
                            } else {
                                handleErrors(response);
                            }
                        },
                        error: function (error) {
                            handleErrors(error);
                        },
                    });
                });


                $(document).on('click', '.save-for-later', function (e) {

                    e.preventDefault();

                    let product_id = $(this).data('product-id');
                    let cart_id = $(this).data('cart-id');

                    let qty = $('.qty-input').val();

                    if (!qty || isNaN(qty) || qty <= 0) {
                        showAlert('Error!', 'Quantity must be a valid positive number.', 'error');
                        return; // Stop further execution
                    }

                    let url = `{{ url('/return-to-wishlist/${cart_id}') }}`;

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
                                // Show success alert
                                showAlert('Success!', response.message, 'success');

                                getCartItems();
                            }
                        },
                        error: function (error) {
                            showAlert('Error!', error.responseJSON?.error || 'Something went wrong. Please try again.', 'error');
                        }
                    });
                });


                {{--$('#apply-coupon-form').on('submit', function (e) {--}}

                {{--    e.preventDefault();--}}

                {{--    let coupon = $('#apply-coupon').val();--}}

                {{--    $.ajax({--}}
                {{--        url: "{{route('cart.apply-coupon')}}",--}}
                {{--        type: "POST",--}}
                {{--        data: {--}}
                {{--            _token: $('meta[name="csrf-token"]').attr('content'),--}}
                {{--            coupon: coupon--}}
                {{--        },--}}
                {{--        success: function (response) {--}}
                {{--            if (response.status) {--}}
                {{--                getCartItems();--}}
                {{--            }--}}
                {{--        },--}}
                {{--        error: function (error) {--}}
                {{--            handleErrors(error);--}}
                {{--        }--}}
                {{--    });--}}

                {{--});--}}

            });


        </script>
    @endpush

@endsection

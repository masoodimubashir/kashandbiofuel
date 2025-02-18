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
                                    <a href="{{ route('home') }}">
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
                        <div class="summery-header d-flex justify-content-between align-items-center">
                            <h3>Cart Total</h3>
                            <button class="btn btn-sm d-flex align-items-center gap-2" id="clear-coupon">
                                <i class="fa-solid fa-trash-can"></i>Clear Coupon
                            </button>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <form class="mb-3 coupon-box input-group" id="apply-coupon-form">
                                    <input type="text" class="form-control" id="coupon_code" name="coupon"
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
                                    <h4 class="price" id="coupon-discount">

                                    </h4>
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
                                    <button id="checkout-button" class="btn btn-animation proceed-btn fw-bold">Process
                                        To Checkout
                                    </button>

                                </li>

                                <li>
                                    <button onclick="location.href = '{{ route('home') }}';"
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
            $(document).ready(function() {

                // Global DOM elements
                const checkOutPrice = $('#check_out_price');
                const price = $('#price');
                const couponDiscount = $('#coupon-discount');
                const cartItemsContainer = $('#cart-items');
                const couponInput = $('#apply-coupon-form input[name="coupon"]')

                // Utility Functions
                const showAlert = (title, message, type) => Swal.fire(title, message, type);

                const handleErrors = (error) => {
                    const errorMessage = error?.message || 'Something went wrong.';
                    showAlert('Error!', errorMessage, 'error');
                };

                const renderCartItems = (cartItems) => {
                    let cartHTML = '';

                    cartItems.forEach(cartItem => {
                        cartHTML += `
                <tr class="product-box-contain" data-product-id="${cartItem.id}">
                    <td class="product-detail">
                        <div class="product border-0">
                            <a href="/product/${cartItem.product.slug}" class="product-image">
                               
                            <img src="${cartItem.product.product_attribute?.image_path ? `storage/${cartItem.product.product_attribute.image_path}` : 'default_images/product_image.png'}"
                                class="img-fluid blur-up lazyload" 
                                alt="${cartItem.product.name}"> 
                            </a>
                            <div class="product-detail">
                                <ul>
                                    <li class="name">
                                        <a href="/product/${cartItem.product.slug}">${cartItem.product.name ?? 'Product Name'}</a>
                                    </li>
                                    <li class="text-content">
                                        <span class="text-title">Price Per Item</span> - ${cartItem.product.selling_price}
                                    </li>
                                    <li class="text-content">
                                        <span class="text-title">Quantity</span> - ${cartItem.qty}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="price">
                        <h4 class="table-title text-content">Price</h4>
                        <h5>$${parseFloat(cartItem.product.selling_price).toFixed(2)}
                            <del class="text-content">$${parseFloat(cartItem.product.price).toFixed(2)}</del>
                        </h5>
                        <h6 class="theme-color">You Save: $${cartItem.product.saving_amount} (${cartItem.product.saving_percentage}%)</h6>
                    </td>
                    <td class="quantity">
                        <h4 class="table-title text-content"></h4>
                        <div class="quantity-price">
                            <div class="cart_qty">
                                <div class="input-group">
                                    <button type="button" class="btn qty-left-minus" data-type="minus" data-product-id="${cartItem.id}">
                                        <i class="fa fa-minus ms-0"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text" name="quantity" value="${cartItem.qty}">
                                    <button type="button" class="btn qty-right-plus" data-type="plus" data-product-id="${cartItem.id}">
                                        <i class="fa fa-plus ms-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="subtotal">
                        <h4 class="table-title text-content">Total</h4>
                        <h5>$${cartItem.product.grand_total.toFixed(2)}</h5>
                    </td>
                    <td class="save-remove">
                        <h4 class="table-title text-content">Action</h4>
                        <a class="save save-for-later notifi-wishlist" style="cursor: pointer" data-cart-id="${cartItem.id}">Save for later</a>
                        <a class="remove close_button" data-id="${cartItem.id}">Remove</a>
                    </td>
                </tr>`;
                    });

                    return cartHTML;
                };

                // AJAX Request Functions
                const getCartItems = () => {
                    $.ajax({
                        url: "{{ route('cart.view-cart') }}",
                        type: "GET",
                        success: (response) => {
                            cartItemsContainer.html(renderCartItems(response.data));
                            checkOutPrice.text(`$${response.check_out_price}`);
                            price.text(`$${response.check_out_price}`);
                            couponDiscount.text('$0.00');
                        },
                        error: handleErrors
                    });
                };

                const updateCartQuantity = (productId, qty) => {
                    $.ajax({
                        url: `/cart/update-quantity/${productId}`,
                        method: "PATCH",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            qty: Number(qty)
                        },
                        success: (response) => {
                            if (response.status) {
                                getCartItems();
                            } else {
                                handleErrors(response);
                            }
                        },
                        error: handleErrors
                    });
                };

                const applyCoupon = (couponCode) => {

                    $.ajax({
                        url: "{{ route('apply-coupon') }}",
                        type: "PUT",
                        data: {
                            coupon_code: couponCode
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            cartItemsContainer.html(renderCartItems(response.data));
                            checkOutPrice.text(`$${response.check_out_price.toFixed(2)}`);
                            couponDiscount.text(`$${response.discount?.toFixed(2) ?? '0.00'}`);
                        },
                        error: (xhr) => {
                            console.log(xhr);

                            showAlert('Error!', xhr.responseJSON?.message ||
                                'Failed to apply your coupon.', 'error');
                        }
                    });
                };

                const clearCoupon = () => {
                    $.ajax({
                        url: "{{ route('apply-coupon') }}",
                        type: "PUT",
                        data: {
                            coupon_code: null
                        }, // Clear coupon by sending null
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            cartItemsContainer.html(renderCartItems(response.data));
                            checkOutPrice.text(`$${response.check_out_price.toFixed(2)}`);
                            couponDiscount.text('$0.00'); // Reset the coupon discount
                        },
                        error: () => showAlert('Error!', 'Failed to clear the coupon.', 'error')
                    });
                };

                const deleteCartItem = (cartItemId) => {
                    $.ajax({
                        url: `/cart/delete/${cartItemId}`,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: () => getCartItems(),
                        error: handleErrors
                    });
                };

                // Event Listeners
                getCartItems(); // Load cart items on page ready

                cartItemsContainer.on('click', '.remove', function(e) {
                    e.preventDefault();
                    const cartItemId = $(this).data('id');
                    deleteCartItem(cartItemId);
                });

                $(document).on('click', '.qty-left-minus, .qty-right-plus', function() {
                    const button = $(this);
                    const input = button.closest('.input-group').find('.qty-input');
                    let qty = parseInt(input.val());
                    const type = button.data('type');
                    const productId = button.data('product-id');

                    qty = type === 'plus' ? qty + 1 : qty > 1 ? qty - 1 : qty;
                    input.val(qty);
                    updateCartQuantity(productId, qty);
                });

                $(document).on('click', '#clear-coupon', function(e) {
                    e.preventDefault();
                    couponInput.val('');

                    clearCoupon();
                });

                $('#apply-coupon-form').on('submit', function(e) {

                    e.preventDefault();
                    const couponCode = $('#coupon_code').val();
                    if (!couponCode) {
                        showAlert('Error', 'Please enter a valid coupon code', 'error');
                        return;
                    }

                    applyCoupon(couponCode);
                });

                $('#checkout-button').on('click', function() {

                    const checkOutPrice = $('#check_out_price').text().replace(/[^\d.-]/g, '');

                    const cartDetails = [];
                    $('#cart-items .product-box-contain').each(function() {
                        const cartId = $(this).data('product-id');
                        if (cartId) cartDetails.push(cartId);
                    });

                    window.location.href =
                        `{{ route('checkout.index') }}?cart_ids=${cartDetails.join(',')}&checkout_price=${checkOutPrice}`;
                });

                $(document).on('click', '.save-for-later', function(e) {
                    e.preventDefault();

                    const cartId = $(this).data('cart-id'); // Get cart item ID from `data-cart-id`
                    const route = `/return-to-wishlist/${cartId}`;

                    $.ajax({
                        url: route,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(response) {
                            if (response.status) {
                                showAlert('Success!', response.message, 'success');
                                getCartItems();
                            } else {
                                showAlert('Error!', response.message || 'Something went wrong.',
                                    'error');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            showAlert('Error!',
                                'Unable to process your request. Please try again later.',
                                'error');
                        }
                    });
                });


            });
        </script>
    @endpush
@endsection

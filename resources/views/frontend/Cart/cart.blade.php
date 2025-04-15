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

                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (INR)</h4>
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
                // DOM Elements
                const elements = {
                    checkOutPrice: $('#check_out_price'),
                    price: $('#price'),
                    couponDiscount: $('#coupon-discount'),
                    cartItemsContainer: $('#cart-items'),
                    couponInput: $('#coupon_code'),
                    couponForm: $('#apply-coupon-form'),
                    checkoutButton: $('#checkout-button'),
                    clearCouponBtn: $('#clear-coupon')
                };

                // Utility Functions
                const utils = {
                    showAlert: (title, message, type) => Swal.fire(title, message, type),
                    handleErrors: (error) => utils.showAlert('Error!', error.responseJSON?.message ||
                        'Something Went Wrong', 'error')
                };

                // Cart Item Template
                const renderCartItems = (cartItems) => {
                    return cartItems.map(cartItem => `
                        <tr class="product-box-contain" data-product-id="${cartItem.id}">
                            <td class="product-detail">
                                <div class="product border-0">
                                    <a href="/product/${cartItem.product.slug}" class="product-image">
                                    <img src="${cartItem.product.product_attribute.image_path ? `storage/${cartItem.product.product_attribute.image_path}` : 'default_images/product_image.png'}"
                                        class="img-fluid blur-up lazyload" alt="${cartItem.product.name}">
                                    </a>
                                    <div class="product-detail">
                                        <ul>
                                            <li class="name">
                                                <a href="/product/${cartItem.product.slug}">${cartItem.product.name}</a>
                                            </li>
                                            <li class="text-content">
                                                <span class="text-title">Price Per Item</span> - &#8377;${cartItem.product.selling_price}
                                            </li>
                                            <li class="text-content">
                                                <span class="text-title">Quantity (MAX)</span> - ${cartItem.product.product_attribute.qty}
                                            </li>
                                            <li class="color-swatch mt-1"
                                                style="background-color: ${cartItem.product.product_attribute.hex_code};
                                                    width: 25px;
                                                    height: 25px;
                                                    display: inline-block;
                                                    border-radius: 50%;"
                                                title="Color: ${cartItem.product.product_attribute.hex_code}"
                                                data-product-attribute-id="${cartItem.product_attribute_id}">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                            <td class="price">
                                <h4 class="table-title text-content">Price</h4>
                                <h5>&#8377;${cartItem.product.selling_price}
                                    <del class="text-content">&#8377;${cartItem.product.price}</del>
                                </h5>
                                <h6 class="theme-color">You Save: &#8377;${cartItem.product.saving_amount} (${cartItem.product.saving_percentage}%)</h6>
                            </td>
                            <td class="quantity">
                                <div class="quantity-price">
                                    <div class="cart_qty">
                                        <div class="input-group">
                                            <button type="button" class="btn qty-left-minus" data-type="minus" data-product-id="${cartItem.id}">
                                                <i class="fa fa-minus ms-0"></i>
                                            </button>
                                            <input class="form-control input-number qty-input" type="text" name="quantity"
                                                min="0" max="${cartItem.product.product_attribute.qty}" value="${cartItem.qty}">
                                            <button type="button" class="btn qty-right-plus" data-type="plus" data-product-id="${cartItem.id}">
                                                <i class="fa fa-plus ms-0"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="subtotal">
                                <h4 class="table-title text-content">Total</h4>
                                <h5>&#8377;${cartItem.product.grand_total.toFixed(2)}</h5>
                            </td>
                            <td class="save-remove">
                                <h4 class="table-title text-content">Action</h4>
                                <a class="save save-for-later notifi-wishlist" style="cursor: pointer"
                                    data-product-id=${cartItem.product_id}
                                    data-cart-id="${cartItem.id}">Add To Wishlist
                                </a>
                                <a class="remove close_button" data-id="${cartItem.id}">Remove</a>
                            </td>
                        </tr>
                    `).join('');
                };

                // Cart Actions
                const cartActions = {
                    getCartItems: () => {
                        $.ajax({
                            url: "{{ route('cart.view-cart') }}",
                            type: "GET",
                            success: (response) => {
                                elements.cartItemsContainer.html(renderCartItems(response.data));
                                elements.checkOutPrice.text(`₹${response.check_out_price}`);
                                elements.price.text(`₹${response.check_out_price}`);
                                elements.couponDiscount.text('₹0.00');
                            },
                            error: utils.handleErrors
                        });
                    },

                    updateQuantity: (productId, qty, product_attribute_id, input) => {
                        $.ajax({
                            url: `/cart/update-quantity/${productId}`,
                            method: "PATCH",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                qty,
                                product_attribute_id
                            },
                            success: (response) => {
                                if (response.status) cartActions.getCartItems();
                            },
                            error: (error) => {
                                utils.handleErrors(error);
                                input.val(qty - 1);
                            }
                        });
                    },

                    deleteItem: (cartItemId) => {
                        $.ajax({
                            url: `/cart/delete/${cartItemId}`,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: () => cartActions.getCartItems(),
                            error: utils.handleErrors
                        });
                    },

                    saveForLater: (cartId, product_attribute_id, product_id) => {
                        $.ajax({
                            url: `/return-to-wishlist/${cartId}`,
                            type: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                product_attribute_id,
                                product_id
                            },
                            success: (response) => {
                                if (response.status) {
                                    utils.showAlert('Success!', response.message, 'success');
                                    cartActions.getCartItems();
                                }
                            },
                            error: utils.handleErrors
                        });
                    },

                    applyCoupon: (couponCode) => {
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
                                elements.cartItemsContainer.html(renderCartItems(response.data));
                                elements.checkOutPrice.text(
                                    `₹${response.check_out_price.toFixed(2)}`);
                                elements.couponDiscount.text(
                                    `₹${response.discount?.toFixed(2) ?? '0.00'}`);
                                utils.showAlert('Success!', 'Coupon applied successfully',
                                    'success');
                            },
                            error: utils.handleErrors
                        });
                    },

                    clearCoupon: () => {

                        // Get the current coupon discount value and convert it to a number
                        const currentDiscount = parseFloat(elements.couponDiscount.text().replace(/[^\d.-]/g,
                            ''));

                        // Check if there's any discount applied
                        if (currentDiscount <= 0) {
                            // No coupon applied, show message and return
                            utils.showAlert('Info', 'There is no coupon to be cleared', 'info');
                            return;
                        }

                        // If there is a coupon (discount > 0), proceed with removing it
                        $.ajax({
                            url: "{{ route('apply-coupon') }}",
                            type: "PUT",
                            data: {
                                coupon_code: null
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: (response) => {
                                elements.cartItemsContainer.html(renderCartItems(response.data));
                                elements.checkOutPrice.text(
                                    `₹${response.check_out_price.toFixed(2)}`);
                                elements.couponDiscount.text('₹0.00');
                                elements.couponInput.val('');
                                utils.showAlert('Success!', 'Coupon removed successfully',
                                    'success');
                            },
                            error: utils.handleErrors
                        });
                    },





                    proceedToCheckout: () => {
                        const cartItems = [];

                        $('#cart-items .product-box-contain').each(function() {
                            cartItems.push({
                                cart_id: $(this).data('product-id'),
                                product_attribute_id: $(this).find('.color-swatch').data(
                                    'product-attribute-id')
                            });
                        });

                        const queryParams = new URLSearchParams({
                            cart_data: JSON.stringify(cartItems),
                            checkout_price: elements.checkOutPrice.text().replace(/[^\d.-]/g, '')
                        });

                        window.location.href = `{{ route('checkout.index') }}?${queryParams.toString()}`;
                    }

                };

                // Event Handlers
                elements.couponForm.on('submit', function(e) {
                    e.preventDefault();
                    const couponCode = elements.couponInput.val();
                    if (!couponCode) {
                        utils.showAlert('Error', 'Please enter a valid coupon code', 'error');
                        return;
                    }
                    cartActions.applyCoupon(couponCode);
                });

                elements.clearCouponBtn.on('click', function(e) {
                    e.preventDefault();
                    cartActions.clearCoupon();
                });

                elements.checkoutButton.on('click', cartActions.proceedToCheckout);

                $(document).on('click', '.qty-left-minus, .qty-right-plus', function() {
                    const button = $(this);
                    const input = button.closest('.input-group').find('.qty-input');
                    const product_attribute_id = button.closest('tr').find('.color-swatch').data(
                        'product-attribute-id');
                    let qty = parseInt(input.val());
                    const type = button.data('type');

                    qty = type === 'plus' ? qty + 1 : qty > 1 ? qty - 1 : qty;
                    input.val(qty);

                    cartActions.updateQuantity(button.data('product-id'), qty, product_attribute_id, input);
                });

                $(document).on('click', '.save-for-later', function(e) {
                    e.preventDefault();
                    cartActions.saveForLater(
                        $(this).data('cart-id'),
                        $(this).closest('tr').find('.color-swatch').data('product-attribute-id'),
                        $(this).data('product-id')
                    );
                });

                $(document).on('click', '.remove', function(e) {
                    e.preventDefault();
                    cartActions.deleteItem($(this).data('id'));
                });

                // Initialize
                cartActions.getCartItems();
            });
        </script>
    @endpush
@endsection

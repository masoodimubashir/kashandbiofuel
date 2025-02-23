@extends('welcome')
@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                            trigger="loop-on-hover"
                                            colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a" class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">


                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-12" id="address-list">
                                                    @if ($address)
                                                        <div class="delivery-address-box">
                                                            <div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="address" value="{{ $address->id }}"
                                                                        checked />
                                                                    <!-- Automatically selects the first address -->
                                                                </div>
                                                                <div class="label">
                                                                    <label>{{ $address->state }}
                                                                        , {{ $address->city }}</label>
                                                                </div>
                                                                <ul class="delivery-address-detail">
                                                                    <li>
                                                                        <h4 class="fw-500">{{ $address->address }}</h4>
                                                                    </li>
                                                                    <li>
                                                                        <h6 class="text-content"><span
                                                                                class="text-title">Phone:
                                                                            </span>{{ $address->phone }}
                                                                        </h6>
                                                                    </li>
                                                                    <li>
                                                                        <h6 class="text-content mb-0"><span
                                                                                class="text-title">Pin Code:
                                                                            </span>{{ $address->pin_code }}
                                                                        </h6>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="text-danger">
                                                            Add an address to continue.
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                            trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Payment Option</h4>
                                        </div>

                                        <div class="checkout-detail">
                                            <div class="accordion accordion-flush custom-accordion"
                                                id="accordionFlushExample">

                                                <div class="accordion-item col-md-6">
                                                    <div class="accordion-header" id="flush-headingFour">
                                                        <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseFour">
                                                            <div class="custom-form-check form-check mb-0">
                                                                <label class="form-check-label" for="cash">
                                                                    <input class="form-check-input mt-0" type="radio"
                                                                        value="cod" name="flexRadioDefault"
                                                                        id="cash" checked>
                                                                    Cash On Delivery
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="accordion-item col-md-6">
                                                    <div class="accordion-header" id="flush-headingOne">
                                                        <div class="accordion-button collapsed" data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseOne">
                                                            <div class="custom-form-check form-check mb-0">
                                                                <label class="form-check-label" for="credit"><input
                                                                        class="form-check-input mt-0" type="radio"
                                                                        value="online" name="flexRadioDefault"
                                                                        id="credit">
                                                                    Pay Online
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Order Summery</h3>
                            </div>

                            <ul id="summery-contain" class="summery-contain">
                                <!-- Dynamic cart items will be appended here -->
                            </ul>

                            <ul class="summery-total">
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">

                                    </h4>
                                </li>

                                <li class="list-total">
                                    <h4>Total (INR)</h4>
                                    <h4 class="price" id="cart-total-price">
                                        ₹0
                                    </h4>
                                </li>

                            </ul>
                        </div>
                        <a href="{{ route('payment.redirect') }}" id="placeOrderButton"
                            class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Place Order</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->


    @push('frontend.scripts')
        <script>
            $(document).ready(function() {
                const urlParams = new URLSearchParams(window.location.search);
                const cartData = JSON.parse(urlParams.get('cart_data'));
                const checkoutPrice = urlParams.get('checkout_price');

                const config = {
                    urls: {
                        checkout: "{{ route('checkout.index') }}",
                        phonepe: "{{ route('checkout.phonepe.store') }}",
                        cashOnDelivery: "{{ route('checkout.cash-on-delivery') }}"
                    },
                    cartData: {
                        data: cartData,
                        totalPrice: checkoutPrice
                    }
                };

                const elements = {
                    summaryContainer: $('#summery-contain'),
                    totalPriceElement: $('#cart-total-price'),
                    placeOrderButton: $('#placeOrderButton'),
                    paymentMethod: $('input[name="flexRadioDefault"]'),
                    addressInput: $('input[name="address"]')
                };

                const templates = {
                    cartItem: (item) => `
            <li>
                <img src="${item.product.product_attribute.image_path ? `/storage/${item.product.product_attribute.image_path}` : '/default_images/product_image.png'}"
                    class="img-fluid blur-up lazyloaded checkout-image"
                    alt="${item.product.name}">
                <h4>${item.product.name} <span>X ${item.qty}</span></h4>
                <h4 class="price">₹${(item.product.selling_price * item.qty).toFixed(2)}</h4>
            </li>`
                };

                const cartActions = {
                    renderSummary: (cartItems, totalPrice) => {
                        elements.summaryContainer.html(cartItems.map(item => templates.cartItem(item)).join(
                            ''));
                        elements.totalPriceElement.text(`₹${parseFloat(totalPrice).toFixed(2)}`);
                    },

                    fetchSummary: () => {
                        $.ajax({
                            url: config.urls.checkout,
                            type: "GET",
                            data: {
                                cart_data: config.cartData.data,
                                checkout_price: config.cartData.totalPrice
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: (response) => {
                                if (response.status) {
                                    cartActions.renderSummary(response.cart_items, response
                                        .checkout_price);
                                } else {
                                    utils.showError('Something went wrong', response.message);
                                }
                            },
                            error: (error) => utils.showError('Error', error.responseJSON?.message)
                        });
                    }
                };

                const orderProcessor = {

                    validateOrder: () => {
                        const selectedAddress = elements.addressInput.filter(':checked').val();

                        const paymentMethod = elements.paymentMethod.filter(':checked').val();

                        if (!selectedAddress || selectedAddress === undefined) {
                            utils.showError('Error', 'Please select an address to continue.');
                            return false;
                        }
                        if (!paymentMethod || paymentMethod === undefined) {
                            utils.showError('Error', 'Please select a payment method to continue.');
                            return false;
                        }
                        if (!config.cartData.totalPrice) {
                            utils.showError('Error', 'Please add items to cart to continue.');
                            return false;
                        }

                        return true;
                    },

                    processOrder: (paymentMethod) => {
                        const orderData = {
                            cart_data: config.cartData.data,
                            total_price: config.cartData.totalPrice,
                            address_id: elements.addressInput.filter(':checked').val(),
                            payment_method: paymentMethod
                        };

                        const url = paymentMethod === 'online' ? config.urls.phonepe : config.urls
                            .cashOnDelivery;

                        $.ajax({
                            url: url,
                            type: "POST",
                            data: orderData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: () => utils.updateButton(true),
                            success: (response) => {
                                if (response.status) {
                                    window.location.href = response.redirect_url;
                                } else {
                                    utils.showError('Error', response.message);
                                }
                            },
                            error: (xhr) => utils.showError('Error', 'Failed to place the order'),
                            complete: () => utils.updateButton(false)
                        });
                    }
                };

                const utils = {
                    showError: (title, message) => Swal.fire(title, message, 'error'),
                    updateButton: (processing) => {
                        elements.placeOrderButton
                            .text(processing ? 'Processing...' : 'Place Order')
                            .prop('disabled', processing);
                    }
                };

                elements.placeOrderButton.on('click', function(e) {
                    e.preventDefault();
                    if (orderProcessor.validateOrder()) {
                        const paymentMethod = elements.paymentMethod.filter(':checked').val();
                        orderProcessor.processOrder(paymentMethod);
                    }
                });

                cartActions.fetchSummary();
            });
        </script>
    @endpush
@endsection

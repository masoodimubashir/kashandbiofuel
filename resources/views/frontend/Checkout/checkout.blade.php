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
                                                   colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                   class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">


                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                <div class="col-12" id="address-list">
                                                    @if($address)
                                                        <div class="delivery-address-box">
                                                            <div>
                                                                <div class="form-check">
                                                                    <input
                                                                        class="form-check-input"
                                                                        type="radio"
                                                                        name="address"
                                                                        value="{{$address->id}}"
                                                                        checked/>
                                                                    <!-- Automatically selects the first address -->
                                                                </div>
                                                                <div class="label">
                                                                    <label>{{$address->state}}
                                                                        , {{$address->city}}</label>
                                                                </div>
                                                                <ul class="delivery-address-detail">
                                                                    <li>
                                                                        <h4 class="fw-500">{{$address->address}}</h4>
                                                                    </li>
                                                                    <li>
                                                                        <h6 class="text-content"><span
                                                                                class="text-title">Phone: </span>{{$address->phone}}
                                                                        </h6>
                                                                    </li>
                                                                    <li>
                                                                        <h6 class="text-content mb-0"><span
                                                                                class="text-title">Pin Code: </span>{{$address->pin_code}}
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
                                                        <div class="accordion-button collapsed"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#flush-collapseFour">
                                                            <div class="custom-form-check form-check mb-0">
                                                                <label class="form-check-label" for="cash">
                                                                    <input class="form-check-input mt-0" type="radio"
                                                                           value="cod"
                                                                           name="flexRadioDefault" id="cash" checked>
                                                                    Cash On Delivery
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="accordion-item col-md-6">
                                                    <div class="accordion-header" id="flush-headingOne">
                                                        <div class="accordion-button collapsed"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#flush-collapseOne">
                                                            <div class="custom-form-check form-check mb-0">
                                                                <label class="form-check-label" for="credit"><input
                                                                        class="form-check-input mt-0" type="radio"
                                                                        value="online"
                                                                        name="flexRadioDefault" id="credit">
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
                        <a href="javascript:void(0);" id="placeOrderButton"
                           class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">Place Order</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->


    @push('frontend.scripts')
        <script>

            const cartIds = '{{ request('cart_ids') }}'.split(',') || [];
            const totalPrice = '{{ request('checkout_price') }}' || 0;


            // Render Cart Summary
            const renderCartSummary = (cartItems, totalPrice) => {
                const summaryContainer = $('#summery-contain');
                const totalPriceElement = $('#cart-total-price');

                summaryContainer.html(''); // Clear previous summary

                cartItems.forEach(cartItem => {
                    const productName = cartItem.product.name ?? 'Unknown Product';
                    const quantity = cartItem.qty ?? 1;
                    const price = (cartItem.product.selling_price * quantity).toFixed(2);
                    const productImage = cartItem.product.product_attribute?.image_path;
                    const cartItemHTML = `
            <li>
                <img src="/storage/${productImage}"
                     class="img-fluid blur-up lazyloaded checkout-image"
                     alt="${productName}">
                <h4>${productName} <span>X ${quantity}</span></h4>
                <h4 class="price">₹${price}</h4>
            </li>`;
                    summaryContainer.append(cartItemHTML);
                });

                totalPriceElement.text(`₹${parseFloat(totalPrice).toFixed(2)}`);
            };

            // Fetch Cart Items and Render the Summary
            const fetchCartSummary = (cartIds, totalPrice) => {

                $.ajax({
                    url: "{{ route('checkout.index') }}",
                    type: "GET",
                    data: {
                        cart_ids: cartIds.join(','),
                        total_price: totalPrice,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        if (response.status) {
                            renderCartSummary(response.cart_items, response.checkout_price);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong',
                                text: response.message
                            });
                        }
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something went wrong',
                            text: error.responseJSON?.message ?? 'An error occurred. Please try again!',
                        });
                    }
                });
            };

            // Place Order Functionality
            $('#placeOrderButton').click(function (e) {
                e.preventDefault();

                const paymentMethod = $('input[name="flexRadioDefault"]:checked').val();

                const selectedAddress = $('input[name="address"]:checked').val();

                if (!selectedAddress) {
                    Swal.fire('Error', 'Please select an address to continue.', 'error');
                    return;
                }
                if (!paymentMethod) {
                    Swal.fire('Error', 'Please select a payment method to continue.', 'error');
                    return;
                }
                if (!totalPrice) {
                    Swal.fire('Error', 'Please add items to cart to continue.', 'error');
                    return;
                }

                const orderData = {
                    cart_ids: cartIds.join(','),
                    total_price: totalPrice,
                    address: selectedAddress,
                    payment_method: paymentMethod
                };


                const url = "{{ route('checkout.phonepe.store') }}";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: orderData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // Include CSRF token
                    },
                    beforeSend: function () {
                        $('#placeOrderButton').text('Processing...').prop('disabled', true); // Update button state
                    },
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.redirect_url;
                        } else {
                            Swal.fire('Error', response.message || 'Failed to place the order. Please try again.', 'error');
                        }
                    },
                    error: function (xhr) {
                        console.error("Error placing order:", xhr.responseText);
                        Swal.fire('Error', 'Failed to place the order. Please try again.', 'error');
                    },
                    complete: function () {
                        $('#placeOrderButton').text('Place Order').prop('disabled', false); // Reset button state
                    }
                });
            });

            // On Document Ready
            $(document).ready(function () {
                fetchCartSummary(cartIds, totalPrice); // Fetch and display cart summary
            });
        </script>
    @endpush
@endsection

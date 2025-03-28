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
                        <a id="placeOrderButton" class="btn theme-bg-color text-white btn-md w-100 mt-4 mb-4 fw-bold">Place
                            Order
                        </a>

                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0  w-100" data-bs-toggle="modal"
                            data-bs-target="#editProfile"><i data-feather="plus" class="me-2"></i> Add New Address

                        </button>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Checkout section End -->

    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="addressForm">

                        <input type="hidden" id="address_id" name="address_id">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter your address">
                                    <label for="address">Address</label>
                                    <div class="invalid-feedback" id="addressError"></div>
                                </div>
                            </div>

                            {{-- City Field --}}
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="Enter your city">
                                    <label for="city">City</label>
                                    <div class="invalid-feedback" id="cityError"></div>
                                </div>
                            </div>

                            {{-- State Field --}}
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="Enter your state">
                                    <label for="state">State</label>
                                    <div class="invalid-feedback" id="stateError"></div>
                                </div>
                            </div>

                            {{-- Pin Code Field --}}
                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="pin_code" name="pin_code"
                                        placeholder="Enter your pin code">
                                    <label for="pin_code">Pin Code</label>
                                    <div class="invalid-feedback" id="pinCodeError"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating theme-form-floating">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter phone number">
                                    <label for="phone">Phone Number</label>
                                    <div class="invalid-feedback" id="phoneError"></div>
                                </div>
                            </div>

                        </div>

                        <button type="button" class="btn theme-bg-color btn-md fw-bold text-light mt-2"
                            id="submitAddress">Save Address
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('frontend.scripts')
        <script>
            $(document).ready(function() {

                const urlParams = new URLSearchParams(window.location.search);
                const cartData = JSON.parse(urlParams.get('cart_data'));
                const checkoutPrice = urlParams.get('checkout_price');

                const config = {
                    urls: {
                        checkout: "{{ route('checkout.index') }}",
                        phonepe: "{{ route('checkout.phonepe.store') }}"
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
                    addressInput: $('input[name="address"]')
                };


                const templates = {
                    cartItem: (item) => {

                        let html = '';


                        // Find the selected attribute for this cart item
                        const selectedAttribute = item.product.product_attributes.find(attribute => attribute
                            .id === item.product_attribute_id);


                        // Get color information if available
                        const colorInfo = selectedAttribute && selectedAttribute.hex_code ?
                            `<span class="color-indicator" style="background-color: ${selectedAttribute.hex_code}"></span>` :
                            '';

                        html += `
                                <li>
                                    <h4>
                                    ${item.product.name} 
                                    ${colorInfo}
                                    <span>X ${item.qty}</span>
                                    </h4>
                                    <h4 class="price">₹${(parseFloat(item.product.selling_price) * item.qty).toFixed(2)}</h4>
                            </li>`;


                        return html;
                    }
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

                        if (!selectedAddress || selectedAddress === undefined) {
                            utils.showError('Error', 'Please select an address to continue.');
                            return false;
                        }

                        if (!config.cartData.totalPrice) {
                            utils.showError('Error', 'Please add items to cart to continue.');
                            return false;
                        }

                        return true;
                    },

                    processOrder: () => {
                        const orderData = {
                            cart_data: config.cartData.data,
                            total_price: config.cartData.totalPrice,
                            address_id: elements.addressInput.filter(':checked').val(),
                        };



                        $.ajax({
                            url: config.urls.phonepe,
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
                        orderProcessor.processOrder();
                    }
                });


                cartActions.fetchSummary();

                function resetFormAndErrors() {
                    $('.invalid-feedback').text('');
                    $('.form-control').removeClass('is-invalid');
                    $('#addressForm')[0].reset();
                    $('#address_id').val(''); // Clear the hidden address ID field
                }

                $('#submitAddress').on('click', function(e) {
                    e.preventDefault();

                    const addressId = $('#address_id').val();

                    let formData = {
                        address: $('#address').val(),
                        city: $('#city').val(),
                        state: $('#state').val(),
                        pin_code: $('#pin_code').val(),
                        phone: $('#phone').val(),
                    };

                    const isEdit = !!addressId;
                    const url = isEdit ? `/user/address/${addressId}` : '{{ route('address.store') }}';
                    const method = isEdit ? 'PUT' : 'POST';

                    $.ajax({
                        type: method,
                        url: url,
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });

                                $('#editProfile').modal('hide');
                                resetFormAndErrors();
                                window.location.reload();
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $(`#${key}Error`).text(value[0]);
                                    $(`#${key}`).addClass('is-invalid');
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong. Please try again later.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                });


            });
        </script>
    @endpush
@endsection

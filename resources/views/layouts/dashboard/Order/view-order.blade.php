<x-app-layout>


    <style>
        .progress-tracker {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .progress-step {
            text-align: center;
            position: relative;
            flex: 1;
        }

        .progress-step::after {
            content: '';
            position: absolute;
            top: 30px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #e9ecef;
        }

        .progress-step:last-child::after {
            display: none;
        }

        .step-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            position: relative;
            z-index: 1;
        }

        .progress-step.active .step-icon {
            background: #0d6efd;
            color: white;
        }

        .color-swatch {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Order #{{ $order['custom_order_id'] }}</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Orders</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Action Bar -->
    @if (!$order['is_shipped'])
        <button class="btn btn-primary" id="pushToShiprocket" data-id="{{ $order['id'] }}">
            <i class="fas fa-shipping-fast me-2"></i>Push To Shiprocket
        </button>
    @endif

    @if (!$order['is_delivered'])
        <button class="deliverOrderBtn btn btn-primary" data-id="{{ $order['id'] }}" data-field="is_delivered">Mark as Delivered</button>
    @endif


    <div class="row mt-3">
        <div class="col-lg-8">
            <!-- Order Progress -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Order Progress</h5>
                    <div class="progress-tracker mt-4">
                        <div class="progress-step {{ $order['is_confirmed'] ? 'active' : '' }}">
                            <div class="step-icon"><i class="fas fa-check"></i></div>
                            <div class="step-text">Confirmed</div>
                        </div>
                        <div class="progress-step {{ $order['transaction_id'] ? 'active' : '' }}">
                            <div class="step-icon"><i class="fas fa-money-bill"></i></div>
                            <div class="step-text">Payment Received</div>
                        </div>
                        <div class="progress-step {{ $order['is_shipped'] ? 'active' : '' }}">
                            <div class="step-icon"><i class="fas fa-box"></i></div>
                            <div class="step-text">Shipped</div>
                        </div>
                        <div class="progress-step {{ $order['is_delivered'] ? 'active' : '' }}">
                            <div class="step-icon"><i class="fas fa-home"></i></div>
                            <div class="step-text">Delivered</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"> Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>QTY</th>
                                    <th>RATE</th>
                                    <th>Color</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order['orderedItems'] as $item)
                                    @foreach ($item['attributes'] as $attribute)
                                        <tr>
                                            @if ($loop->first)
                                                <td rowspan="{{ count($item['attributes']) }}">
                                                    {{ $item['product_name'] }}</td>
                                            @endif
                                            <td>{{ $attribute['qty'] }}</td>
                                            <td>{{ Number::currency($item['selling_price']) }}</td>
                                            <td>
                                                <div class="color-swatch"
                                                    style="width: 16px; height: 16px; border-radius: 50%; background-color: {{ $attribute['hex_code'] }}">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>Order ID</span>
                        <span class="fw-bold">{{ $order['custom_order_id'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Date</span>
                        <span>{{ $order['date_of_purchase'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Transaction ID</span>
                        <span>{{ $order['transaction_id'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Tracking ID</span>
                        <span>{{ $order['tracking_id'] }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Refund Status</span>
                        <span>{{ $order['refund_status'] }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Total Amount</span>
                        <span class="fw-bold">{{ Number::currency($order['total_amount']) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Details -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Customer Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $order['image'] ?? asset('default_images/product_image.png') }}"
                            class="rounded-circle me-3" style="width: 64px" alt="">
                        <div>
                            <h6 class="mb-1">{{ $order['name'] }}</h6>
                            <a href="mailto:{{ $order['email'] }}">{{ $order['email'] }}</a>
                        </div>
                    </div>

                    <h6 class="mb-2">Contact</h6>
                    <p>{{ $order['phone'] }}</p>

                    <h6 class="mb-2">Shipping Address</h6>
                    <p class="mb-1">{{ $order['full_address'] }}</p>
                    <p>{{ $order['pincode'] }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>



    @push('dashboard.script')
        <script>
            $(document).ready(function() {

                $(document).on('click', '#pushToShiprocket', function(e) {

                    const orderId = $(this).data('id');
                    const button = $(this);

                    button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

                    $.ajax({
                        url: `/admin/order/push-to-shiprocket/${orderId}`,
                        method: 'POST',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);

                            if (response.success) {
                                Swal.fire('Success', response.message, 'success');
                                window.location.reload();
                            } else if (response.status === 422) {
                                Swal.fire('Error', response.errors, 'error');
                            }
                        },
                        error: function(error) {
                            Swal.fire('Error', error.responseJSON.message ||
                                'Failed to push order to ShipRocket', 'error');
                        },
                        complete: function() {
                            button.prop('disabled', false).html('Push to ShipRocket');
                        }
                    });
                });


                $('.deliverOrderBtn').on('click', function() {

                    let orderId = $(this).data('id');
                    let field = $(this).data('field');

                    $.ajax({
                        url: `/admin/order/${orderId}`,
                        type: 'PUT',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            field: field, 
                            value: 1 
                        },
                        success: function(response) {
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                            if (response.status) {
                                Swal.fire("Success!", response.message, "success");
                            } else {
                                Swal.fire("Error!", response.message || 'Failed To Update Status',
                                    "error");
                            }
                        },
                        error: function(err) {
                            Swal.fire("Error!", 'An error occurred', "error");
                        }
                    });
                });
            });
        </script>
    @endpush


</x-app-layout>

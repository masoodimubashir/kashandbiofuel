<x-app-layout>

    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Order Detail</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item {{ Request::routeIs('order.index') ? 'active' : '' }}">
                        Orders
                    </li>
                </ol>
            </div>
        </div>
    </x-slot>



    <div class="container-fluid">



        <div class="row">
            <div class="col-sm-12 mb-3 mt-3">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-2 mb-3">
                        <div class="card-body">
                            <button class="btn btn-primary w-100" id="pushToShiprocket" data-id="{{ $order->id }}">
                                Push To Shiprocket
                            </button>
                        </div>
                    </div>

                    {{-- <div class="col-12 col-sm-4 col-md-2 mb-3">
                        <div class="card-body">
                            <button class="btn btn-primary w-100" id="pushToShiprocket" data-id="{{ $order->id }}">
                                Cancel
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-2 mb-3">
                        <div class="card-body">
                            <button class="btn btn-primary w-100" id="pushToShiprocket" data-id="{{ $order->id }}">
                                Confirm
                            </button>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-2 mb-3">
                        <div class="card-body">
                            <button class="btn btn-primary w-100" id="pushToShiprocket" data-id="{{ $order->id }}">
                                Deliver
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>


            <div class="col-xl-9 col-lg-8">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">
                                <span class="border border-warning text-warning fs-13 px-2 py-1 rounded">
                                    {{ $order->status }}
                                </span>
                                <p class="mb-0">Order / Order Details / - {{ $order->custom_order_id }} <td> </td>
                                </p>
                            </div>

                            <div class="mt-4">
                                <h4 class="fw-medium text-dark">Progress</h4>
                            </div>

                            <div class="row row-cols-xxl-5 row-cols-md-2 row-cols-1">
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Order Confirming</p>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success"
                                            role="progressbar" style="width: 100%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Payment Pending</p>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-warning"
                                            role="progressbar" style="width: 60%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <p class="mb-0">Processing</p>
                                        <div class="spinner-border spinner-border-sm text-warning" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Shipping</p>
                                </div>
                                <div class="col">
                                    <div class="progress mt-3" style="height: 10px;">
                                        <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary"
                                            role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0"
                                            aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="mb-0 mt-2">Delivered</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <input type="hidden" value="{{ $order->id }}">
                    <div class="col-sm-12">

                        <div class="card">

                            <div class="card-body">

                                <div class="row">

                                    <div class="order-history table-responsive wishlist custom-scrollbar">

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Product Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($order->orderedItems as $item)
                                                    <tr>

                                                        <td class="text-center">
                                                            @isset($item->product->productAttribute->image_path)
                                                                <img class="img-fluid img-40"
                                                                    src="{{ asset('storage/' . $item->product->productAttribute->image_path) }}"
                                                                    alt="#">
                                                            @else
                                                                <img src="{{ asset('default_images/product_image.png') }}"
                                                                    class="img-fluid img-50"
                                                                    alt="{{ $item->product->name }}">
                                                            @endisset
                                                        </td>

                                                        <td>
                                                            <div class="product-name"><a
                                                                    href="#">{{ $item->product->name }}</a>
                                                            </div>
                                                        </td>

                                                        <td>{{ Number::currency($item->product->selling_price) }}</td>

                                                        <td>
                                                            <fieldset class="qty-box">
                                                                <div class="input-group">
                                                                    <input class="touchspin text-center"
                                                                        type="text" value="{{ $item->quantity }}">
                                                                </div>
                                                            </fieldset>
                                                        </td>


                                                        <td>
                                                            {{ Number::currency($item->price, 'INR') }}
                                                        </td>
                                                    </tr>
                                                @endforeach



                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card bg-light-subtle">
                        <div class="card-body">
                            <div class="row g-3 g-lg-0">
                                <div class="col-lg-3 border-end">
                                    <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                        <div>
                                            <p class="text-dark fw-medium fs-16 mb-1">Date Of Purchase</p>
                                            <p class="mb-0">
                                                {{ $order->date_of_purchase }}
                                            </p>
                                        </div>
                                        <div
                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:calendar-date-bold-duotone"
                                                class="fs-35 text-primary"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 border-end">
                                    <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                        <div>
                                            <p class="text-dark fw-medium fs-16 mb-1">Customer Id</p>
                                            <p class="mb-0">
                                                {{ $order->custom_order_id }}
                                            </p>
                                        </div>
                                        <div
                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:user-circle-bold-duotone"
                                                class="fs-35 text-primary"></iconify-icon>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 border-end">
                                    <div class="d-flex align-items-center gap-3 justify-content-between px-3">
                                        <div>
                                            <p class="text-dark fw-medium fs-16 mb-1">Transaction Id</p>
                                            <p class="mb-0">
                                                {{ $order->transaction->transaction_id }}

                                            </p>
                                        </div>
                                        <div
                                            class="avatar bg-light d-flex align-items-center justify-content-center rounded">
                                            <iconify-icon icon="solar:user-circle-bold-duotone"
                                                class="fs-35 text-primary"></iconify-icon>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Summary</h4>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between bg-light-subtle">
                        <div>
                            <p class="fw-medium text-dark mb-0">Total Amount</p>
                        </div>
                        <div>
                            <p class="fw-medium text-dark mb-0">
                                {{ Number::currency($order->total_amount) }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Customer Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-2">

                            @if ($order->address->user->image_path === null)
                                <img src="{{ asset('storage/' . $order->address->user->image_path) }}" alt=""
                                    class="avatar rounded-3 border border-light border-3 img-fluid w-25 h-25 rounded-pill">
                            @else
                                <img src="{{ asset('default_images/product_image.png') }}" alt=""
                                    class="avatar rounded-3 border border-light border-3 img-fluid w-25 h-25 rounded-pill">
                            @endif



                            <div>
                                <p class="mb-1">{{ $order->address->user->name }}</p>
                                <a href="#!" class="link-primary fw-medium">
                                    {{ $order->address->user->email }}
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Contact Number</h5>
                        </div>
                        <p class="mb-1">
                            {{ $order->address->phone }}
                        </p>

                        <div class="d-flex justify-content-between mt-3">
                            <h5 class="">Shipping Address</h5>
                        </div>

                        <div style="font-family: Arial, sans-serif; color: #333;">
                            <p class="mb-1" style="margin-bottom: 8px; font-size: 14px; color: #555;">
                                {{ $order->address->address }} - {{ $order->address->city }} -
                                {{ $order->address->state }} - {{ $order->address->country }}
                            </p>
                            <p class="mb-1" style="margin-bottom: 8px; font-size: 14px; color: #555;">

                                {{ $order->address->pincode }}

                            </p>
                            <p class="mb-1" style="margin-bottom: 8px; font-size: 14px; color: #555;">
                            </p>
                            <p class="mb-1" style="margin-bottom: 8px; font-size: 14px; color: #555;">
                            </p>
                        </div>







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
                            } else if (response.status === 422) {
                                Swal.fire('Error', response.errors, 'error');
                            }
                        },
                        error: function(error) {
                            Swal.fire('Error', 'Failed to push order to ShipRocket' + error
                                .responseJSON.message, 'error');
                        },
                        complete: function() {
                            button.prop('disabled', false).html('Push to ShipRocket');
                        }
                    });
                });

            });
        </script>
    @endpush


</x-app-layout>

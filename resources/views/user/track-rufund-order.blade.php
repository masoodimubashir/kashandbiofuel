@extends('welcome')

@section('main')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Order Tracking</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Order Tracking</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Order Detail Section Start -->
    <section class="order-detail mb-5">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-3 col-xl-4 col-lg-6">
                    <div class="order-image text-center">
                        @if($order->is_cancelled)
                            <img src="{{ asset('front/assets/images/cancelled-order.svg') }}" class="img-fluid blur-up lazyload"
                                alt="Order Cancelled" style="max-width: 250px">
                        @else
                            <img src="{{ asset('front/assets/images/delivery-truck.svg') }}" class="img-fluid blur-up lazyload"
                                alt="Delivery Status" style="max-width: 250px">
                        @endif
                    </div>
                </div>

                <div class="col-xxl-9 col-xl-8 col-lg-6">
                    <div class="row g-sm-4 g-3">
                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i data-feather="package" class="text-content"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Order ID</h5>
                                    <h2 class="theme-color">{{ $order->custom_order_id }}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i data-feather="calendar" class="text-content"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Purchase Date</h5>
                                    <h4>{{ $order->date_of_purchase->format('d-M-Y') }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="info"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Transaction ID</h5>
                                    <h4>{{ $order->transaction->transaction_id }}</h4>
                                </div>
                            </div>
                        </div>

                        @if($order->is_cancelled && isset($order->refund))
                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="refresh-cw"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Refund ID</h5>
                                    <h4>{{ $order->refund->refund_id ?? 'N/A' }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="dollar-sign"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Refund Amount</h5>
                                    <h4>{{ isset($order->refund) ? Number::currency($order->refund->amount, 'INR') : 'N/A' }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="clock"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Refund Status</h5>
                                    <h4 class="{{ $order->refund->status === 'COMPLETED' ? 'text-success' : 'text-warning' }}">
                                        {{ ucfirst($order->refund->status ?? 'Pending') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-xl-4 col-sm-6">
                            <div class="order-details-contain">
                                <div class="order-tracking-icon">
                                    <i class="text-content" data-feather="map-pin"></i>
                                </div>

                                <div class="order-details-name">
                                    <h5 class="text-content">Destination</h5>
                                    <h4>{{ $order->address->address }}, {{ $order->address->state }}, {{ $order->address->city }}</h4>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="col-12 overflow-hidden">
                            @if($order->is_cancelled)
                            <!-- Cancelled Order Timeline -->
                            <ol class="progtrckr">
                                <li class="progtrckr-done">
                                    <h5>Order Placed</h5>
                                </li>

                                <li class="progtrckr-done">
                                    <h5>Payment Received</h5>
                                </li>

                                <li class="progtrckr-done">
                                    <h5>Order Cancelled</h5>
                                </li>

                                <li class="progtrckr-{{ isset($order->refund) ? 'done' : 'todo' }}">
                                    <h5>Refund Initiated</h5>
                                </li>

                                <li class="progtrckr-{{ isset($order->refund) && $order->refund->status === 'COMPLETED' ? 'done' : 'todo' }}">
                                    <h5>Refund Completed</h5>
                                </li>
                            </ol>
                            @else
                            <!-- Regular Order Timeline -->
                            <ol class="progtrckr">
                                <li class="progtrckr-{{ $order->is_confirmed ? 'done' : 'todo' }}">
                                    <h5>Order Processing</h5>
                                </li>

                                <li class="progtrckr-{{ $order->is_confirmed ? 'done' : 'todo' }}">
                                    <h5>Order Placed</h5>
                                </li>

                                <li class="progtrckr-{{ $order->transaction_id ? 'done' : 'todo' }}">
                                    <h5>Payment</h5>
                                </li>

                                <li class="progtrckr-{{ $order->is_shipped ? 'done' : 'todo' }}">
                                    <h5>Shipped</h5>
                                </li>

                                <li class="progtrckr-{{ $order->is_delivered ? 'done' : 'todo' }}">
                                    <h5>Delivered</h5>
                                </li>
                            </ol>
                            @endif
                        </div>

                        @if($order->is_cancelled && isset($order->refund))
                        <div class="col-12 mt-4">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5>Refund Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>PhonePe Refund ID:</strong> {{ $order->refund->phonepe_refund_id ?? 'N/A' }}</p>
                                            <p><strong>Refund Initiated:</strong> {{ $order->refund->refund_initiated_at ? $order->refund->refund_initiated_at : 'N/A' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Status:</strong> <span class="badge {{ $order->refund->status === 'completed' ? 'bg-success' : 'bg-warning' }} rounded-pill">{{ ucfirst($order->refund->status ?? 'Pending') }}</span></p>
                                            <p><strong>Completed On:</strong> {{ $order->refund->refund_completed_at ? $order->refund->refund_completed_at : 'Pending' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Order Detail Section End -->
@endsection
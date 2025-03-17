<div class="dashboard-order">
    <div class="title">
        <h2>Order History</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf"></use>
            </svg>
        </span>
    </div>

    <div class="order-contain">
        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <div class="order-box dashboard-bg-box w-100 mb-4">
                    <div class="order-header d-flex justify-content-between align-items-center p-3 border-bottom">
                        <div class="order-info">
                            <h5 class="mb-1">#{{ $order->custom_order_id }}</h5>
                            <span class="badge rounded-pill">
                                {{ $order->status }}
                            </span>
                        </div>
                        <div class="order-date text-end">
                            <small class="text-muted">Ordered on</small>
                            <div class="fw-bold">{{ $order->created_at->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="order-details p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="timeline">
                                    @if ($order->is_cancelled)
                                        <!-- Timeline for cancelled orders -->
                                        <div class="timeline-item active">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Order Placed</h6>
                                                <p class="text-muted">Your order was placed successfully</p>
                                            </div>
                                        </div>

                                        <div class="timeline-item active">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Order Cancelled</h6>
                                                <p class="text-muted">This order has been cancelled</p>
                                            </div>
                                        </div>

                                        @if ($order->transaction->refund)
                                            <div
                                                class="timeline-item {{ $order->transaction->refund->status === 'completed' ? 'active' : '' }}">
                                                <div class="timeline-marker"></div>
                                                <div class="timeline-content">
                                                    <h6>Refund
                                                        {{ $order->transaction->refund->status === 'completed' ? 'Completed' : 'Initiated' }}
                                                    </h6>
                                                    <p class="text-muted">
                                                        {{ $order->transaction->refund->status === 'completed' ? 'Refund has been processed' : 'Refund is being processed' }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        <!-- Timeline for regular orders -->
                                        <div class="timeline-item {{ $order->is_confirmed ? 'active' : '' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Order Confirmed</h6>
                                                <p class="text-muted">Your order has been confirmed</p>
                                            </div>
                                        </div>

                                        <div class="timeline-item {{ $order->is_shipped ? 'active' : '' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Shipped</h6>
                                                <p class="text-muted">Order has been shipped</p>
                                            </div>
                                        </div>

                                        <div class="timeline-item {{ $order->is_delivered ? 'active' : '' }}">
                                            <div class="timeline-marker"></div>
                                            <div class="timeline-content">
                                                <h6>Delivered</h6>
                                                <p class="text-muted">Order has been delivered</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="order-summary">
                                    <div class="summary-item d-flex justify-content-between mb-2">
                                        <span>Items</span>
                                        <strong>{{ $order->ordered_items_sum_quantity }}</strong>
                                    </div>
                                    <div class="summary-item d-flex justify-content-between mb-2">
                                        <span>Transaction ID</span>
                                        <strong class="text-primary">{{ $order->transaction->transaction_id }}</strong>
                                    </div>
                                    <div class="summary-item d-flex justify-content-between">
                                        <span>Total Amount</span>
                                        <strong
                                            class="text-success">{{ Number::currency($order->total_amount, 'INR') }}</strong>
                                    </div>

                                    @if (!$order->is_shipped && !$order->is_cancelled)
                                        <a id="cancelOrderBtn" class="btn btn-outline-danger w-100 mt-3"
                                            href="{{ route('checkout.refund', $order->transaction->transaction_id) }}">
                                            <i class="fas fa-ban me-2"></i>Cancel Order
                                        </a>
                                    @endif


                                    @if ($order->is_cancelled)
                                        <a href="{{ route('track-order', $order->id) }}"
                                            class="btn btn-sm btn-primary">
                                            Check Refund Status
                                        </a>
                                    @else
                                        <a href="{{ route('track-order', $order->id) }}"
                                            class="btn btn-sm btn-primary">
                                            Track Order
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="order-box dashboard-bg-box text-center p-4">
                <h4>No Orders Found</h4>
                <p class="text-muted">Start shopping to see your orders here</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Shop Now</a>
            </div>
        @endif
    </div>
</div>

<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        position: relative;
        padding-left: 40px;
        margin-bottom: 25px;
    }

    .timeline-marker {
        position: absolute;
        left: 0;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #e9ecef;
        border: 3px solid #fff;
        box-shadow: 0 0 0 2px #dee2e6;
    }

    .timeline-item.active .timeline-marker {
        background: #28a745;
        box-shadow: 0 0 0 2px #28a745;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 20px;
        height: calc(100% + 5px);
        width: 2px;
        background: #dee2e6;
    }

    .timeline-item:last-child::before {
        display: none;
    }

    .timeline-content {
        padding: 0 15px;
    }

    .order-summary {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .badge {
        padding: 8px 12px;
    }

    <script>
        $(document).on('click', '#cancelOrderBtn', function(e) {
            e.preventDefault();
            const refundUrl = $(this).data('refund-url');

            Swal.fire({
                title: 'Cancel Order?',
                text: "Are you sure you want to cancel this order?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = refundUrl;
                }
            });
        });
    </script>
</style>

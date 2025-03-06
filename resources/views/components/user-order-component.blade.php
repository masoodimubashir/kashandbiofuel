<div class="dashboard-order">
    <div class="title">
        <h2>Order History</h2>
        <span class="title-leaf title-leaf-gray">
            <svg class="icon-width bg-gray">
                <use xlink:href="https://themes.pixelstrap.com/fastkart/assets/svg/leaf.svg#leaf">
                </use>
            </svg>
        </span>
    </div>

    <div class="order-contain">

        @if (count($orders) > 0)
            @foreach ($orders as $order)
                <div class="order-box dashboard-bg-box w-100">
                    <div class="order-container">
                        <div class="order-icon">
                            <i data-feather="box"></i>
                        </div>
                        @if ($order->status == 'Cancelled')
                            <div class="text-danger">
                                <h4>Delivery <span>{{ $order->status }}</span></h4>
                            </div>
                        @elseif ($order->status == 'Delivered')
                            <div class=" text-light">
                                <h4>Delivery <span>{{ $order->status }}</span></h4>
                            </div>
                        @elseif ($order->status == 'Pending')
                            <div class=" text-danger">
                                <h4>Delivery <span>{{ $order->status }}</span></h4>
                            </div>
                        @else
                            <div class="text-success">
                                <h4>Delivery <span>{{ $order->status }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="product-order-detail">



                        <div class="order-wrap">
                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Total Price : </h6>
                                        <h5>{{ Number::currency($order->total_amount, 'INR') }}</h5>
                                    </div>
                                </li>

                            </ul>

                            <ul class="product-size">
                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Transaction Id : </h6>
                                        <h5>
                                            {{ $order->transaction->transaction_id }}
                                        </h5>
                                    </div>
                                </li>


                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Order Id </h6>
                                        <h5>

                                            {{ $order->custom_order_id }}

                                        </h5>
                                    </div>
                                </li>

                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Quantity : </h6>
                                        <h5>
                                            {{ $order->ordered_items_sum_quantity }} Items
                                        </h5>
                                    </div>
                                </li>

                                <li>
                                    <div class="size-box">
                                        <h6 class="text-content">Order Date : </h6>
                                        <h5>
                                            {{ $order->created_at->format('d-m-Y') }}
                                        </h5>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="order-box dashboard-bg-box">

                No Items Found

            </div>
        @endif

    </div>
</div>

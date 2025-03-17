<div class="box-col-12">
    <div class="card">
        <div class="card-header card-no-border pb-0">
            <div class="header-top">
                <h4>Total Orders</h4>
                <div class="dropdown icon-dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="icon-more-alt"></i></button>
                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Weekly</a><a
                            class="dropdown-item" href="#">Monthly</a><a class="dropdown-item"
                            href="#">Yearly</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body selling-table checkbox-checked">
            <div class="table-responsive custom-scrollbar">
                <table class="table" id="sell-product">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label"></label>
                                </div>
                            </th>
                            <th>Product Name</th>
                            <th>Order Id</th>
                            <th>Amount</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($totalOrders as $order)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <label class="form-check-label"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        
                                        <div class="flex-grow-1"><a href="product.html">
                                                    {{ $order->date_of_purchase->format('d-M-y') }}
                                            </a></div>
                                    </div>
                                </td>
                                <td>{{ $order->custom_order_id }}</td>
                                <td>{{ Number::currency($order->total_amount,'INR') }}</td>
                                <td>
                                    <div
                                        class="badge
                                    {{ match ($order->status) {
                                        'Confirmed', 'Delivered' => 'bg-success-subtle text-success-emphasis border-success-subtle',
                                        'Cancelled' => 'bg-danger-subtle text-danger-emphasis border-danger-subtle',
                                        default => 'bg-warning-subtle text-warning-emphasis border-warning-subtle',
                                    } }} btn">
                                        {{ $order->status }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

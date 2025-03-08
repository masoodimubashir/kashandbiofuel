<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->custom_order_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            padding: 20px;
            border: 1px solid black;
        }

        .invoice-header {
            background-color: #04b04b;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
        }

        .invoice-details {
            margin: 20px 0;
            clear: both;
            overflow: auto;
        }

        .company-info {
            float: left;
            width: 48%;
        }

        .invoice-meta {
            float: right;
            width: 48%;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
            text-align: right;
        }

        .contact-details {
            margin-top: 30px;
        }

        .color-box {
            width: 20px;
            height: 20px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <div class="invoice-container border">
        <div class="invoice-header">
            <h2>{{ config('app.name') }}</h2>
            <span>Invoice</span>
        </div>

        <div class="invoice-details">
            <div class="company-info">
                <strong>Shipping Address</strong><br>
                {{ $order->user->name }}<br>
                {{ $order->address->state }}<br>
                {{ $order->address->city }}, {{ $order->address->pin_code }}<br>
                Email: {{ $order->user->email }}
            </div>
            <div class="invoice-meta">
                <p><strong>Transaction Id:</strong> {{ $order->transaction->transaction_id }}</p>
                <p><strong>Order Id:</strong> {{ $order->custom_order_id }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
            </div>
        </div>

        <div class="invoice-details" style="margin-top: 20px; clear: both; overflow: auto;">
            <div class="company-info" style="float: left; width: 48%;">
                <strong>Sold By</strong><br>
                Kassh & BioFuel PVT LTD<br>
                HQ - Banderdewa<br>
                Itanagar Capital Region (ICR)<br>
                Papum Pare, Arunachal Pradesh, India - 791113
            </div>
        </div>

        <table style="margin-top: 40px; clear: both; overflow: auto;" class="mt-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Name</th>
                    <th>Color</th>
                    <th>Unit Price</th>
                    <th>Qty</th>
                    <th>Net Amount</th>
                    <th>Tax Rate</th>
                    <th>Tax Amount</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderedItems as $key => $item)
                    @php
                        $item_gst_amount =
                            ($item->product->selling_price * $item->product->gst_amount) /
                            (100 + $item->product->gst_amount);
                        $item_selling_price_without_gst = $item->product->selling_price - $item_gst_amount;
                        $total_selling_price_without_gst = $item_selling_price_without_gst * $item->quantity;
                        $total_gst_amount = $item_gst_amount * $item->quantity;
                    @endphp
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <div class="color-box" style="background-color: {{ $item->productAttribute->hex_code }};">
                            </div>
                        </td>
                        <td>{{ number_format($item_selling_price_without_gst, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($total_selling_price_without_gst, 2) }}</td>
                        <td>{{ $item->product->gst_amount }}%</td>
                        <td>{{ number_format($total_gst_amount, 2) }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="8" class="total">GRAND TOTAL</td>
                    <td>{{ $order->total_amount }}</td>
                </tr>
            </tbody>
        </table>

        <div class="contact-details">
            <p>Contact: +918881042340</p>
            <p>Email: kasshandbiofuels@gmail.com</p>
        </div>
    </div>
</body>

</html>

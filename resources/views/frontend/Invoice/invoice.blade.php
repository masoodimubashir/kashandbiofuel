@extends('welcome')
@section('main')
    <style>
        .invoice-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;

        }

        .invoice-header {
            background-color: #04b04b;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
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

        .contact-info {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            color: white;
            cursor: pointer;
        }

        .btn-export {
            background-color: #04b04b;
        }

        .btn-print {
            background-color: #6c757d;
        }
    </style>
    <div class="invoice-container shadow-sm rounded">
        <div class="invoice-header">
            <h2>
                {{ config('app.name') }}
            </h2>
            <span>Invoice</span>
        </div>

        <div class="invoice-details">
            <div class="company-info">
                <strong>{{ $order->user->name }}</strong><br>
                {{ $order->address->state }},<br>
                {{ $order->address->city }}, {{ $order->address->pin_code }}<br>
                Email: {{ $order->user->email }}
            </div>
            <div class="invoice-meta">
                <p><strong>Transaction Id:</strong> {{ $order->transaction->transaction_id }}</p>
                <p><strong>Order Id:</strong> {{ $order->custom_order_id }} </p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Item Name</th>
                    <th>Color</th>
                    <th>Qty</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($order->orderedItems as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            <div style="background-color: {{ $item->productAttribute->hex_code }}; width: 20px; height: 20px;"></div>
                        </td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->price }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4" class="total">GRAND TOTAL</td>
                    <td>{{ Number::currency($order->total_amount, 'INR') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="contact-details mt-4">
            <p>+918881042340</p>
            <p>kasshandbiofuels@gmail.com </p>
        </div>
        <div class="buttons">
            <button class="btn btn-export">Export As PDF</button>
            <button class="btn btn-print">Print</button>
        </div>
    </div>
@endsection

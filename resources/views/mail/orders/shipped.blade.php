<x-mail::message>
<div class="invoice-container">
<div class="header">
<div class="company-logo">
{{ config('app.name') }}
</div>
</div>
<div class="customer-details">
<div class="billing-details">
<h3>Customer Details</h3>
<strong>{{ $data['name'] }}</strong>
<div style="margin-top: 10px;">
{{ $data['shipping_address']['address'] }}<br>
{{ $data['shipping_address']['city'] }}<br>
{{ $data['shipping_address']['state'] }} - {{ $data['pincode'] }}
</div>
<div style="margin-top: 10px;">
{{ $order->user->email }}
</div>
</div>
<div class="job-details">
<h3>Order Information</h3>
<div><strong>Order ID:</strong> {{ $data['custom_order_id']}}</div>
<div><strong>Transaction ID:</strong> {{ $data['transaction_id']}}</div>
<div><strong>Payment Method:</strong> {{ $data['payment_method'] }}</div>
<div><strong>Purchase Date:</strong> {{ $data['date_of_purchase'] }}</div>
</div>
</div>
<div class="service-header">
<div>Invoice Date: {{ now()->format('d-M-y') }}</div>
</div>
<table>
<thead>
<tr>
<th>Product Name</th>
<th>QTY</th>
<th>RATE</th>
<th class="amount-column">Color</th></tr>
</thead>
<tbody>
@php
$groupedItems = collect($data['orderedItems'])->groupBy('id');
@endphp
@foreach ($groupedItems as $productId => $items)
@php
$firstItem = $items->first();
$variantCount = count($firstItem['attributes']);
@endphp
<tr>
<td rowspan="{{ $variantCount }}">{{ $firstItem['product_name'] }}</td>
@foreach ($firstItem['attributes'] as $index => $attribute)
@if ($index > 0)
</tr><tr>
@endif
<td>{{ $attribute['qty'] }}</td>
<td>{{ $firstItem['selling_price'] }}</td>
<td>
<div class="d-flex align-items-center gap-2">
<div class="color-swatch" style="background-color: {{ $attribute['hex_code'] }};
width: 25px;
height: 25px;
display: inline-block;
border-radius: 50%;
margin-right: 8px;"
title="Color: {{ $attribute['hex_code'] }}">
</div>
</div>
</td>
@endforeach
</tr>
@endforeach
</tbody>
</table>
<div class="totals">
<div class="totals-row">
<div><strong>Subtotal:</strong></div>
<div><strong>₹{{ number_format($order['total_amount'], 2) }}</strong></div>
</div>
</div>
<div class="footer-notes">
<div>Thank you for shopping with {{ config('app.name') }}!</div>
</div>
</div>
</x-mail::message>
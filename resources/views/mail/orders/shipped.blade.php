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
<strong>{{ $order->user->name }}</strong>
<div style="margin-top: 10px;">
{{ $order->address->address }}<br>
{{ $order->address->city }}<br>
{{ $order->address->state }} - {{ $order->address->pin_code }}
</div>
<div style="margin-top: 10px;">
{{ $order->user->email }}
</div>
</div>

<div class="job-details">
<h3>Order Information</h3>
<div><strong>Order ID:</strong> {{ $order->custom_order_id }}</div>
<div><strong>Transaction ID:</strong> {{ $order->transaction->transaction_id }}</div>
<div><strong>Payment Method:</strong> {{ $order->payment_method }}</div>
<div><strong>Purchase Date:</strong> {{ $order->date_of_purchase->format('d-M-y') }}</div>
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
<th class="amount-column">AMOUNT</th>
</tr>
</thead>
<tbody>
@foreach ($order->orderedItems as $item)
<tr>
<td>{{ $item->product->name }}</td>
<td>{{ $item->quantity }}</td>
<td>₹{{ number_format($item->product->selling_price, 2) }}</td>
<td class="amount-column">₹{{ number_format($item->price, 2) }}</td>
</tr>
@endforeach
</tbody>
</table>

<div class="totals">
<div class="totals-row">
<div><strong>Subtotal:</strong></div>
<div><strong>₹{{ number_format($order->total_amount, 2) }}</strong></div>
</div>
</div>

<div class="footer-notes">
<div>Thank you for shopping with {{ config('app.name') }}!</div>
</div>
</div>
</x-mail::message>
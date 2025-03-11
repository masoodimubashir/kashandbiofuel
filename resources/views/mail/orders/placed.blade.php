<x-mail::message>
<style>
.invoice-container {
font-family: 'Arial', sans-serif;
max-width: 800px;
margin: 0 auto;
padding: 20px;
color: #333;
}
.header {
text-align: center;
margin-bottom: 30px;
border-bottom: 1px solid #eee;
padding-bottom: 20px;
}
.company-logo {
font-size: 24px;
font-weight: bold;
margin-bottom: 15px;
}
.confirmation-message {
background-color: #f8f9fa;
padding: 15px;
border-radius: 5px;
margin: 20px 0;
text-align: center;
border-left: 4px solid #28a745;
}
.confirmation-message h2 {
color: #28a745;
margin-bottom: 10px;
}
.customer-details {
display: flex;
justify-content: space-between;
margin-bottom: 30px;
flex-wrap: wrap;
gap: 20px;
}
.billing-details, .order-details {
flex: 1;
min-width: 250px;
}
.address-block, .email-block {
margin-top: 10px;
}
.order-info-grid {
display: grid;
gap: 8px;
}
.order-items {
margin-bottom: 30px;
}
.products-table {
width: 100%;
border-collapse: collapse;
margin-top: 15px;
}
.products-table th, .products-table td {
border: 1px solid #ddd;
padding: 10px;
text-align: left;
}
.products-table th {
background-color: #f8f9fa;
}
.color-column {
width: 100px;
}
.color-display {
display: flex;
align-items: center;
}
.color-swatch {
width: 25px;
height: 25px;
display: inline-block;
border-radius: 50%;
margin-right: 8px;
border: 1px solid #ddd;
}
.totals-section {
margin-bottom: 30px;
}
.total-row {
display: flex;
justify-content: flex-end;
gap: 20px;
font-size: 18px;
padding: 10px 0;
border-top: 2px solid #eee;
}
.footer {
text-align: center;
margin-top: 30px;
padding-top: 20px;
border-top: 1px solid #eee;
color: #6c757d;
}
.thank-you-note {
font-size: 16px;
margin-bottom: 10px;
}
@media (max-width: 600px) {
.customer-details {
flex-direction: column;
}
.products-table {
font-size: 14px;
}
}
</style>
<div class="invoice-container">
<div class="header">
<div class="company-logo">{{ config('app.name') }}</div>
<div class="confirmation-message">
<h2>Your Order Has Been Confirmed!</h2>
<p>Thank you for your purchase. Sit back and relax while we prepare your order for shipping.</p>
<p>You'll receive updates as your order progresses.</p>
</div>
</div>
<div class="customer-details">
<div class="billing-details">
<h3>Customer Details</h3>
<strong>{{ $data['name'] }}</strong>
<div class="address-block">{{ $data['shipping_address']['address'] }}<br>{{ $data['shipping_address']['city'] }}<br>{{ $data['shipping_address']['state'] }} - {{ $data['pincode'] }}</div>
<div class="email-block">{{ $order->user->email }}</div>
</div>
<div class="order-details">
<h3>Order Information</h3>
<div class="order-info-grid">
<div><strong>Order ID:</strong> {{ $data['custom_order_id']}}</div>
<div><strong>Transaction ID:</strong> {{ $data['transaction_id']}}</div>
<div><strong>Payment Method:</strong> {{ $data['payment_method'] }}</div>
<div><strong>Purchase Date:</strong> {{ $data['date_of_purchase'] }}</div>
<div><strong>Invoice Date:</strong> {{ now()->format('d-M-y') }}</div>
</div>
</div>
</div>
<div class="order-items">
<h3>Order Items</h3>
<table class="products-table">
<thead>
<tr>
<th>Product Name</th>
<th>QTY</th>
<th>RATE</th>
<th class="color-column">Color</th>
</tr>
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
<td>₹{{ number_format($firstItem['selling_price'], 2) }}</td>
<td>
<div class="color-display">
<div class="color-swatch" style="background-color: {{ $attribute['hex_code'] }};" title="Color: {{ $attribute['hex_code'] }}"></div>
</div>
</td>
@endforeach
</tr>
@endforeach
</tbody>
</table>
</div>
<div class="totals-section">
<div class="total-row">
<div><strong>Subtotal:</strong></div>
<div><strong>₹{{ number_format($order['total_amount'], 2) }}</strong></div>
</div>
</div>
<div class="footer">
<div class="thank-you-note">
<p>Thank you for shopping with {{ config('app.name') }}!</p>
</div>
<div class="contact-support">
<p>If you have any questions about your order, please contact our customer support.</p>
</div>
</div>
</div>
</x-mail::message>

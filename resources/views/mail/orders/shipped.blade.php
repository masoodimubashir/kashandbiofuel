<x-mail::message>
<style>
.email-container {
font-family: 'Arial', sans-serif;
max-width: 600px;
margin: 0 auto;
padding: 20px;
color: #333;
}
.header {
text-align: center;
margin-bottom: 25px;
border-bottom: 1px solid #eee;
padding-bottom: 15px;
}
.company-logo {
font-size: 24px;
font-weight: bold;
margin-bottom: 15px;
}
.shipping-banner {
background-color: #f0f7ff;
padding: 15px;
border-radius: 5px;
margin: 20px 0;
text-align: center;
border-left: 4px solid #007bff;
}
.shipping-banner h2 {
color: #007bff;
margin-bottom: 10px;
}
.tracking-section {
background-color: #f8f9fa;
padding: 20px;
border-radius: 5px;
margin: 25px 0;
text-align: center;
}
.tracking-info h3 {
margin-top: 0;
color: #007bff;
}
.order-id {
font-size: 18px;
font-weight: bold;
margin: 15px 0;
}
.tracking-details {
background-color: #fff;
border: 1px solid #ddd;
border-radius: 5px;
padding: 15px;
margin: 15px 0;
display: inline-block;
min-width: 250px;
}
.tracking-number {
font-size: 18px;
font-weight: bold;
color: #007bff;
}
.tracking-label {
font-size: 14px;
color: #666;
margin-bottom: 5px;
}
.tracking-button {
margin-top: 20px;
}
.btn {
display: inline-block;
background-color: #007bff;
color: white;
padding: 12px 25px;
text-decoration: none;
border-radius: 5px;
font-weight: bold;
}
.shipping-info {
margin: 20px 0;
text-align: center;
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
</style>

<div class="email-container">
<div class="header">
<div class="company-logo">{{ config('app.name') }}</div>
<div class="shipping-banner">
<h2>Your Order Has Been Shipped!</h2>
<p>Great news! Your order is on its way to you. Sit back and relax while we deliver your items.</p>
</div>
</div>

<div class="tracking-section">
<div class="tracking-info">
<h3>Track Your Package</h3>
<div class="order-id">Order #{{ $data['custom_order_id']}}</div>

<div class="tracking-details">
<div class="tracking-label">Tracking Number:</div>
<div class="tracking-number">{{ $data['tracking_number'] ?? 'TRK'.rand(10000000,99999999) }}</div>
</div>

<div class="shipping-info">
<p><strong>Shipped Date:</strong> {{ now()->format('d-M-y') }}</p>
<p><strong>Estimated Delivery:</strong> {{ now()->addDays(5)->format('d-M-y') }}</p>
</div>

<div class="tracking-button">
<a href="{{ route('track-order', $order->id) }}" class="btn">Track Your Order</a>
</div>
</div>
</div>

<x-mail::button :url="route('track-order', $data['id'])">
Track Order
</x-mail::button>

<div class="footer">
<div class="thank-you-note">
<p>Thank you for shopping with {{ config('app.name') }}!</p>
</div>
<div class="contact-support">
<p>If you have any questions about your shipment, please contact our customer support.</p>
</div>
</div>
</div>
</x-mail::message>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Pending</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #f39c12;
      --secondary-color: #fff8e1;
      --text-color: #2f3542;
      --light-text: #747d8c;
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      --green: #2ed573;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      background-color: #f8f9fa;
      color: var(--text-color);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    
    .container {
      width: 100%;
      max-width: 600px;
    }
    
    .payment-pending-card {
      background-color: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--shadow);
      transform: translateY(0);
      transition: all 0.3s ease;
    }
    
    .payment-pending-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
      background-color: var(--primary-color);
      padding: 20px;
      text-align: center;
      position: relative;
    }
    
    .pending-icon-container {
      width: 110px;
      height: 110px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      transform: translateY(50%);
      box-shadow: 0 5px 20px rgba(243, 156, 18, 0.3);
    }
    
    .clock-animation {
      animation: pulse 2s infinite ease-in-out;
    }
    
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .countdown-ring {
      stroke-dasharray: 440;
      stroke-dashoffset: 440;
      animation: countdown 60s linear forwards;
      transform-origin: center;
      transform: rotate(-90deg);
    }
    
    @keyframes countdown {
      to {
        stroke-dashoffset: 0;
      }
    }
    
    .card-body {
      padding: 75px 30px 30px;
      text-align: center;
    }
    
    .card-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 20px;
      color: var(--primary-color);
    }
    
    .alert {
      background-color: var(--secondary-color);
      border-left: 4px solid var(--primary-color);
      padding: 16px;
      border-radius: 8px;
      margin-bottom: 30px;
      display: flex;
      align-items: flex-start;
      text-align: left;
    }
    
    .alert-info {
      background-color: rgba(243, 156, 18, 0.1);
      border-left: 4px solid var(--primary-color);
    }
    
    .alert-icon {
      font-size: 24px;
      color: var(--primary-color);
      margin-right: 12px;
      flex-shrink: 0;
      margin-top: 2px;
    }
    
    .alert-text {
      font-size: 15px;
      line-height: 1.5;
      color: var(--text-color);
    }
    
    .section-title {
      font-size: 18px;
      font-weight: 600;
      margin: 25px 0 15px;
      text-align: left;
      color: var(--text-color);
    }
    
    .info-list {
      text-align: left;
      list-style-type: none;
      padding: 0;
      margin-bottom: 25px;
    }
    
    .info-list li {
      padding: 8px 0 8px 28px;
      position: relative;
      border-bottom: 1px solid #f1f2f6;
    }
    
    .info-list li:last-child {
      border-bottom: none;
    }
    
    .info-list li:before {
      content: "\f05a";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      left: 0;
      color: var(--primary-color);
    }
    
    .timer-container {
      margin: 20px 0;
      text-align: center;
    }
    
    .timer {
      display: inline-block;
      background-color: var(--secondary-color);
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 20px;
      font-weight: 700;
      color: var(--primary-color);
    }
    
    .timer i {
      margin-right: 8px;
    }
    
    .action-buttons {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 30px;
    }
    
    @media (min-width: 500px) {
      .action-buttons {
        flex-direction: row;
        justify-content: center;
      }
    }
    
    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 14px 25px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 16px;
      text-decoration: none;
      transition: all 0.3s ease;
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      color: white;
      box-shadow: 0 5px 15px rgba(243, 156, 18, 0.3);
    }
    
    .btn-primary:hover {
      background-color: #e08e0b;
      transform: translateY(-2px);
    }
    
    .btn-outline {
      background-color: transparent;
      border: 2px solid var(--primary-color);
      color: var(--primary-color);
    }
    
    .btn-outline:hover {
      background-color: var(--primary-color);
      color: white;
      transform: translateY(-2px);
    }
    
    .btn i {
      margin-right: 8px;
    }
    
    .order-details {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 15px;
      margin: 20px 0;
      text-align: left;
    }
    
    .order-detail-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px dashed #eee;
    }
    
    .order-detail-item:last-child {
      border-bottom: none;
    }
    
    .order-detail-label {
      font-weight: 600;
      color: var(--light-text);
    }
    
    .order-detail-value {
      font-weight: 600;
    }
    
    .card-footer {
      background-color: #f8f9fa;
      padding: 20px;
      text-align: center;
      border-top: 1px solid #eee;
    }
    
    .support-text {
      font-size: 14px;
      color: var(--light-text);
    }
    
    .support-link {
      color: var(--primary-color);
      font-weight: 600;
      text-decoration: none;
    }
    
    .support-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="payment-pending-card">
      <div class="card-header">
        <div class="pending-icon-container">
          <svg class="clock-animation" width="80" height="80" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="45" fill="none" stroke="#f1f2f6" stroke-width="8" />
            <circle class="countdown-ring" cx="50" cy="50" r="45" fill="none" stroke="#f39c12" stroke-width="8" />
            <path d="M50 25 L50 50 L65 65" fill="none" stroke="#f39c12" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
            <circle cx="50" cy="50" r="5" fill="#f39c12" />
          </svg>
        </div>
      </div>
      
      <div class="card-body">
        <h1 class="card-title">Payment Pending</h1>
        
        <div class="alert alert-info">
          <div class="alert-icon">
            <i class="fas fa-circle-info"></i>
          </div>
          <div class="alert-text">
            Your payment is being processed. This might take a few minutes to complete. Please do not refresh or close this page.
          </div>
        </div>
        
        <div class="timer-container">
          <div class="timer">
            <i class="fas fa-hourglass-half"></i> <span id="countdown">05:00</span>
          </div>
        </div>
        
        <div class="order-details">
          <div class="order-detail-item">
            <span class="order-detail-label">Order ID:</span>
            <span class="order-detail-value">ORD-{{ rand(10000, 99999) }}</span>
          </div>
          <div class="order-detail-item">
            <span class="order-detail-label">Amount:</span>
            <span class="order-detail-value">$149.99</span>
          </div>
          <div class="order-detail-item">
            <span class="order-detail-label">Payment Method:</span>
            <span class="order-detail-value">Credit Card</span>
          </div>
          <div class="order-detail-item">
            <span class="order-detail-label">Date:</span>
            <span class="order-detail-value">March 12, 2025</span>
          </div>
        </div>
        
        <h3 class="section-title">What happens next?</h3>
        <ul class="info-list">
          <li>We're verifying your payment with your bank</li>
          <li>Once confirmed, you'll receive a confirmation email</li>
          <li>If verification takes longer than expected, we'll notify you</li>
          <li>Your order will be processed once payment is confirmed</li>
        </ul>
        
        <div class="action-buttons">
          <a href="{{ route('orders.status') }}" class="btn btn-primary">
            <i class="fas fa-refresh"></i> Check Status
          </a>
          <a href="{{ route('orders.history') }}" class="btn btn-outline">
            <i class="fas fa-clipboard-list"></i> Order History
          </a>
        </div>
      </div>
      
      <div class="card-footer">
        <p class="support-text">
          Questions about your payment? <a href="#" class="support-link">Contact our support team</a>
        </p>
      </div>
    </div>
  </div>
  
  <script>
    // Countdown timer functionality
    function startCountdown() {
      const countdownEl = document.getElementById('countdown');
      let timeLeft = 5 * 60; // 5 minutes in seconds
      
      function updateCountdown() {
        const minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        
        countdownEl.innerHTML = `${minutes}:${seconds}`;
        
        if (timeLeft <= 0) {
          clearInterval(countdownTimer);
          window.location.href = "{{ route('orders.status') }}";
        }
        timeLeft--;
      }
      
      updateCountdown();
      const countdownTimer = setInterval(updateCountdown, 1000);
    }
    
    document.addEventListener('DOMContentLoaded', startCountdown);
  </script>
</body>
</html>
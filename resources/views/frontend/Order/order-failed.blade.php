<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Failed</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #ff4757;
      --secondary-color: #f1f2f6;
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
    
    .payment-failed-card {
      background-color: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--shadow);
      transform: translateY(0);
      transition: all 0.3s ease;
    }
    
    .payment-failed-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
      background-color: var(--primary-color);
      padding: 20px;
      text-align: center;
      position: relative;
    }
    
    .error-icon-container {
      width: 110px;
      height: 110px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      transform: translateY(50%);
      box-shadow: 0 5px 20px rgba(255, 71, 87, 0.3);
    }
    
    .failed-circle {
      animation: scaleIn 0.3s ease-in-out;
    }
    
    .cross {
      stroke-dasharray: 1000;
      stroke-dashoffset: 1000;
      animation: drawCross 0.6s ease-in-out forwards;
      animation-delay: 0.3s;
    }
    
    @keyframes scaleIn {
      from { transform: scale(0); }
      to { transform: scale(1); }
    }
    
    @keyframes drawCross {
      to { stroke-dashoffset: 0; }
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
    
    .alert-success {
      background-color: rgba(46, 213, 115, 0.1);
      border-left: 4px solid var(--green);
    }
    
    .alert-icon {
      font-size: 24px;
      color: var(--primary-color);
      margin-right: 12px;
      flex-shrink: 0;
      margin-top: 2px;
    }
    
    .alert-icon.success {
      color: var(--green);
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
    
    .causes-list {
      text-align: left;
      list-style-type: none;
      padding: 0;
      margin-bottom: 25px;
    }
    
    .causes-list li {
      padding: 8px 0 8px 28px;
      position: relative;
      border-bottom: 1px solid #f1f2f6;
    }
    
    .causes-list li:last-child {
      border-bottom: none;
    }
    
    .causes-list li:before {
      content: "\f06a";
      font-family: "Font Awesome 6 Free";
      font-weight: 900;
      position: absolute;
      left: 0;
      color: var(--primary-color);
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
      box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
    }
    
    .btn-primary:hover {
      background-color: #ff3546;
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
    <div class="payment-failed-card">
      <div class="card-header">
        <div class="error-icon-container">
          <svg class="failed-circle" width="80" height="80" viewBox="0 0 150 150">
            <circle cx="75" cy="75" r="70" stroke="#ff4757" stroke-width="8" fill="none" />
            <path class="cross" stroke="#ff4757" stroke-width="8" fill="none" d="M45,45 L105,105 M105,45 L45,105" />
          </svg>
        </div>
      </div>
      
      <div class="card-body">
        <h1 class="card-title">Payment Failed</h1>
        
        <div class="alert">
          <div class="alert-icon">
            <i class="fas fa-triangle-exclamation"></i>
          </div>
          <div class="alert-text">
            Your payment could not be processed at this time. Please review your payment details.
          </div>
        </div>
        
        <div class="alert alert-success">
          <div class="alert-icon success">
            <i class="fas fa-circle-check"></i>
          </div>
          <div class="alert-text">
            <strong>Don't worry about your money!</strong> If any amount was debited from your account, it will be automatically refunded back to your account within 5-7 business days.
          </div>
        </div>
        
        <h3 class="section-title">Possible Causes of Payment Failure:</h3>
        <ul class="causes-list">
          <li>Insufficient funds in your account</li>
          <li>Incorrect card details or billing information</li>
          <li>The card has expired or been blocked</li>
          <li>Transaction exceeds your daily spending limit</li>
          <li>Bank declined the transaction for security reasons</li>
          <li>Temporary issues with payment gateway or network</li>
        </ul>
        
        <div class="action-buttons">
          <a href="{{ route('checkout.index') }}" class="btn btn-primary">
            <i class="fas fa-rotate-right"></i> Try Again
          </a>
          <a href="{{ route('cart.view-cart') }}" class="btn btn-outline">
            <i class="fas fa-cart-shopping"></i> Return to Cart
          </a>
        </div>
      </div>
      
      <div class="card-footer">
        <p class="support-text">
          Having trouble? <a href="#" class="support-link">Contact our support team</a> for assistance
        </p>
      </div>
    </div>
  </div>
</body>
</html>
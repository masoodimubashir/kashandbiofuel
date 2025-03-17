<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Refund Initiated</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #00b894;
      --secondary-color: #e6fff5;
      --text-color: #2f3542;
      --light-text: #747d8c;
      --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      --orange: #f39c12;
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
    
    .refund-initiated-card {
      background-color: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: var(--shadow);
      transform: translateY(0);
      transition: all 0.3s ease;
    }
    
    .refund-initiated-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
      background-color: var(--primary-color);
      padding: 20px;
      text-align: center;
      position: relative;
    }
    
    .refund-icon-container {
      width: 110px;
      height: 110px;
      background-color: white;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      transform: translateY(50%);
      box-shadow: 0 5px 20px rgba(0, 184, 148, 0.3);
    }
    
    .checkmark-circle {
      animation: scaleIn 0.3s ease-in-out;
    }
    
    .checkmark {
      stroke-dasharray: 1000;
      stroke-dashoffset: 1000;
      animation: drawCheck 0.6s ease-in-out forwards;
      animation-delay: 0.3s;
    }
    
    @keyframes scaleIn {
      from { transform: scale(0); }
      to { transform: scale(1); }
    }
    
    @keyframes drawCheck {
      to { stroke-dashoffset: 0; }
    }
    
    .dollar-sign {
      animation: moveUp 0.5s ease-out forwards;
      animation-delay: 0.9s;
      opacity: 0;
    }
    
    @keyframes moveUp {
      from { 
        transform: translateY(10px);
        opacity: 0;
      }
      to { 
        transform: translateY(0);
        opacity: 1;
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
    
    .alert-warning {
      background-color: rgba(243, 156, 18, 0.1);
      border-left: 4px solid var(--orange);
    }
    
    .alert-icon {
      font-size: 24px;
      color: var(--primary-color);
      margin-right: 12px;
      flex-shrink: 0;
      margin-top: 2px;
    }
    
    .alert-icon.warning {
      color: var(--orange);
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
    
    .refund-details {
      background-color: #f8f9fa;
      border-radius: 8px;
      padding: 15px;
      margin: 20px 0;
      text-align: left;
    }
    
    .refund-detail-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px dashed #eee;
    }
    
    .refund-detail-item:last-child {
      border-bottom: none;
    }
    
    .refund-detail-label {
      font-weight: 600;
      color: var(--light-text);
    }
    
    .refund-detail-value {
      font-weight: 600;
    }
    
    .badge {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
    }
    
    .badge-success {
      background-color: var(--secondary-color);
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
      box-shadow: 0 5px 15px rgba(0, 184, 148, 0.3);
    }
    
    .btn-primary:hover {
      background-color: #00a382;
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
    
    .timeline {
      margin: 30px 0;
      position: relative;
      text-align: left;
    }
    
    .timeline:before {
      content: '';
      position: absolute;
      left: 12px;
      top: 0;
      height: 100%;
      width: 2px;
      background-color: #eaeaea;
    }
    
    .timeline-item {
      padding-left: 40px;
      position: relative;
      margin-bottom: 20px;
    }
    
    .timeline-item:last-child {
      margin-bottom: 0;
    }
    
    .timeline-icon {
      position: absolute;
      left: 0;
      top: 0;
      width: 25px;
      height: 25px;
      border-radius: 50%;
      background-color: white;
      border: 2px solid var(--primary-color);
      display: flex;
      justify-content: center;
      align-items: center;
      color: var(--primary-color);
      font-size: 12px;
      z-index: 1;
    }
    
    .timeline-icon.completed {
      background-color: var(--primary-color);
      color: white;
    }
    
    .timeline-content {
      background-color: white;
      border: 1px solid #eaeaea;
      border-radius: 8px;
      padding: 12px;
    }
    
    .timeline-title {
      font-weight: 600;
      margin-bottom: 5px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .timeline-date {
      font-size: 12px;
      color: var(--light-text);
    }
    
    .timeline-text {
      font-size: 14px;
      color: var(--light-text);
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
    <div class="refund-initiated-card">
      <div class="card-header">
        <div class="refund-icon-container">
          <svg class="refund-animation" width="80" height="80" viewBox="0 0 100 100">
            <circle class="checkmark-circle" cx="50" cy="50" r="45" fill="none" stroke="#00b894" stroke-width="8" />
            <path class="checkmark" stroke="#00b894" stroke-width="8" fill="none" d="M30,50 L45,65 L70,35" stroke-linecap="round" stroke-linejoin="round" />
            <text class="dollar-sign" x="50" y="60" text-anchor="middle" font-size="32" font-weight="bold" fill="#00b894"></text>
          </svg>
        </div>
      </div>
      
      <div class="card-body">
        <h1 class="card-title">Refund Initiated</h1>
        
        <div class="alert">
          <div class="alert-icon">
            <i class="fas fa-circle-check"></i>
          </div>
          <div class="alert-text">
            Your refund has been successfully initiated for Order #ORD-{{ $transaction->order->custom_order_id }}. We've sent a confirmation email with all the details.
          </div>
        </div>
        
        <div class="alert alert-warning">
          <div class="alert-icon warning">
            <i class="fas fa-clock"></i>
          </div>
          <div class="alert-text">
            <strong>Please note:</strong> While we've processed your refund request immediately, it typically takes 5-7 business days for the amount to reflect in your account, depending on your payment method and bank processing times.
          </div>
        </div>
        
        <div class="refund-details">
          <div class="refund-detail-item">
            <span class="refund-detail-label">Refund ID:</span>
            <span class="refund-detail-value">{{ $refundresponse['refundId'] }}</span>
          </div>
          <div class="refund-detail-item">
            <span class="refund-detail-label">Transaction  ID:</span>
            <span class="refund-detail-value">ORD-{{ $refundresponse['originalMerchantOrderId'] }}</span>
          </div>
          <div class="refund-detail-item">
            <span class="refund-detail-label">Refund Amount:</span>
            <span class="refund-detail-value">{{ $refundresponse['amount'] }}</span>
          </div>
          <div class="refund-detail-item">
            <span class="refund-detail-label">Payment Method:</span>
            <span class="refund-detail-value">{{ $refundresponse['paymentMode'] }} ({{ $refundresponse['splitInstruments'][0]['instrument']['maskedAccountNumber'] }})</span>
          </div>
          <div class="refund-detail-item">
            <span class="refund-detail-label">Status:</span>
            <span class="refund-detail-value"><span class="badge badge-success">{{ $refundresponse['state'] }}</span></span>
          </div>
        </div>
        
        <div class="action-buttons">
          <a href="{{ route('user.dashboard') }}" class="btn btn-primary">
            <i class="fas fa-file-invoice"></i> View Order Details
          </a>
         
        </div>
      </div>
      
      <div class="card-footer">
        <p class="support-text">
          Questions about your refund? <a href="#" class="support-link">Contact our support team</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
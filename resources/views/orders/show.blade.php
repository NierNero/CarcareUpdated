<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Details - Carcare</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Arial', sans-serif;
      background: #f6f6f6;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 800px;
      margin: 30px auto;
      background: #fff;
      border-radius: 8px;
      padding: 25px 30px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #4a3df5;
      margin-bottom: 25px;
      font-size: 1.8em;
    }
    /* Order Summary Section */
    .order-summary {
      background: #fff7f4;
      border-left: 5px solid #4a3df5;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 30px;
    }
    .order-summary .detail {
      margin: 12px 0;
      font-size: 1em;
      line-height: 1.5;
    }
    .order-summary .detail span.label {
      font-weight: bold;
      color: #555;
    }
    .order-summary .detail span.value {
      margin-left: 5px;
      color: #333;
    }
    .status {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 0.9em;
      color: #fff;
      margin-left: 5px;
    }
    .pending_approval { background: #f39c12; }
    .accepted { background: #28a745; }
    .denied { background: #dc3545; }
    .in_transit { background: #17a2b8; }
    .completed { background: #007bff; }
    /* Order Items Section */
    .order-items {
      margin-bottom: 30px;
    }
    .order-items h2 {
      font-size: 1.4em;
      color: #333;
      margin-bottom: 15px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 10px;
    }
    .order-item {
      display: flex;
      align-items: center;
      padding: 15px 0;
      border-bottom: 1px dashed #ddd;
    }
    .order-item:last-child {
      border-bottom: none;
    }
    .item-image {
      width: 60px;
      height: 60px;
      flex-shrink: 0;
      border-radius: 4px;
      margin-right: 15px;
      object-fit: cover;
      border: 1px solid #eee;
    }
    .item-details {
      flex: 1;
    }
    .item-details .name {
      font-size: 1em;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .item-details .price-info {
      font-size: 0.9em;
      color: #777;
    }
    .item-qty,
    .item-price,
    .item-subtotal {
      width: 80px;
      text-align: center;
      font-size: 0.95em;
    }
    .item-price,
    .item-subtotal {
      color: #ee4d2d;
    }
    /* Back Button */
    .back-btn {
      display: block;
      text-align: center;
      margin-top: 30px;
      padding: 12px 25px;
      background: #4a3df5;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .back-btn:hover {
      background: #d43c1f;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Order Details</h1>
    <div class="order-summary">
      <div class="detail">
        <span class="label">Order ID:</span>
        <span class="value">{{ $order->id }}</span>
      </div>
      <div class="detail">
        <span class="label">Status:</span>
        <span class="value">
          {{ ucfirst($order->status) }}
          <span class="status {{ $order->status }}">
            <!-- This badge class is set based on order status -->
          </span>
        </span>
      </div>
      <div class="detail">
        <span class="label">Total Amount:</span>
        <span class="value">${{ $order->total_amount }}</span>
      </div>
      <div class="detail">
        <span class="label">Order Date:</span>
        <span class="value">{{ $order->created_at->format('M d, Y H:i A') }}</span>
      </div>
      <div class="detail">
        <span class="label">Payment Method:</span>
        <span class="value">
          @switch($order->payment_method)
            @case('card')
              Credit/Debit Card
              @break
            @case('paypal')
              PayPal
              @break
            @case('cash')
              Cash on Delivery
              @break
            @default
              N/A
          @endswitch
        </span>
      </div>
    </div>

    <div class="order-items">
      <h2>Order Items</h2>
      @foreach($order->items as $item)
      <div class="order-item">
        <img class="item-image" src="{{ $item->product->image ?? 'https://via.placeholder.com/60' }}" alt="{{ $item->product->ProductName }}">
        <div class="item-details">
          <div class="name">{{ $item->product->ProductName }}</div>
          <div class="price-info">Price: ${{ $item->price }} x {{ $item->quantity }}</div>
        </div>
        <div class="item-subtotal">${{ $item->quantity * $item->price }}</div>
      </div>
      @endforeach
    </div>

    <a href="{{ route('orders.index') }}" class="back-btn">Back to Orders</a>
  </div>
</body>
</html>

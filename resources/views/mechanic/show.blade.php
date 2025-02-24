<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Details - Carcare</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f6f6f6;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 25px 30px;
    }
    h1 {
      text-align: center;
      color: #ee4d2d;
      margin-bottom: 20px;
      font-size: 1.8em;
    }
    /* Order Summary Card */
    .order-summary {
      background: #fff7f4;
      border-left: 5px solid #ee4d2d;
      padding: 20px;
      border-radius: 6px;
      margin-bottom: 30px;
    }
    .order-summary h5 {
      margin: 0 0 10px;
      font-size: 1.3em;
      color: #333;
    }
    .order-summary p {
      margin: 8px 0;
      font-size: 0.95em;
      line-height: 1.5;
    }
    .order-summary p strong {
      color: #555;
    }
    .badge {
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 0.85em;
      color: #fff;
      margin-left: 5px;
    }
    .badge-warning { background: #f39c12; }
    .badge-success { background: #28a745; }
    .badge-danger { background: #dc3545; }
    .badge-info { background: #17a2b8; }
    .badge-primary { background: #007bff; }
    /* Order Items List */
    .order-items {
      margin-bottom: 30px;
    }
    .order-items h3 {
      font-size: 1.2em;
      color: #333;
      border-bottom: 1px solid #eee;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }
    .item-row {
      display: flex;
      padding: 10px 0;
      border-bottom: 1px dashed #ddd;
      align-items: center;
    }
    .item-row:last-child {
      border-bottom: none;
    }
    .item-col {
      flex: 1;
      text-align: center;
      font-size: 0.95em;
    }
    .item-col.product {
      flex: 2;
      text-align: left;
      padding-left: 10px;
    }
    .item-header {
      font-weight: bold;
      color: #555;
      padding-bottom: 8px;
      border-bottom: 1px solid #eee;
    }
    /* Mechanic Actions */
    .actions {
      margin: 20px 0;
      text-align: center;
    }
    .actions form {
      display: inline-block;
      margin: 5px;
    }
    .actions button {
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      font-size: 0.9em;
      cursor: pointer;
      transition: background 0.3s;
      color: #fff;
    }
    .btn-success { background: #28a745; }
    .btn-success:hover { background: #218838; }
    .btn-danger { background: #dc3545; }
    .btn-danger:hover { background: #c82333; }
    .btn-info { background: #17a2b8; }
    .btn-info:hover { background: #138496; }
    .btn-primary { background: #007bff; }
    .btn-primary:hover { background: #0069d9; }
    /* Back Button */
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #ee4d2d;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Order Details</h1>
    
    <!-- Order Summary Card -->
    <div class="order-summary">
      <h5>Order ID: {{ $order->id }}</h5>
      <p>
        <strong>Status:</strong>
        <span class="badge 
          @if($order->status === 'pending') badge-warning
          @elseif($order->status === 'accepted') badge-success
          @elseif($order->status === 'denied') badge-danger
          @elseif($order->status === 'in_transit') badge-info
          @elseif($order->status === 'completed') badge-primary
          @endif">
          {{ ucfirst($order->status) }}
        </span>
      </p>
      <p><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
      <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i A') }}</p>
      <p><strong>Payment Method:</strong>
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
      </p>
    </div>
    
    <!-- Order Items List -->
    <div class="order-items">
      <h3>Order Items</h3>
      <div class="item-row item-header">
        <div class="item-col product">Product</div>
        <div class="item-col">Quantity</div>
        <div class="item-col">Price</div>
        <div class="item-col">Subtotal</div>
      </div>
      @foreach($order->items->sortByDesc('created_at') as $item)
      <div class="item-row">
        <div class="item-col product">{{ $item->product->ProductName }}</div>
        <div class="item-col">{{ $item->quantity }}</div>
        <div class="item-col">${{ $item->price }}</div>
        <div class="item-col">${{ $item->quantity * $item->price }}</div>
      </div>
      @endforeach
    </div>
    
    <!-- Mechanic Actions -->
    <div class="actions">
      <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="accepted">
        <button type="submit" class="btn-success">Accept Order</button>
      </form>
      <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="denied">
        <button type="submit" class="btn-danger">Deny Order</button>
      </form>
      <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="in_transit">
        <button type="submit" class="btn-info">Mark as In Transit</button>
      </form>
      <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST">
        @csrf
        <input type="hidden" name="status" value="completed">
        <button type="submit" class="btn-primary">Mark as Completed</button>
      </form>
    </div>
    
    <a href="{{ route('mechanic.orders', ['status' => 'pending']) }}" class="back-link">Back to Orders</a>
  </div>
</body>
</html>
    
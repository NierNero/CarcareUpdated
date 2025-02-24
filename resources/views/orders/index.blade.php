<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Orders - Carcare</title>
  <style>
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      background: #f6f6f6;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    /* Navigation Menu */
    nav {
      background: #fff;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .cart-nav {
      list-style: none;
      display: flex;
      justify-content: center;
      margin: 0;
      padding: 0;
    }
    .cart-nav li {
      margin: 0 10px;
    }
    .cart-nav li a {
      text-decoration: none;
      color: #4a3df5;
      padding: 8px 12px;
      border: 1px solid #4a3df5;
      border-radius: 4px;
      transition: background 0.3s, color 0.3s;
    }
    .cart-nav li a:hover {
      background: #4a3df5;
      color: #fff;
    }
    /* Container */
    .container {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #4a3df5;
      margin-bottom: 25px;
    }
    /* Orders Grid */
    .orders-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }
    .order-card {
      background: #fafafa;
      border: 1px solid #e0e0e0;
      border-radius: 6px;
      padding: 20px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      transition: transform 0.3s;
    }
    .order-card:hover {
      transform: translateY(-5px);
    }
    .order-id {
      font-size: 1.2em;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
    }
    .order-status {
      margin-bottom: 10px;
    }
    .order-status .badge {
      padding: 4px 8px;
      border-radius: 4px;
      font-size: 0.85em;
      color: #fff;
    }
    .badge-warning { background: #f39c12; }
    .badge-success { background: #28a745; }
    .badge-danger { background: #dc3545; }
    .badge-info { background: #17a2b8; }
    .badge-primary { background: #007bff; }
    .order-name, .order-amount {
      font-size: 1em;
      margin-bottom: 10px;
      color: #555;
    }
    .order-details-btn {
      display: inline-block;
      text-decoration: none;
      background: #4a3df5;
      color: #fff;
      padding: 8px 16px;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .order-details-btn:hover {
      background: #d43c1f;
    }
    /* Home Link */
    .home-nav {
      text-align: center;
      margin-top: 20px;
    }
    .home-nav a {
      text-decoration: none;
      color: #4a3df5;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <nav>
    <ul class="cart-nav">
    <li><a href="{{ route('orders.index') }}">All</a></li>
      <li><a href="{{ route('cart.index') }}">Cart</a></li>
      <li><a href="{{ route('user.pending') }}">To Paid</a></li>
      <li><a href="{{ route('user.in_transit') }}">Transit</a></li>
      <li><a href="{{ route('user.completed') }}">Completed</a></li>
      <li><a href="{{ route('user.denied') }}">Cancelled</a></li>
    </ul>
  </nav>
  
  <div class="container">
    <div class="home-nav">
      <a href="{{ route('dashboard') }}">Home</a>
    </div>
    <h1>All Orders</h1>
    @if($orders->isEmpty())
      <p style="text-align: center;">You have no orders.</p>
    @else
      <div class="orders-grid">
        @foreach($orders as $order)
          <div class="order-card">
            <div class="order-id">Order #{{ $order->id }}</div>
            <div class="order-status">
              <span class="badge 
                @if($order->status === 'pending') badge-warning
                @elseif($order->status === 'accepted') badge-success
                @elseif($order->status === 'denied') badge-danger
                @elseif($order->status === 'in_transit') badge-info
                @elseif($order->status === 'completed') badge-primary
                @endif">
                {{ ucfirst($order->status) }}
              </span>
            </div>
            <div class="order-name">Name: {{ $order->user->last_name }}</div>
            <div class="order-amount">Total: ${{ $order->total_amount }}</div>
            <a href="{{ route('orders.show', $order) }}" class="order-details-btn">View Details</a>
          </div>
        @endforeach
      </div>
    @endif
    
  </div>
</body>
</html>

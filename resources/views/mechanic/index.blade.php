<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mechanic Dashboard - Orders</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      background: #f6f6f6;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 1000px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      padding: 25px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h1 {
      text-align: center;
      color: #007BFF;
      margin-bottom: 20px;
    }
    /* Back Link */
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #007BFF;
      font-weight: bold;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    /* Filter Form */
    .filter-form {
      text-align: center;
      margin-bottom: 20px;
    }
    .filter-form label {
      font-weight: bold;
      margin-right: 10px;
    }
    .filter-form select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    /* Orders Grid */
    .orders-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
    }
    .order-card {
      background: #fafafa;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      transition: transform 0.2s;
    }
    .order-card:hover {
      transform: translateY(-5px);
    }
    .order-card h3 {
      margin: 0 0 10px;
      font-size: 1.2em;
      color: #333;
    }
    .order-detail {
      margin: 8px 0;
      font-size: 0.95em;
    }
    .order-detail span.label {
      font-weight: bold;
    }
    .badge {
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
    .order-actions {
      margin-top: 10px;
    }
    .order-actions a,
    .order-actions button {
      display: inline-block;
      margin: 2px 5px 0 0;
      padding: 6px 10px;
      font-size: 0.85em;
      text-decoration: none;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
      color: #fff;
    }
    .btn-primary {
      background: #007bff;
    }
    .btn-primary:hover {
      background: #0069d9;
    }
    .btn-success {
      background: #28a745;
    }
    .btn-success:hover {
      background: #218838;
    }
    .btn-danger {
      background: #dc3545;
    }
    .btn-danger:hover {
      background: #c82333;
    }
    .btn-info {
      background: #17a2b8;
    }
    .btn-info:hover {
      background: #138496;
    }
    /* Responsive Styles */
    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }
      h1 {
        font-size: 20px;
        padding: 15px 0;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Mechanic Dashboard</h1>
    
    <!-- Status Filter -->
    <div class="filter-form">
      <form action="{{ route('mechanic.orders') }}" method="GET">
        <label for="status">Filter by Status:</label>
        <select name="status" id="status" onchange="this.form.submit()">
          <option value="">All</option>
          <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
          <option value="denied" {{ request('status') === 'denied' ? 'selected' : '' }}>Denied</option>
          <option value="in_transit" {{ request('status') === 'in_transit' ? 'selected' : '' }}>In Transit</option>
          <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
      </form>
    </div>
    
    <!-- Orders Grid -->
    @if($orders->isEmpty())
      <p style="text-align: center;">No orders found.</p>
    @else
      <div class="orders-grid">
        @foreach($orders as $order)
          <div class="order-card">
            <h3>Order #{{ $order->id }}</h3>
            <div class="order-detail">
              <span class="label">User:</span> {{ $order->user->last_name }}
            </div>
            <div class="order-detail">
              <span class="label">Status:</span>
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
            <div class="order-detail">
              <span class="label">Total:</span> ${{ $order->total_amount }}
            </div>
            <div class="order-actions">
              <a href="{{ route('mechanic.orders.show', $order) }}" class="btn-primary">View Details</a>
              @if($order->status === 'pending')
                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                  @csrf
                  <input type="hidden" name="status" value="accepted">
                  <button type="submit" class="btn-success">Accept</button>
                </form>
                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                  @csrf
                  <input type="hidden" name="status" value="denied">
                  <button type="submit" class="btn-danger">Deny</button>
                </form>
              @elseif($order->status === 'accepted')
                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                  @csrf
                  <input type="hidden" name="status" value="in_transit">
                  <button type="submit" class="btn-info">Mark as In Transit</button>
                </form>
              @elseif($order->status === 'in_transit')
                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                  @csrf
                  <input type="hidden" name="status" value="completed">
                  <button type="submit" class="btn-primary">Mark as Completed</button>
                </form>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @endif
    
    <!-- Back Link -->
    <a href="{{ route('mechanic.dashboard') }}" class="back-link">Back</a>
  </div>
</body>
</html>

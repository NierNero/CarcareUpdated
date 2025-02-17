<div class="container">
    <h1>Order Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Order ID: {{ $order->id }}</h5>
            <p class="card-text">
                <strong>Status:</strong>
                <span class="badge 
                    @if($order->status === 'pending_approval') badge-warning
                    @elseif($order->status === 'accepted') badge-success
                    @elseif($order->status === 'denied') badge-danger
                    @elseif($order->status === 'in_transit') badge-info
                    @elseif($order->status === 'completed') badge-primary
                    @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p class="card-text"><strong>User:</strong> {{ $order->user ? $order->user->first_name : 'N/A' }}</p>
            <p class="card-text"><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
            <p class="card-text"><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i A') }}</p>
        </div>
    </div>

    <h3 class="mt-4">Order Items</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->ProductName }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                    <td>${{$item->product->Price * $item->quantity}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mechanic Actions -->
    <div class="mt-4">
        <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="status" value="accepted">
            <button type="submit" class="btn btn-success">Accept Order</button>
        </form>
        <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="status" value="denied">
            <button type="submit" class="btn btn-danger">Deny Order</button>
        </form>
        <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="status" value="in_transit">
            <button type="submit" class="btn btn-info">Mark as In Transit</button>
        </form>
        <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="status" value="completed">
            <button type="submit" class="btn btn-primary">Mark as Completed</button>
        </form>
    </div>

    <a href="{{ route('mechanic.orders') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
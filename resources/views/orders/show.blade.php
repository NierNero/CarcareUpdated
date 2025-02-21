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
            <p class="card-text"><strong>Total Amount:</strong> ${{ $order->total_amount }}</p>
            <p class="card-text"><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i A') }}</p>

            <!-- Add Payment Method here -->
            <p class="card-text"><strong>Payment Method:</strong>
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
                    <td>${{ $item->quantity * $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>
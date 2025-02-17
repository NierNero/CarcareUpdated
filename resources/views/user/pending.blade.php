<div class="container">
    <h1>Pending Orders</h1>

    @if($orders->isEmpty())
        <p>You have no pending orders.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @foreach($order->items as $item)
                                {{ $item->product->ProductName }} x{{ $item->quantity }}<br>
                            @endforeach
                        </td>
                        <td>${{ $order->total_amount }}</td>
                        <td>
                            <span class="badge 
                                @if($order->status === 'pending_approval') badge-warning @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <ul>
        <li><a href="{{ route('dashboard') }}">Home</a></li>
    </ul>
</div>

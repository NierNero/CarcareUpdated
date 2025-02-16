<div class="container">
    <h1>Your Orders</h1>
    @if($orders->isEmpty())
        <p>You have no orders.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            <span class="badge 
                                @if($order->status === 'pending_approval') badge-warning
                                @elseif($order->status === 'accepted') badge-success
                                @elseif($order->status === 'denied') badge-danger
                                @elseif($order->status === 'in_transit') badge-info
                                @elseif($order->status === 'completed') badge-primary
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>${{ $order->total_amount }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <li> <a href="{{ route('dashboard') }}">Home</a>
</div>
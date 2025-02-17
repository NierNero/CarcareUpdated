<div class="container">
    <h1>Mechanic Dashboard</h1>

    <!-- Status Filter -->
    <div class="mb-4">
        <form action="{{ route('mechanic.orders') }}" method="GET">
            <label for="status">Filter by Status:</label>
            <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <option value="pending_approval" {{ request('status') === 'pending_approval' ? 'selected' : '' }}>Pending Approval</option>
                <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
                <option value="denied" {{ request('status') === 'denied' ? 'selected' : '' }}>Denied</option>
                <option value="in_transit" {{ request('status') === 'in_transit' ? 'selected' : '' }}>In Transit</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </form>
    </div>

    <!-- Orders Table -->
    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->last_name }}</td>
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
                            <a href="{{ route('mechanic.orders.show', $order) }}" class="btn btn-primary btn-sm">View Details</a>
                            @if($order->status === 'pending_approval')
                                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                                </form>
                                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="denied">
                                    <button type="submit" class="btn btn-danger btn-sm">Deny</button>
                                </form>
                            @elseif($order->status === 'accepted')
                                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="in_transit">
                                    <button type="submit" class="btn btn-info btn-sm">Mark as In Transit</button>
                                </form>
                            @elseif($order->status === 'in_transit')
                                <form action="{{ route('mechanic.orders.updateStatus', $order) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-primary btn-sm">Mark as Completed</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<div class="container">
    <h1>Your Cart</h1>
    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->ProductName }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->product->Price * $item->quantity }}</td>
                        <td>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>
    @endif
    <a href="{{ route('dashboard') }}" class="home-link">Back to Home</a>
</div>

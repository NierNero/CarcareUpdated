<div class="container">
    <h1>Payment</h1>
    <p>Total Amount: ${{ $totalAmount }}</p>

    <h3>Order Summary</h3>
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
            @if($cartItems->count() > 0)
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->ProductName }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->product->Price }}</td>
                        <td>${{ $item->quantity * $item->product->Price }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No items in the cart.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <form action="{{ route('payments.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="card_number">Card Number</label>
            <input type="text" id="card_number" name="card_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date</label>
            <input type="text" id="expiry_date" name="expiry_date" class="form-control" placeholder="MM/YY" required>
        </div>
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method</label>
            <select id="payment_method" name="payment_method" class="form-control" required>
                <option value="card">Credit/Debit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash">Cash on Delivery</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Carcare</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 30px;
        }
        h1 {
            text-align: center;
            color: #4a3df5;
            margin-bottom: 20px;
        }
        .total-amount {
            font-size: 1.5em;
            text-align: center;
            margin-bottom: 30px;
        }
        /* Order Summary Styles */
        .order-summary {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 30px;
            background: #fff;
        }
        .order-summary h3 {
            margin: 0 0 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
            color: #333;
        }
        .order-items {
            margin-top: 15px;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .order-item .item-info {
            flex: 2;
            text-align: left;
        }
        .order-item .item-qty,
        .order-item .item-price,
        .order-item .item-subtotal {
            flex: 1;
            text-align: center;
        }
        /* Payment Form Styles */
        form {
            margin-top: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button.btn-primary {
            background: #4a3df5;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background 0.3s;
            width: 100%;
        }
        button.btn-primary:hover {
            background: #d43c1f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <div class="total-amount">
            Total Amount: ₱{{ number_format($totalAmount, 2) }}
        </div>

        <div class="order-summary">
            <h3>Order Summary</h3>
            <div class="order-items">
                @if($cartItems->count() > 0)
                    @if($isBuyNow)
                        <!-- Buy Now - Single Product Purchase -->
                        <div class="order-item">
                            <div class="item-info">{{ $cartItems[0]->product->ProductName }}</div>
                            <div class="item-qty">x1</div>
                            <div class="item-price">₱{{ number_format($cartItems[0]->product->Price, 2) }}</div>
                            <div class="item-subtotal">₱{{ number_format($cartItems[0]->product->Price, 2) }}</div>
                        </div>
                    @else
                        <!-- Cart Checkout - Multiple Items -->
                        @foreach($cartItems as $item)
                            <div class="order-item">
                                <div class="item-info">{{ $item->product->ProductName }}</div>
                                <div class="item-qty">x{{ $item->quantity }}</div>
                                <div class="item-price">₱{{ number_format($item->product->Price, 2) }}</div>
                                <div class="item-subtotal">₱{{ number_format($item->quantity * $item->product->Price, 2) }}</div>
                            </div>
                        @endforeach
                    @endif
                @else
                    <p style="text-align: center;">No items in the cart.</p>
                @endif
            </div>
        </div>

        <form action="{{ route('payments.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date</label>
                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Pay Now</button>
        </form>
    </div>
</body>
</html>

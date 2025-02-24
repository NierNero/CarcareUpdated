<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart - Carcare</title>
    <!-- You can include your Bootstrap or custom CSS here if needed -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        nav {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 10px 0;
        }
        .cart-nav {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .cart-nav li {
            margin: 0 10px;
        }
        .cart-nav li a {
            text-decoration: none;
            color: #4a3df5;
            font-weight: bold;
            padding: 8px 12px;
            border: 1px solid #4a3df5;
            border-radius: 4px;
            transition: background 0.3s, color 0.3s;
        }
        .cart-nav li a:hover {
            background: #4a3df5;
            color: #fff;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #f7f7f7;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .quantity-controls form {
            margin: 0 5px;
        }
        .quantity-controls button {
            background: #4a3df5;
            border: none;
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: background 0.3s;
        }
        .quantity-controls button:hover {
            background: #3a2dbf;
        }
        .quantity-display {
            font-size: 1.2em;
            margin: 0 10px;
            min-width: 30px;
            text-align: center;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-size: 1em;
            cursor: pointer;
            display: inline-block;
            transition: background 0.3s;
        }
        .btn-primary {
            background: #4a3df5;
            color: #fff;
        }
        .btn-primary:hover {
            background: #3a2dbf;
        }
        .btn-danger {
            background: #e74c3c;
            color: #fff;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .home-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4a3df5;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navigation Menu -->
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

    <!-- Cart Container -->
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
                        <td>
                            <div class="quantity-controls">
                                <!-- Minus Button -->
                                <form action="{{ route('cart.decrement', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">-</button>
                                </form>
                                <!-- Quantity Display -->
                                <span class="quantity-display">{{ $item->quantity }}</span>
                                <!-- Add Button -->
                                <form action="{{ route('cart.increment', $item) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">+</button>
                                </form>
                            </div>
                        </td>
                        <td>${{ number_format($item->product->Price * $item->quantity, 2) }}</td>
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

            <!-- Checkout Button -->
            <a href="{{ route('payments.index') }}" class="btn btn-primary">Checkout</a>
        @endif

        <!-- Back to Home Link -->
        <a href="{{ route('dashboard') }}" class="home-link">Back to Home</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Carcare</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-size: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-size: 1rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .cart-table th,
        .cart-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .cart-table td {
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-info img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            margin-right: 15px;
        }

        .product-info h5 {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-control button {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 1rem;
            color: #333;
        }

        .quantity-control input {
            width: 40px;
            text-align: center;
            border: 1px solid #ddd;
            padding: 5px;
            margin: 0 5px;
            font-size: 1rem;
        }

        .btn-remove {
            background-color: #ff4d4f;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-remove:hover {
            background-color: #ff7875;
        }

        .cart-summary {
            margin-top: 20px;
            text-align: right;
        }

        .cart-summary button {
            background-color: #00b14f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .cart-summary button:hover {
            background-color: #00943e;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
            padding: 20px;
        }

        .home-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 1rem;
            color: #3498db;
            text-decoration: none;
        }

        .home-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h2>Your Cart</h2>

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="container">
        @if(count($cart) > 0)
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $product)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->ProductName }}">
                                    <h5>{{ $product->ProductName }}</h5>
                                </div>
                            </td>
                            <td>₱{{ number_format($product->Price, 2) }}</td>
                            <td>
                                <div class="quantity-control">
                                    <button>-</button>
                                    <input type="text" value="1" readonly>
                                    <button>+</button>
                                </div>
                            </td>
                            <td>
                                <button class="btn-remove" onclick="window.location.href='{{ route('user.cart.remove', $product->id) }}'">Remove</button>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="cart-summary">
                <form action="{{ route('user.cart.buy') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-checkout">Buy Now</button>
                </form>
            </div>
        @else
            <p class="empty-cart">Your cart is empty.</p>
        @endif
    </div>  
    <a href="{{ route('dashboard') }}" class="home-link">Back to Home</a>

</body>

</html>
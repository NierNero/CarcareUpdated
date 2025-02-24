<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Denied Orders - Carcare</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        /* Navigation Menu */
        nav {
            background: #fff;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .cart-nav {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        .cart-nav li {
            margin: 0 10px;
        }
        .cart-nav li a {
            text-decoration: none;
            color: #4a3df5;
            padding: 8px 12px;
            border: 1px solid #4a3df5;
            border-radius: 4px;
            transition: background 0.3s ease, color 0.3s ease;
        }
        .cart-nav li a:hover {
            background: #4a3df5;
            color: #fff;
        }
        /* Container Styles */
        .container {
            max-width: 1200px;
            margin: 40px auto;
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
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table th,
        table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background: #f7f7f7;
            font-weight: bold;
        }
        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s ease;
            font-size: 0.9em;
        }
        .btn-primary {
            background: #4a3df5;
            color: #fff;
        }
        .btn-primary:hover {
            background: #3a2dbf;
        }
        .btn-sm {
            padding: 5px 10px;
            font-size: 0.8em;
        }
        /* Home Link */
        ul.home-nav {
            list-style: none;
            text-align: center;
            padding: 0;
            margin-top: 20px;
        }
        ul.home-nav li {
            display: inline;
            margin: 0 10px;
        }
        ul.home-nav li a {
            text-decoration: none;
            color: #4a3df5;
            font-weight: bold;
        }
    </style>
</head>
<body>
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
    
    <div class="container">
        <h1>Denied Orders</h1>
        @if($orders->isEmpty())
            <p>You have no denied orders.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>${{ $order->total_amount }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="btn btn-primary btn-sm">View Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <ul class="home-nav">
            <li><a href="{{ route('cart.index') }}">Home</a></li>
        </ul>
    </div>
</body>
</html>

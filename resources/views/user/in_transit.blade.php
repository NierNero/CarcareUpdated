<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Transit Orders</title>
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

        .in-transit-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .in-transit-table th,
        .in-transit-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .in-transit-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .in-transit-table td {
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

        .empty-in-transit {
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
    <h2>In Transit Orders</h2>

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="container">
        @if(count($inTransitOrders) > 0)
            <table class="in-transit-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inTransitOrders as $productId => $product)
    <tr>
        <td>{{ $product['ProductName'] }}</td>
        <td>₱{{ number_format($product['Price'], 2) }}</td>
        <td>{{ $product['status'] }}</td>
        <td>
            <form action="{{ route('user.complete', ['userId' => Auth::id(), 'productId' => $productId]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Mark as Complete</button>
            </form>
        </td>
    </tr>
@endforeach
                </tbody>
            </table>
        @else
            <p class="empty-in-transit">No orders in transit.</p>
        @endif
        <a href="{{ route('dashboard') }}" class="home-link">Back to Home</a>
    </div>
</body>

</html>
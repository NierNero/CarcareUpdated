<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
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

        .pending-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .pending-table th,
        .pending-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .pending-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .pending-table td {
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

        .empty-pending {
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
    <h2>Pending Orders</h2>

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="container">
        @if(count($pendingOrders) > 0)
            <table class="pending-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingOrders as $product)
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->ProductName }}">
                                    <h5>{{ $product->ProductName }}</h5>
                                </div>
                            </td>
                            <td>₱{{ number_format($product->Price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="empty-pending">No pending orders.</p>
        @endif
        <a href="{{ route('dashboard') }}" class="home-link">Back to Home</a>
    </div>
</body>

</html>
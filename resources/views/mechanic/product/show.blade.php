<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: white;
            padding: 20px;
            background-color: #4CAF50;
            margin: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-details p {
            font-size: 16px;
            margin: 10px 0;
        }
        .product-details strong {
            color: #4CAF50;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #4CAF50;
            text-decoration: none;
            padding: 10px 15px;
            border: 2px solid #4CAF50;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Product Details</h1>

    <div class="container">
        <div class="product-details">
            <p><strong>Product Name:</strong> {{ $product->ProductName }}</p>
            <p><strong>Description:</strong> {{ $product->Description }}</p>
            <p><strong>Price:</strong> ${{ number_format($product->Price, 2) }}</p>
            <p><strong>Inventory:</strong> {{ $product->Inventory }}</p>
        </div>

        <a href="{{ route('mechanic.productdashboard') }}">Back to Dashboard</a>
    </div>

</body>
</html>

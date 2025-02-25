<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $product->ProductName }} - Carcare</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" media="screen">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        .product-view {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        .product-image {
            flex: 1 1 400px;
            max-width: 500px;
        }
        .product-image img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }
        .product-details {
            flex: 1 1 300px;
        }
        .product-details h2 {
            margin-top: 0;
            font-size: 2em;
        }
        .product-details .price {
            font-size: 1.8em;
            color: #e74c3c;
            margin: 20px 0;
        }
        .product-details p {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .product-attributes p {
            margin: 5px 0;
            font-size: 1em;
        }
        .btn-buy {
            background-color: #ff5722;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-buy:hover {
            background-color: #e64a19;
        }
        .btn-cart {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-cart:hover {
            background-color: #45a049;
        }
        .button-group {
            margin-top: 20px;
        }
        .button-group form {
            display: inline-block;
            margin-right: 10px;
        }
        @media (max-width: 768px) {
            .product-view {
                flex-direction: column;
            }
            .product-details {
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-view">
            <div class="product-image">
                <img src="{{ asset('upload/' . $product->image) }}" alt="{{ $product->ProductName }}">
            </div>
            <div class="product-details">
                <h2>{{ $product->ProductName }}</h2>
                <p class="price">₱{{ number_format($product->Price, 2) }}</p>
                <p>{{ $product->Description }}</p>
                
                <!-- Additional Attributes -->
                <div class="product-attributes">
                    <p><strong>Inventory:</strong> {{ $product->Inventory }}</p>
                    <p><strong>Color:</strong> {{ $product->color }}</p>
                    <p><strong>Width:</strong> {{ $product->width }}</p>
                    <p><strong>Weight:</strong> {{ $product->weight }}</p>
                    <p><strong>Height:</strong> {{ $product->height }}</p>
                </div>

                @if($mechanic)
        <p><strong>Mechanic:</strong> {{ $mechanic->name }}</p>
    @else
        <p><strong>Mechanic:</strong> Not assigned</p>
    @endif
                
                <!-- Button Group -->
                <div class="button-group">
                    <!-- Buy Now Button -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-add">🛒 Add to Cart</button>
                    </form>
                
                    <!-- Buy Now Button -->
                    <form action="{{ route('payments.buyNow', $product->id) }}" method="GET">
                        <button type="submit" class="btn btn-warning">💳 Buy Now</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>

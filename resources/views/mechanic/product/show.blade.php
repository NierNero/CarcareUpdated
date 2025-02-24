<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Details</title>
  <!-- Google Fonts for a modern look -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500&display=swap" rel="stylesheet">
  <style>
    /* Global Styles */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f4f7fc;
      margin: 0;
      padding: 0;
      color: #333;
    }
    header {
      background-color: #007BFF;
      color: #fff;
      padding: 20px;
      text-align: center;
      font-size: 24px;
      font-weight: 500;
      margin: 0;
    }
    /* Container */
    .container {
      max-width: 600px;
      width: 90%;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    /* Product Details */
    .product-details p {
      font-size: 16px;
      margin: 15px 0;
      line-height: 1.5;
    }
    .product-details strong {
      color: #007BFF;
    }
    /* Go Back Button */
    .go-back-btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #fff;
      border: 2px solid #007BFF;
      color: #007BFF;
      text-decoration: none;
      border-radius: 4px;
      font-size: 16px;
      font-weight: 500;
      transition: background-color 0.3s, color 0.3s;
      margin-top: 20px;
      text-align: center;
    }
    .go-back-btn:hover {
      background-color: #007BFF;
      color: #fff;
    }
    /* Responsive Styles */
    @media (max-width: 600px) {
      header {
        font-size: 20px;
        padding: 15px;
      }
      .container {
        margin: 20px;
        padding: 20px;
      }
      .product-details p {
        font-size: 14px;
      }
      .go-back-btn {
        font-size: 14px;
        padding: 8px 12px;
      }
    }
  </style>
</head>
<body>
  <header>Product Details</header>
  <div class="container">
    <div class="product-details">
      <p><strong>Product Name:</strong> {{ $product->ProductName }}</p>
      <p><strong>Description:</strong> {{ $product->Description }}</p>
      <p><strong>Price:</strong> ${{ number_format($product->Price, 2) }}</p>
      <p><strong>Inventory:</strong> {{ $product->Inventory }}</p>
    </div>
    <a href="{{ route('mechanic.productdashboard') }}" class="go-back-btn">Back to Dashboard</a>
  </div>
</body>
</html>

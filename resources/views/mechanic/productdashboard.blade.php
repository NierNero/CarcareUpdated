<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carcare - Online Service Provider for your Car Needs</title>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p6HNd6ipS6/4KxCr6w4lYB0z9dxwZ1M4ew+67l4x7SxHV06q4bUo84J4DskK7s3QENl+T+sK0xI/sz1R+YU1Kg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <style>
    /* Global Reset */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f7fc;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    /* Main Content & Container */
    .main-content {
      margin-left: 250px; /* Adjust based on your sidebar width */
      padding: 20px;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h4 {
      text-align: center;
      color: #2e1ec2; /* Blue accent */
      margin-bottom: 10px;
      font-size: 1.6em;
    }
    hr {
      border: none;
      border-top: 1px solid #eee;
      margin: 20px 0;
    }
    /* Add Product Button */
    .add-product-btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #007BFF;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .add-product-btn:hover {
      background-color: #0069d9;
    }
    /* Filter Container */
    .filter-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      margin-bottom: 20px;
      gap: 10px;
    }
    .filter-container input[type="text"],
    .filter-container select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 0.95em;
      flex: 1;
    }
    .filter-container button {
      padding: 8px 15px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 0.95em;
      cursor: pointer;
      transition: background 0.3s;
    }
    .filter-container button:hover {
      background-color: #0069d9;
    }
    /* Product Grid - Using Flex Instead of Table */
    .product-grid {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }
    .product-header,
    .product-row {
      display: flex;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ddd;
      cursor: pointer;
    }
    .product-header {
      background-color: #007BFF;
      color: #fff;
      font-weight: bold;
      cursor: default;
    }
    .product-row:hover {
      background-color: #f1f1f1;
    }
    .col {
      padding: 0 10px;
      flex: 1;
      text-align: left;
    }
    .col.product-name {
      flex: 2;
    }
    .col.actions {
      flex: 1.5;
      text-align: center;
    }
    /* Action Buttons with Icons */
    .view-btn, .edit-btn, .delete-btn {
      display: inline-block;
      padding: 6px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 0.85em;
      margin-right: 5px;
      transition: background 0.3s;
      color: #fff;
    }
    .view-btn {
      background-color: #007BFF;
    }
    .view-btn:hover {
      background-color: #0069d9;
    }
    .edit-btn {
      background-color: #ffc107;
    }
    .edit-btn:hover {
      background-color: #e0a800;
    }
    .delete-btn {
      background-color: #dc3545;
      border: none;
      cursor: pointer;
    }
    .delete-btn:hover {
      background-color: #c82333;
    }
    /* Back Link */
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #007BFF;
      font-weight: bold;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    /* Responsive Styles */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 10px;
      }
      .filter-container {
        flex-direction: column;
        align-items: stretch;
      }
      .product-header, .product-row {
        flex-direction: column;
        text-align: left;
      }
      .col {
        padding: 5px 0;
      }
      .col.actions {
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar Component -->
  <x-sidebar />

  <!-- Main Content -->
  <div class="main-content">
    <div class="container">
      <h4>Product List</h4>
      <hr />
      <div style="text-align: right; margin-bottom: 15px;">
        <a href="{{ route('mechanic.created') }}" class="add-product-btn">Add Product</a>
      </div>
      <div class="filter-container">
        <input type="text" placeholder="Search by Product" />
        <select>
          <option value="">All Statuses</option>
          <option value="Price">Price</option>
          <option value="Description">Description</option>
          <option value="Product Name">Product Name</option>
        </select>
        <button type="submit">Filter</button>
      </div>
      <!-- Product Grid -->
      <div class="product-grid">
        <!-- Header Row -->
        <div class="product-header">
          <div class="col product-name">Product Name</div>
          <div class="col">Description</div>
          <div class="col">Price</div>
          <div class="col">Inventory</div>
          <div class="col actions">Actions</div>
        </div>
        <!-- Product Rows -->
        @foreach ($products as $product)
          <div class="product-row" onclick="window.location.href='{{ route('mechanic.show', $product->id) }}'">
            <div class="col product-name">{{ $product->ProductName }}</div>
            <div class="col">{{ $product->Description }}</div>
            <div class="col">${{ number_format($product->Price, 2) }}</div>
            <div class="col">{{ $product->Inventory }}</div>
            <div class="col actions">
              <a href="{{ route('mechanic.product.edit', $product->id) }}" class="edit-btn" onclick="event.stopPropagation()">
                <i class="fa-solid fa-pen-to-square"></i> Edit
              </a>
              <form action="{{ route('mechanic.destroy', $product->id) }}" method="POST" style="display:inline;" onclick="event.stopPropagation()">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
      <a href="{{ route('mechanic.dashboard') }}" class="back-link">Back</a>
    </div>
  </div>
  
  <!-- Font Awesome Script (if needed) -->
  <!-- <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script> -->
</body>
</html>

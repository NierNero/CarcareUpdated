<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<body>
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h2>Product List</h2>
            <hr />
            <div style="margin: 10px 0; text-align: right;">
                <a href="{{ route('mechanic.created') }}" class="add-product-btn" style="padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Add Product</a>
            </div>

            <div class="filter-container">
                <input type="text" placeholder="Search by Product" />
                <select>
                    <option value="">All Statuses</option>
                    <option value="Price">Price</option>
                    <option value="Description">Description</option>
                    <option value="Product Name">Product Name</option>
                </select>
            </div>

            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Inventory</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->ProductName }}</td>
                                <td>{{ $product->Description }}</td>
                                <td>{{ $product->Price }}</td>
                                <td>{{ $product->Inventory }}</td>
                                <td>
                                    <a href="{{ route('mechanic.show', $product->id) }}" class="view-btn">View</a>
                                    <a href="{{ route('mechanic.product.edit', $product->id) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('mechanic.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

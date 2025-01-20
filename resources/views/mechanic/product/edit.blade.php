<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-top: 5px;
        }
        button {
            padding: 12px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        .error-messages {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 14px;
        }
        .error-messages ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }
        .error-messages li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <h1>Edit Product</h1>

    <!-- Displaying error messages -->
    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <form action="{{ route('mechanic.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="ProductName">Product Name:</label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" value="{{ $product->ProductName }}" required>
            </div>

            <div class="form-group">
                <label for="Description">Description:</label>
                <textarea class="form-control" id="Description" name="Description">{{ $product->Description }}</textarea>
            </div>

            <div class="form-group">
                <label for="Price">Price:</label>
                <input type="number" class="form-control" id="Price" name="Price" value="{{ $product->Price }}" required>
            </div>

            <div class="form-group">
                <label for="Inventory">Inventory:</label>
                <input type="number" class="form-control" id="Inventory" name="Inventory" value="{{ $product->Inventory }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>
</html>

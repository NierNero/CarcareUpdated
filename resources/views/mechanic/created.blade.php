<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
  <!-- Google Fonts -->
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
    /* Container for the form */
    .container {
      max-width: 600px;
      width: 90%;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    /* Error messages styling */
    .error-messages {
      background-color: #f8d7da;
      color: #721c24;
      padding: 10px;
      margin: 20px auto;
      width: 90%;
      max-width: 600px;
      border-radius: 4px;
      font-size: 14px;
    }
    .error-messages ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }
    .error-messages li {
      margin-bottom: 5px;
    }
    /* Form Styles */
    form {
      display: flex;
      flex-direction: column;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 16px;
    }
    textarea {
      resize: vertical;
      min-height: 80px;
    }
    button {
      padding: 12px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #0069d9;
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
      margin: 20px auto;
      text-align: center;
    }
    .go-back-btn:hover {
      background-color: #007BFF;
      color: #fff;
    }
    /* Preview Image */
    #imagePreview {
      display: none;
      max-width: 100%;
      margin-top: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
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
      input, textarea {
        font-size: 14px;
      }
      button, .go-back-btn {
        font-size: 14px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <header>Add Product</header>
  
  <!-- Displaying error messages if any -->
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
    <form action="{{ route('mechanic.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="ProductName">Product Name:</label>
        <input type="text" id="ProductName" name="ProductName" required>
      </div>
      <div class="form-group">
        <label for="Description">Description:</label>
        <textarea id="Description" name="Description"></textarea>
      </div>
      <div class="form-group">
        <label for="Price">Price:</label>
        <input type="number" id="Price" name="Price" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="Inventory">Inventory:</label>
        <input type="number" id="Inventory" name="Inventory" required>
      </div>
      <div class="form-group">
        <label for="color">Color:</label>
        <input type="text" id="color" name="color">
      </div>
      <div class="form-group">
        <label for="width">Width:</label>
        <input type="text" id="width" name="width">
      </div>
      <div class="form-group">
        <label for="weight">Weight:</label>
        <input type="text" id="weight" name="weight">
      </div>
      <div class="form-group">
        <label for="height">Height:</label>
        <input type="text" id="height" name="height">
      </div>
      <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image">
        <!-- Image preview container -->
        <img id="imagePreview" src="#" alt="Image Preview">
      </div>
      <button type="submit">Add Product</button>
      <!-- Go Back Button -->
      <div style="text-align: center;">
        <a href="{{ route('mechanic.productdashboard') }}" class="go-back-btn">Go Back</a>
      </div>
    </form>
  </div>

  <!-- JavaScript for image preview -->
  <script>
    document.getElementById('image').addEventListener('change', function(event) {
      const [file] = this.files;
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const preview = document.getElementById('imagePreview');
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
      }
    });
  </script>
</body>
</html>

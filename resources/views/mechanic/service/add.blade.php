<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Service</title>
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
      margin-bottom: 20px;
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
    input[type="text"],
    textarea {
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
    /* Redesigned Go Back Button */
    .go-back-btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #fff;
      border: 2px solid #007BFF;
      color: #007BFF;
      text-decoration: none;
      border-radius: 5px;
      font-size: 16px;
      font-weight: 500;
      transition: background-color 0.3s, color 0.3s;
      margin: 20px auto;
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
      input[type="text"],
      textarea {
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
  <header>Add Service</header>
  <!-- Redesigned Go Back Button -->


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
    <form action="{{ route('mechanic.storage') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="name">Service Name:</label>
        <input type="text" name="name" id="name" required>
      </div>
      <div class="form-group">
        <label for="description">Service Description:</label>
        <textarea name="description" id="description"></textarea>
      </div>
      <div class="form-group">
        <label for="price">Service Price:</label>
        <input type="text" name="price" id="price" required>
      </div>
      <button type="submit">Add Service</button>
      <div style="text-align: center;">
        <a href="{{ route('mechanic.dashboard') }}" class="go-back-btn">Go Back</a>
      </div>
    </form>
  </div>
</body>
</html>

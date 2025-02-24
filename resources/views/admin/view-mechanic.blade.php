<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mechanic Details</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f7fc;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .card {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .card h2 {
      text-align: center;
      color: #007BFF;
      margin-bottom: 20px;
    }
    .mechanic-info {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .mechanic-info img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
    }
    .mechanic-details p {
      margin: 10px 0;
      font-size: 16px;
      line-height: 1.5;
    }
    .mechanic-details p strong {
      color: #007BFF;
    }
    @media (max-width: 600px) {
      .card {
        padding: 15px;
      }
      .mechanic-details p {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Mechanic Details</h2>
    <div class="mechanic-info">
      @if($mechanic->image)
        <img src="{{ asset('upload/' . $mechanic->image) }}" alt="Mechanic Image">
      @endif
      <div class="mechanic-details">
        <p><strong>Name:</strong> {{ $mechanic->shopname }}</p>
        <p><strong>Email:</strong> {{ $mechanic->email }}</p>
        <p><strong>Contact No:</strong> {{ $mechanic->ContactNo }}</p>
        <p><strong>Address:</strong> {{ $mechanic->Address }}</p>
        <p><strong>Created At:</strong> {{ $mechanic->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $mechanic->updated_at }}</p>
      </div>
    </div>
  </div>
</body>
</html>

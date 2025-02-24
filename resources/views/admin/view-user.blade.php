<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Details</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f4f7fc;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .card {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 20px;
    }
    .card h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #007BFF;
    }
    .user-info {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .user-info img {
      border-radius: 50%;
      margin-bottom: 20px;
      width: 120px;
      height: 120px;
      object-fit: cover;
    }
    .user-details p {
      margin: 8px 0;
      font-size: 16px;
      line-height: 1.5;
    }
    .user-details p strong {
      color: #007BFF;
    }
    @media (max-width: 600px) {
      .card {
        padding: 15px;
      }
      .user-details p {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>User Details</h2>
    <div class="user-info">
      @if($user->image)
        <img src="{{ asset('upload/' . $user->image) }}" alt="User Image">
      @endif
      <div class="user-details">
        <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Contact No:</strong> {{ $user->phone_number }}</p>
        <p><strong>Address:</strong> {{ $user->address }}</p>
        <p><strong>Created At:</strong> {{ $user->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $user->updated_at }}</p>
      </div>
    </div>
  </div>
</body>
</html>

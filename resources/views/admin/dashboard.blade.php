<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .navbar {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-weight: bold;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .header {
            background-color: #f1f1f1;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .search-container {
            margin: 20px auto;
            text-align: center;
        }
        .search-container input {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .table-container {
            margin: 20px auto;
            width: 90%;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .actions button {
            padding: 8px 12px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .actions button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div>
            <a href="{{ route('admin.dashboard') }}">Home</a>
            <a href="{{ route('adminbooking') }}">Booking</a>
            <a href="{{ route('adminreport') }}">Report</a>
        </div>
        <div>
            <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; color: white; border: none; cursor: pointer; font-weight: bold;">
                    Log Out
                </button>
            </form>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>Admin Dashboard - User Accounts</h1>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <input type="text" placeholder="Search users or mechanics...">
    </div>

    <!-- Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <!-- Users -->
                @foreach ($users as $user)
                    <tr onclick="redirectToView('{{ route('admin.user.view', $user->id) }}')">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->ContactNo }}</td>
                        <td>{{ $user->Address }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            @if($user->image)
                                <img src="{{ asset('upload/users/' . $user->image) }}" alt="User Image" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="actions">
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <!-- Mechanics -->
                @foreach ($mechanics as $mechanic)
                    <tr onclick="redirectToView('{{ route('admin.mechanic.view', $mechanic->id) }}')">
                        <td>{{ $mechanic->id }}</td>
                        <td>{{ $mechanic->name }}</td>
                        <td>{{ $mechanic->ContactNo }}</td>
                        <td>{{ $mechanic->Address }}</td>
                        <td>{{ $mechanic->email }}</td>
                        <td>{{ $mechanic->created_at }}</td>
                        <td>{{ $mechanic->updated_at }}</td>
                        <td>
                            @if($mechanic->image)
                                <img src="{{ asset('upload/mechanic/' . $mechanic->image) }}" alt="Mechanic Image" width="80">
                            @else
                                No Image
                            @endif
                        </td>
                        <td class="actions">
                            <form action="{{ route('admin.mechanic.destroy', $mechanic->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function redirectToView(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>

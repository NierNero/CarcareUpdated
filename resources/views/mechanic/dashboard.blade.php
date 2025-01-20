<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    
    <!-- Add some basic CSS styling -->
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
            left: 0;
            top: 0;
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #45a049;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* Content Styles */
        .content {
            margin-left: 260px;
            padding: 20px;
            flex-grow: 1;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Header */
        table thead {
            background-color: #28a745;
            color: white;
        }

        table th {
            padding: 12px;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
        }

        /* Table Rows */
        table tbody tr {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a, .action-buttons button {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
        }

        .view-btn {
            background-color: #007bff;
        }

        .edit-btn {
            background-color: #ffc107;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .view-btn:hover {
            background-color: #0056b3;
        }

        .edit-btn:hover {
            background-color: #e0a800;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .add-service-btn {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }

        .add-service-btn:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
    @foreach ($services as $service)
        <h2>{{ $service->name }}</h2>
        <a href="{{ route('mechanic.dashboard') }}">Service</a>
        <a href="{{ route('mechanic.productdashboard') }}">Product</a>
        <a href="{{ route('mechanic.order') }}">Orders</a>
        <a href="{{ route('profile.edit') }}">Profile</a>
        <a href="{{ route('mechanic.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>

        <!-- Logout form -->
        <form id="logout-form" action="{{ route('mechanic.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @endforeach
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Service Section -->
        <section>
            <div class="text-center">
                <h2>Services</h2>
            </div>
            <div style="margin-top: 10px; margin-bottom: 20px; text-align: right;">
                <a href="{{ route('mechanic.service.add') }}" class="add-service-btn">Add Service</a>
            </div>

            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->description }}</td>
                                <td>{{ $service->price }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('mechanic.shows', $service) }}" class="view-btn">View</a>
                                    <a href="{{ route('mechanic.edit', $service) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('mechanic.destroys', $service) }}" method="POST" style="display:inline;">
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
        </section>
    </div>

</body>
</html>

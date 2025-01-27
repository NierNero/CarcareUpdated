<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <style>
        /* Button Styling */
    .view-btn, .edit-btn, .delete-btn {
        padding: 8px 12px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        color: white;
        display: inline-block;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .view-btn {
        background-color: #2196f3; /* Blue */
    }

    .view-btn:hover {
        background-color: #1976d2;
    }

    .edit-btn {
        background-color: #ff9800; /* Orange */
    }

    .edit-btn:hover {
        background-color: #e68900;
    }

    .delete-btn {
        background-color: #f44336; /* Red */
        border: none;
    }

    .delete-btn:hover {
        background-color: #d32f2f;
    }

    .delete-btn:active {
        transform: scale(0.98);
    }
    
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            margin: 0;
            min-height: 100vh;
            background-color: #f4f7fc;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            background-color: #4CAF50;
            color: white;
            position: fixed;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 15px 20px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #45a049;
            padding-left: 25px;
        }

        /* Sidebar toggle for small screens */
        .sidebar.hidden {
            transform: translateX(-100%);
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        h4 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin-bottom: 20px;
        }

        /* Filter Section */
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        .filter-container input, .filter-container select {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .filter-container input:focus, .filter-container select:focus {
            outline: none;
            border-color: #4CAF50;
        }

        /* Table Styling */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }

        tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Buttons */
        .action-button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .action-button.shipped {
            background-color: #3f51b5;
        }

        .action-button.shipped:hover {
            background-color: #303f9f;
        }

        .action-button.pending {
            background-color: #ff9800;
        }

        .action-button.pending:hover {
            background-color: #e68900;
        }

        .action-button[disabled] {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Order status badges */
        .order-status {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            text-transform: capitalize;
            font-weight: bold;
        }

        .order-status.pending {
            background-color: #ffeb3b;
            color: #856404;
        }

        .order-status.completed {
            background-color: #4caf50;
            color: white;
        }

        .order-status.processing {
            background-color: #2196f3;
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
                padding-top: 10px;
            }

            .sidebar h2 {
                font-size: 20px;
            }

            .sidebar a {
                font-size: 16px;
            }

            .main-content {
                margin-left: 0;
                padding: 15px;
            }

            table th, table td {
                font-size: 14px;
                padding: 10px;
            }

            h4 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                display: none;
            }

            .table-container table {
                font-size: 12px;
            }

            .filter-container input, .filter-container select {
                flex: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Carcare Services</h2>
        <a href="{{ route('mechanic.dashboard') }}">Service</a>
        <a href="{{ route('mechanic.productdashboard') }}">Product</a>
        <a href="{{ route('mechanic.order') }}">Orders</a>
        <a href="{{ route('mechanic.booking.show') }}">Booking</a>
        <a href="{{ route('profile.edit') }}">Profile</a>
        <a href="{{ route('mechanic.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        <form id="logout-form" action="{{ route('mechanic.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h4>Service List</h4>
            <hr />
            <div style="margin: 10px 0; text-align: right;">
                <a href="{{ route('mechanic.service.add') }}" class="add-service-btn" style="padding: 10px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Add Service</a>
            </div>

            <div class="filter-container">
                <input type="text" placeholder="Search by Services" />
                <select>
                    <option value="">All Statuses</option>
                    <option value="Price">Price</option>
                    <option value="Description">Description</option>
                    <option value="Service Name">Service Name</option>
                </select>
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
                                <td>${{ number_format($service->price, 2) }}</td>
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
        </div>
    </div>
</body>
</html>

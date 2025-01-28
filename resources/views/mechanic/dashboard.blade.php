<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carcare - Online Service Provider for your Car Needs</title>
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
</head>
<body>
    <!-- Sidebar -->
    <x-sidebar />

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

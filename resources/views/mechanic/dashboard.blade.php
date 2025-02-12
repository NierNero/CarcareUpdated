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

            <!-- Search and Filter Form -->
            <form method="GET" action="{{ route('mechanic.dashboard') }}">
                <div class="filter-container">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by Services" />
                    <select name="filter">
                        <option value="">All Statuses</option>
                        <option value="price" {{ request('filter') == 'price' ? 'selected' : '' }}>Price</option>
                        <option value="description" {{ request('filter') == 'description' ? 'selected' : '' }}>Description</option>
                        <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>Service Name</option>
                    </select>
                    <button type="submit">Filter</button>
                </div>
            </form>

            <!-- Service List Table -->
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Actions</th>
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
                                        <button type="submit" class="delete-btn" data-service-id="{{ $service->id }}">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    
    <script>
       
        // Client-side filter (optional, if not handled by backend)
        document.querySelector('input[name="search"]').addEventListener('input', function () {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('table tbody tr');
            rows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                row.style.display = name.includes(searchText) ? '' : 'none';
            });
        });
    </script>
</body>
</html>

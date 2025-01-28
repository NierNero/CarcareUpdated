<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <title>Product & Order Management</title>
    
</head>
<body>
    <!-- Sidebar -->
    <x-sidebar />

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <h4>Order List</h4>
            <hr />

            <!-- Filter Section -->
            <div class="filter-container">
                <input type="text" placeholder="Search by Customer or Product" />
                <select>
                    <option value="">All Statuses</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Pending">Pending</option>
                    <option value="Delivered">Delivered</option>
                </select>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ryan Jay Suazo</td>
                            <td>Belt Haha</td>
                            <td><span class="order-status shipped">Shipped</span></td>
                            <td>2023-09-20</td>
                            <td>
                                <button class="action-button shipped">Delivered</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>James Mijares</td>
                            <td>Tire</td>
                            <td><span class="order-status pending">Pending</span></td>
                            <td>2023-09-21</td>
                            <td>
                                <button class="action-button pending">Ship Order</button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Luisse Crispe</td>
                            <td>Oil Filter</td>
                            <td><span class="order-status completed">Delivered</span></td>
                            <td>2023-09-18</td>
                            <td>
                                <button class="action-button shipped" disabled>Delivered</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

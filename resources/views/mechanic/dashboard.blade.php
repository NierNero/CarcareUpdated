<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Dashboard - Carcare</title>
  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-somehashvalue" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <style>
    /* Global Reset */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f7fc;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    /* Main Content & Container */
    .main-content {
      margin-left: 250px; /* Adjust based on your sidebar width */
      padding: 20px;
    }
    .container {
      max-width: 1200px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    h4 {
      text-align: center;
      color: #2e1ec2; /* Blue accent */
      margin-bottom: 10px;
      font-size: 1.6em;
    }
    hr {
      border: none;
      border-top: 1px solid #eee;
      margin: 20px 0;
    }
    /* Add Service Button */
    .add-service-btn {
      display: inline-block;
      padding: 10px 15px;
      background-color: #007BFF;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .add-service-btn:hover {
      background-color: #0069d9;
    }
    /* Filter Container */
    .filter-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: flex-end;
      margin-bottom: 20px;
    }
    .filter-container input[type="text"],
    .filter-container select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 0.95em;
      flex: 1;
    }
    .filter-container button {
      padding: 8px 15px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 0.95em;
      cursor: pointer;
      transition: background 0.3s;
    }
    .filter-container button:hover {
      background-color: #0069d9;
    }
    /* Service Grid Layout */
    .service-grid {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 20px;
    }
    /* Header Row */
    .grid-header {
      display: flex;
      align-items: center;
      background-color: #007BFF;
      color: #fff;
      padding: 10px;
      font-weight: bold;
    }
    /* Data Row */
    .grid-row {
      display: flex;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ddd;
      cursor: pointer;
      transition: background 0.3s;
    }
    .grid-row:hover {
      background-color: #f1f1f1;
    }
    .col {
      padding: 0 10px;
      flex: 1;
      text-align: left;
    }
    /* Make Service Name column wider */
    .col.service-name {
      flex: 2;
    }
    .col.actions {
      flex: 1.5;
      text-align: center;
    }
    /* Action Buttons with Icons */
    .action-buttons a,
    .action-buttons button {
      display: inline-block;
      padding: 6px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 0.9em;
      margin-right: 5px;
      transition: background 0.3s;
      color: #fff;
    }

    .view-btn, .edit-btn, .delete-btn {
      display: inline-block;
      padding: 6px 10px;
      text-decoration: none;
      border-radius: 4px;
      font-size: 0.85em;
      margin-right: 5px;
      transition: background 0.3s;
      color: #fff;
    }
    .edit-btn {
      background-color: #007BFF;
    }
    .edit-btn:hover {
      background-color: #0069d9;
    }
    .delete-btn {
      background-color: #007BFF;
      border: none;
      cursor: pointer;
    }
    .delete-btn:hover {
      background-color: #0069d9;
    }
    /* Back Link */
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #007BFF;
      font-weight: bold;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    /* Responsive Styles */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 10px;
      }
      .filter-container {
        flex-direction: column;
        align-items: stretch;
      }
      .grid-header, .grid-row {
        flex-direction: column;
        text-align: left;
      }
      .col {
        padding: 5px 0;
      }
      .col.actions {
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar Component -->
  <x-sidebar />
  
  <!-- Main Content -->
  <div class="main-content">
    <div class="container">
      <h4>Service List</h4>
      <hr />
      <div style="text-align: right; margin-bottom: 15px;">
        <a href="{{ route('mechanic.service.add') }}" class="add-service-btn">Add Service</a>
      </div>
      <div class="filter-container">
        <input type="text" name="search" placeholder="Search by Service" />
        <select name="filter">
          <option value="">All Statuses</option>
          <option value="price">Price</option>
          <option value="description">Description</option>
          <option value="name">Service Name</option>
        </select>
        <button type="submit">Filter</button>
      </div>
      <!-- Service Grid using divs (instead of table) -->
      <div class="service-grid">
        <!-- Header Row -->
        <div class="grid-header">
          <div class="col service-name">Service Name</div>
          <div class="col">Description</div>
          <div class="col">Price</div>
          <div class="col actions">Actions</div>
        </div>
        <!-- Data Rows -->
        @foreach ($services as $service)
          <div class="grid-row" onclick="window.location.href='{{ route('mechanic.shows', $service->id) }}'">
            <div class="col service-name">{{ $service->name }}</div>
            <div class="col">{{ $service->description }}</div>
            <div class="col">${{ number_format($service->price, 2) }}</div>
            <div class="col actions">
              <a href="{{ route('mechanic.edit', $service->id) }}" class="edit-btn" onclick="event.stopPropagation()">
                <i class="fa-solid fa-pen-to-square"></i> Edit
              </a>
              <form action="{{ route('mechanic.destroys', $service->id) }}" method="POST" style="display:inline;" onclick="event.stopPropagation()">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">
                  <i class="fa-solid fa-trash"></i> Delete
                </button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
      <a href="{{ route('mechanic.dashboard') }}" class="back-link">Back</a>
    </div>
  </div>
  
  <!-- Font Awesome Script (if needed) -->
  <!-- <script src="https://kit.fontawesome.com/yourkitid.js" crossorigin="anonymous"></script> -->
</body>
</html>

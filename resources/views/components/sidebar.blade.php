<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Carcare Sidebar</title>
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    /* Sidebar Container */
    .sidebar {
      width: 280px;
      height: 100vh;
      background: #ffffff;
      color: #007BFF;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      overflow-y: auto;
      transition: all 0.3s ease;
    }
    /* Sidebar Header with Profile */
    .sidebar-header {
      text-align: center;
      margin-bottom: 30px;
    }
    .profile {
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    .profile-image {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }
    .profile-name {
      font-size: 20px;
      margin: 0;
    }
    /* Sidebar Menu */
    .sidebar-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .sidebar-menu li {
      margin-bottom: 10px;
    }
    .sidebar-menu li a {
      color: #007BFF;
      text-decoration: none;
      display: flex; /* Use flexbox for alignment */
      align-items: center; /* Center items vertically */
      padding: 10px 15px;
      border-radius: 4px;
      transition: background 0.3s, color 0.3s;
    }
    .sidebar-menu li a i {
      margin-right: 10px; /* Space between icon and text */
    }
    .sidebar-menu li a:hover {
      background: #007BFF;
      color: #ffffff;
    }
    /* Dropdown Toggle Styles */
    .sidebar-menu li.dropdown > a {
      cursor: pointer;
      color: #007BFF;
    }
    .sidebar-menu li.dropdown > a:hover {
      background-color: #007BFF; /* Change this to your desired hover color */
      color: #ffffff;
    }
    .sidebar-menu li.dropdown > a::after {
      content: "\25BC";
      position: absolute;
      right: 15px;
      transition: transform 0.3s;
      font-size: 0.8em;
      color: #ffffff;  
    }
    .sidebar-menu li.dropdown.open > a::after {
      transform: rotate(-180deg);
    }
    /* Dropdown Menu Styles */
    .dropdown-menu {
      list-style: none;
      padding: 0;
      margin: 2px 0 0 0;
      background: #ffffff;
      color: #ffffff;
      border-radius: 4px;
      overflow: hidden;
      max-height: 0;
      transition: max-height 0.4s ease-out;
    }
    .sidebar-menu li.dropdown.open .dropdown-menu {
      max-height: 500px; /* adjust as needed */
      transition: max-height 0.5s ease-in;
    }
    .dropdown-menu li a {
      padding: 10px 25px;
      background: #ffffff;
      transition: background 0.5s;
      color: #007BFF;
      display: flex;
      align-items: center;
    }
    .dropdown-menu li a i {
      margin-right: 10px; 
    }
    .dropdown-menu li a:hover {
      background: #007BFF;
    }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }
      .sidebar-header {
        margin-bottom: 20px;
      }
      .sidebar-menu li a {
        justify-content: center; /* Center items horizontally */
      }
      .sidebar-menu li a .profile-name {
        display: none; /* Hide profile name in smaller screens */
      }
      .main-content {
        margin-left: 0;
        padding: 10px;
      }
      /* Hide text in sidebar links and only show icons */
      .sidebar-menu li a span {
        display: none; /* Hide the text */
      }
      /* Make the icons larger on smaller screens */
      .sidebar-menu li a i {
        font-size: 1.5em; /* Increase icon size */
      }
    }
    
  </style>
</head>
<body>
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="profile">
        @php
          $mechanic = auth()->guard('mechanic')->user();
        @endphp
        <img src="{{ $mechanic && $mechanic->image ? asset('upload/' . $mechanic->image) : asset('img/avatar.png') }}" alt="{{ $mechanic->shopname ?? 'Your Shop' }}" class="profile-image">
        <h3 class="profile-name">Hello {{ $mechanic->shopname ?? 'Your Shop' }}!</h3>
      </div>
    </div>
    <ul class="sidebar-menu">
      <li><a href="{{ route('mechanic.dashboard') }}"><i class="fas fa-tools"></i><span>Service</span></a></li>
      <li><a href="{{ route('mechanic.productdashboard') }}"><i class="fas fa-box"></i><span>Product</span></a></li>
      <li class="dropdown">
        <a href="{{ route('mechanic.orders') }}" class="dropdown-toggle"><i class="fas fa-shopping-cart"></i><span>Orders</span></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('mechanic.orders', ['status' => 'pending']) }}"><i class="fas fa-hourglass-half"></i><span>Pending Orders</span></a></li>
          <li><a href="{{ route('mechanic.orders', ['status' => 'completed']) }}"><i class="fas fa-check-circle"></i><span>Completed Orders</span></a></li>
          <li><a href="{{ route('mechanic.orders', ['status' => 'denied']) }}"><i class="fas fa-times-circle"></i><span>Cancelled Orders</span></a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle"><i class="fas fa-calendar-alt"></i><span>Booking</span></a>
        <ul class="dropdown-menu">
          <li><a href="{{ route('mechanic.booking.bookingdashboard', ['status' => 'pending']) }}"><i class="fas fa-hourglass-half"></i><span>Pending Booking</span></a></li>
          <li><a href="{{ route('mechanic.booking.show', ['status' => 'completed']) }}"><i class="fas fa-check-circle"></i><span>Completed Booking</span></a></li>
          <li><a href="{{ route('mechanic.booking.show', ['status' => 'cancelled']) }}"><i class="fas fa-times-circle"></i><span>Cancelled Booking</span></a></li>
        </ul>
      </li>
      <li><a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i><span>Profile</span></a></li>
      <li>
        <a href="{{ route('mechanic.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i><span>Log Out</span>
        </a>
      </li>
    </ul>
    <!-- Logout form -->
    <form id="logout-form" action="{{ route('mechanic.logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>

  <script>
    // Toggle dropdown menus on click
    document.querySelectorAll('.sidebar-menu li.dropdown > a').forEach(function(toggle) {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        this.parentElement.classList.toggle('open');
      });
    });
  </script>
</body>
</html>
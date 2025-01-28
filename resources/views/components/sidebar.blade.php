<div class="sidebar">
        <h2>Shop Dashboard</h2>
        <a href="{{ route('mechanic.dashboard') }}">Service</a>
        <a href="{{ route('mechanic.productdashboard') }}">Product</a>
        <div class="dropdown">
            <a href="{{ route('mechanic.order') }}" class="dropdown-toggle">Orders</a>
            <div class="dropdown-menu">
                <a href="{{ route('mechanic.order', ['status' => 'pending']) }}">Pending Orders</a>
                <a href="{{ route('mechanic.order', ['status' => 'completed']) }}">Completed Orders</a>
                <a href="{{ route('mechanic.order', ['status' => 'cancelled']) }}">Cancelled Orders</a>
            </div>
        </div>        
<!-- Booking Dropdown -->
<div class="dropdown">
        <a href="#" class="dropdown-toggle">Booking</a>
        <div class="dropdown-menu">
        <a href="{{ route('mechanic.booking.show', ['status' => 'pending']) }}">Pending Booking</a>
        <a href="{{ route('mechanic.booking.show', ['status' => 'completed']) }}">Completed Booking</a>
        <a href="{{ route('mechanic.booking.show', ['status' => 'cancelled']) }}">Cancelled Booking</a>
        </div>
    </div>        <a href="{{ route('profile.edit') }}">Profile</a>
        <a href="{{ route('mechanic.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
        <!-- Logout form -->
        <form id="logout-form" action="{{ route('mechanic.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
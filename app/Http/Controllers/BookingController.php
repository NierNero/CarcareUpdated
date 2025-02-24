<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Show all customer pending orders to the mechanic
    public function show()
    {
        // Retrieve all pending orders from all users
        $orders = auth()->user()->orders()->with('items.product')->get();

        return view('mechanic.orders', compact('allPendingOrders'));
    }

    // Accept a pending order
    
    // Show in-transit orders for the user
    

// Show completed orders for the mechanic
public function mechanicComplete()
{
    // Retrieve all completed orders from all users
    $allCompletedOrders = $this->getAllCompletedOrders();

    return view('mechanic.booking.complete', compact('allCompletedOrders'));
}

// Helper method to get all completed orders from all users
protected function getAllCompletedOrders()
{
    $allCompletedOrders = [];
    foreach (Session::all() as $key => $value) {
        if (strpos($key, 'completed_orders_') === 0) { // Check if the key is for completed orders
            $userId = str_replace('completed_orders_', '', $key);
            $allCompletedOrders[$userId] = $value;
        }
    }

    return $allCompletedOrders;
}
}
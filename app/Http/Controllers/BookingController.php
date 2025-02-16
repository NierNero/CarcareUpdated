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
        $allPendingOrders = $this->getAllPendingOrders();

        return view('mechanic.booking.bookingdashboard', compact('allPendingOrders'));
    }

    // Accept a pending order
    public function accept($userId, $productId)
    {
        // Retrieve the specific user's pending orders
        $pendingOrders = $this->getUserPendingOrders($userId);

        if (isset($pendingOrders[$productId])) {
            // Move the order to in-transit orders
            $inTransitOrders = Session::get("in_transit_orders_$userId", []);
            $inTransitOrders[$productId] = $pendingOrders[$productId];
            $inTransitOrders[$productId]['status'] = 'in_transit'; // Update status
            Session::put("in_transit_orders_$userId", $inTransitOrders);

            // Remove the order from pending orders
            unset($pendingOrders[$productId]);
            $this->updateUserPendingOrders($userId, $pendingOrders);

            return redirect()->route('mechanic.booking.show')->with('success', 'Order accepted and moved to In Transit!');
        }

        return redirect()->route('mechanic.booking.show')->with('error', 'Order not found!');
    }

    // Decline a pending order
    public function decline($userId, $productId)
    {
        // Retrieve the specific user's pending orders
        $pendingOrders = $this->getUserPendingOrders($userId);

        if (isset($pendingOrders[$productId])) {
            // Remove the declined order
            unset($pendingOrders[$productId]);
            $this->updateUserPendingOrders($userId, $pendingOrders);

            return redirect()->route('mechanic.booking.show')->with('success', 'Order declined successfully!');
        }

        return redirect()->route('mechanic.booking.show')->with('error', 'Order not found!');
    }

    // Show in-transit orders for the user
    public function inTransit()
    {
        $userId = Auth::id(); // Get the current user's ID
        $inTransitOrders = Session::get("in_transit_orders_$userId", []); // Retrieve in-transit orders for the current user

        return view('user.in_transit', compact('inTransitOrders'));
    }

    // Helper method to get all pending orders from all users
    protected function getAllPendingOrders()
    {
        $allPendingOrders = [];
        foreach (Session::all() as $key => $value) {
            if (strpos($key, 'pending_orders_') === 0) { // Check if the key is for pending orders
                $userId = str_replace('pending_orders_', '', $key);
                $allPendingOrders[$userId] = $value;
            }
        }

        return $allPendingOrders;
    }

    // Helper method to get pending orders for a specific user
    protected function getUserPendingOrders($userId)
    {
        return Session::get("pending_orders_$userId", []);
    }

    // Helper method to update pending orders for a specific user
    protected function updateUserPendingOrders($userId, $pendingOrders)
    {
        Session::put("pending_orders_$userId", $pendingOrders);
    }

    // Mark an in-transit order as complete
public function complete($userId, $productId)
{
    // Retrieve the specific user's in-transit orders
    $inTransitOrders = Session::get("in_transit_orders_$userId", []);

    if (isset($inTransitOrders[$productId])) {
        // Move the order to completed orders
        $completedOrders = Session::get("completed_orders_$userId", []);
        $completedOrders[$productId] = $inTransitOrders[$productId];
        $completedOrders[$productId]['status'] = 'completed'; // Update status
        Session::put("completed_orders_$userId", $completedOrders);

        // Remove the order from in-transit orders
        unset($inTransitOrders[$productId]);
        Session::put("in_transit_orders_$userId", $inTransitOrders);

        return redirect()->route('user.in_transit')->with('success', 'Order marked as complete!');
    }

    return redirect()->route('user.in_transit')->with('error', 'Order not found!');
}

// Show completed orders for the user
public function userComplete()
{
    $userId = Auth::id(); // Get the current user's ID
    $completedOrders = Session::get("completed_orders_$userId", []); // Retrieve completed orders for the current user

    return view('user.complete', compact('completedOrders'));
}

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
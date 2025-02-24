<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class MechanicController extends Controller
{
    // Existing methods for managing mechanics
    public function index()
    {
        // Retrieve the authenticated mechanic (ensure you're using the correct guard if needed)
        $mechanic = Auth::guard('mechanic')->user(); 
        // If you need a list of mechanics for some purpose:
        $mechanics = Mechanic::all();
        return view('mechanic.dashboard', compact('mechanics'));
    }

    public function create()
    {
        return view('mechanic.creates');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mechanics',
            'password' => 'required|string|min:8|confirmed',
            'shopname' => 'required|string|max:255',
            'ContactNo' => 'nullable|string|max:20',  // Added validation for ContactNo
            'Address' => 'nullable|string|max:255',   // Added validation for Address
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Initialize the image path variable as null
        $imagePath = null;

        // Check if a file is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
            $imagePath = $file_name; // Set the image path
        }

        // Create the Mechanic record
        $mechanic = Mechanic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shopname' => $request->shopname,
            'image' => $imagePath, // Assign the image path here
            'ContactNo' => $request->ContactNo,  // Save ContactNo
            'Address' => $request->Address,      // Save Address
        ]);

        return redirect()->route('mechanic.login')->with('success', 'Mechanic added successfully!');
    }

    public function logout()
    {
        Auth::guard('mechanic')->logout(); // Log out the mechanic

        // Redirect to the login page with a success message
        return redirect()->route('mechanic.login')->with('success', 'Logged out successfully!');
    }

    // New methods for managing orders
    public function orders(Request $request)
    {
        $user = auth()->user(); // Get authenticated user

    $status = $request->query('status');

    $orders = Order::where('user_id', $user->id) // Use 'user_id' instead of 'mechanic_id'
        ->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->get();

        return view('mechanic.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load('items.product'); // Load related items and products
        return view('mechanic.show', compact('order'));
    }

    // Update order status based on mechanic's action
    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:accepted,denied,in_transit,completed',
        ]);

        // Update the order status
        $order->update(['status' => $request->status]);

        // Redirect back with a success message
        return redirect()->route('mechanic.orders.show', $order)->with('success', 'Order status updated successfully.');
    }
}
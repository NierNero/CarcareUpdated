<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class MechanicController extends Controller
{
    public function index()
    {
        $mechanics = Mechanic::all(); // Fetch all mechanics
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

}
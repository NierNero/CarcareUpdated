<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
    
        $imagePath = null; // Default if no image is uploaded
    
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $customPath = public_path('upload/mechanic');
    
            // Ensure the directory exists
            if (!file_exists($customPath)) {
                mkdir($customPath, 0777, true);
            }
    
            // Move the uploaded file
            $request->image->move($customPath, $imageName);
    
            // Store relative path in DB
            $imagePath = 'upload/mechanic/' . $imageName;
        }
    
        // Create the Mechanic record
        $mechanic = Mechanic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shopname' => $request->shopname,
            'image' => $imagePath,
            'ContactNo' => $request->ContactNo,  // Save ContactNo
            'Address' => $request->Address,      // Save Address
        ]);
    
        return redirect()->route('mechanic.dashboard')->with('success', 'Mechanic added successfully!');
    }
}
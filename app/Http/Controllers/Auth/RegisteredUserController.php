<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car; // Make sure to import the Car model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request including the car details.
        $request->validate([
            'first_name'       => ['required', 'string', 'max:255'],
            'last_name'        => ['required', 'string', 'max:255'],
            'address'          => ['required', 'string', 'max:255'],
            'province'         => ['required', 'string', 'max:255'],
            'region'           => ['required', 'string', 'max:255'],
            'zip_code'         => ['required', 'integer'],
            'phone_number'     => ['required' , 'string', 'max:20'],
            'email'            => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
            // Validate that each car input is provided (adjust these rules as needed)
            'car_type.*'       => ['required', 'string', 'max:255'],
            'car_model.*'      => ['required', 'string', 'max:255'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload (if an image is provided)
        $imagePath = null;

        // Check if a file is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
            $imagePath = $file_name; // Set the image path
        }

        // Create the user.
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'address'      => $request->address,
            'province'     => $request->province,
            'region'       => $request->region,
            'zip_code'     => $request->zip_code,
            'phone_number' => $request->phone_number,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'image'      => $imagePath,
        ]);

        // If the registration form includes multiple car inputs, loop through and save each car.
        if ($request->has('car_type') && $request->has('car_model')) {
            foreach ($request->car_type as $index => $carType) {
                Car::create([
                    'user_id'   => $user->id,
                    'car_type'  => $carType,
                    'car_model' => $request->car_model[$index] ?? null,
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
}

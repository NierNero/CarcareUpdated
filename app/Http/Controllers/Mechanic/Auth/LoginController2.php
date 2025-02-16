<?php

namespace App\Http\Controllers\Mechanic\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController2 extends Controller
{
    // Show the mechanic login form
    public function create()
    {
        // If the mechanic is already authenticated, redirect to the dashboard
        if (Auth::guard('mechanic')->check()) {
            return redirect()->route('mechanic.dashboard');
        }

        return view('mechanic.auth.login');
    }

    // Handle mechanic login
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the mechanic
        if (Auth::guard('mechanic')->attempt($credentials)) {
            return redirect()->route('mechanic.dashboard');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Logout the mechanic
    public function destroy(Request $request)
    {
        Auth::guard('mechanic')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('mechanic.login');
    }
}
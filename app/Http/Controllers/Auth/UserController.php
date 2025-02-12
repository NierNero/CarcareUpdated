<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\Service;


class UserController extends Controller
{
    public function showMechananic(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $mechanics = Mechanic::where('shopname', 'LIKE', "%{$query}%")
                ->orWhere('location', 'LIKE', "%{$query}%") // Modify based on your database columns
                ->get();
        } else {
            $mechanics = Mechanic::all();
        }

        return view('dashboard', compact('mechanics'));
    }

    // 🔹 Function to show mechanic details
    public function viewMechanic($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        $services = Service::where('mechanic_id', $id)->get(); // Get only the mechanic's services
        if (!view()->exists('user.services')) {
            dd('The view does not exist!');
        }
        return view('user.services', compact('mechanic', 'services'));
    }
}

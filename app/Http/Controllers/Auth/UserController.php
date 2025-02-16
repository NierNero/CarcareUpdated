<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mechanic;
use App\Models\Service;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function showMechanic(Request $request)
    {
        $query = $request->input('q');

        if ($query) {
            $mechanics = Mechanic::where('shopname', 'LIKE', "%{$query}%")
                ->orWhere('location', 'LIKE', "%{$query}%")
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
        $services = Service::where('mechanic_id', $id)->get();

        return view('user.services', compact('mechanic', 'services'));
    }

    public function viewMechanics($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        $products = Product::where('mechanic_id', $id)->get(); // Fetch mechanic's products

        return view('user.product', compact('mechanic', 'products')); // Ensure 'products' is correctly passed
    }

    // public function viewCart($id)
    // {
    //     $users = User::findOrFail($id);
    //     $mechanic = Mechanic::where('user_id', $id)->get();
    //     $products = Product::where('mechanic_id', $id)->get(); // Fetch mechanic's products

    //     return view('user.cart', compact('mechanic', 'products')); // Ensure 'products' is correctly passed
    // }

    
}

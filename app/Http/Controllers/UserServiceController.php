<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Mechanic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserServiceController extends Controller
{
    // Show services related to a mechanic
    public function index()
    {
        $mechanics = Mechanic::all();
        $services = Service::all();

        return view('user.services', compact('mechanics', 'services'));
    }

    // Show a specific service
    public function show($id)
    {
        $service = Service::findOrFail($id);

        // Check if the service belongs to the logged-in mechanic
        if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('mechanic.view', compact('service'));
    }

    // Show details of a mechanic
    public function viewMechanic($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        return view('mechanic.view', compact('mechanic'));
    }
}

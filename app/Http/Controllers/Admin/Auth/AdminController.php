<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mechanic;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function showUsers()
    {
        $users = User::all();
        $mechanics = Mechanic::all();

        return view('admin.dashboard', compact('users', 'mechanics'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
        }

        $mechanic = Mechanic::find($id);
        if ($mechanic) {
            if ($mechanic->image) {
                $imagePath = public_path('upload/mechanic/' . $mechanic->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $mechanic->delete();
            return redirect()->route('admin.dashboard')->with('success', 'Mechanic deleted successfully.');
        }

        return redirect()->route('admin.dashboard')->with('error', 'User or Mechanic not found.');
    }

    // 🔹 Function to show user details
    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.view-user', compact('user'));
    }

    // 🔹 Function to show mechanic details
    public function viewMechanic($id)
    {
        $mechanic = Mechanic::findOrFail($id);
        return view('admin.view-mechanic', compact('mechanic'));
    }
}

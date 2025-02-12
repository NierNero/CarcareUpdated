<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;



class ServiceController extends Controller
{
    public function index()
{
    $mechanic_id = Auth::guard('mechanic')->id();
    $services = Service::where('mechanic_id', $mechanic_id)->get();
    
    return view('mechanic.service.index', compact('services'));
}

    public function shwservice(Request $request)
    {
        $query = Service::where('mechanic_id', Auth::guard('mechanic')->id());

    // Search functionality
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // Filter functionality
    if ($request->has('filter') && $request->filter != '') {
        $query->orderBy($request->filter);
    }

    $services = $query->get();
    return view('mechanic.dashboard', compact('services'));
    }

   public function add()
   {
        return view('mechanic.service.add');
    }

    public function storage(Request $request)
    {
        $field = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $field['name'] = strip_tags($field['name']);
        $field['description'] = strip_tags($field['description']);
        $field['price'] = strip_tags($field['price']);
        $field['mechanic_id'] = Auth::guard('mechanic')->id();

        Service::create($field);

        return redirect()->route('mechanic.dashboard')->with('success', 'Service created successfully.');
    }

    public function shows(Service $service)
    {
        if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
                abort(403, 'Unauthorized action.');
        }
        return view('mechanic.service.show', compact('service'));
    }

    public function edit(Service $service)
    {
        if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
    }
        return view('mechanic.service.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {

        if ($service->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
    }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $service->update([
            'name' => strip_tags($request->input('name')),
            'description' => strip_tags($request->input('description')),
            'price' => strip_tags($request->input('price')),
        ]);

        return redirect()->route('mechanic.dashboard')->with('success', 'Service updated successfully.');
    }

    public function destroys(Service $service)
    {
        $service->delete();
        
        return redirect()->route('mechanic.dashboard')->with('success', 'Service deleted successfully.');
    }
    
}

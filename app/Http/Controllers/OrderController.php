<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function shworder()
    {
        $orders = Order::all();
        //return $services;
        return view('mechanic.order', compact('orders'));
    }

   

    public function storage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        Order::create($request->all());

        return redirect()->route('mechanic.order')->with('success', 'Service created successfully.');
    }

    public function shows(Order $order)
    {
        return view('mechanic.order.show', compact('order'));
    }

    
}

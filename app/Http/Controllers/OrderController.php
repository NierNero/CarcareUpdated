<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->Price;
        });

        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->Price,
            ]);
        }

        $user->carts()->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => $request->status]);
        return redirect()->route('orders.index')->with('success', 'Order status updated.');
    }

    public function show(Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('orders.index')->with('error', 'You are not authorized to view this order.');
        }

        // Load the order with its items and products
        $order->load('items.product');

        return view('orders.show', compact('order'));
    }

    public function pendingOrders()
    {
        $orders = auth()->user()->orders()->where('status', 'pending')->get();
        return view('user.pending', compact('orders'));
    }

    public function inTransitOrders()
    {
        $orders = auth()->user()->orders()->where('status', 'in_transit')->get();
        return view('user.in_transit', compact('orders'));
    }

    // Show denied orders for the user
    public function deniedOrders()
    {
        $orders = auth()->user()->orders()->where('status', 'denied')->get();
        return view('user.denied', compact('orders'));
    }

    // Show completed orders for the user
    public function completedOrders()
    {
        $orders = auth()->user()->orders()->where('status', 'completed')->get();
        return view('user.completed', compact('orders'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show the payment page
    public function index()
    {
        $user = auth()->user();
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate the total amount
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->Price;
        });

        // Store the cart data temporarily in the session
        session()->put('cart_data', [
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'cart_items' => $cartItems,
        ]);

        return view('payments.index', compact('totalAmount', 'cartItems'));
    }

    // Process the payment
    public function process(Request $request)
    {
        // Validate payment details
        $request->validate([
            'card_number' => 'required|string',
            'expiry_date' => 'required|string',
            'cvv' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Retrieve cart data from the session
        $cartData = session()->get('cart_data');

        // Create the order
        $order = Order::create([
            'user_id' => $cartData['user_id'],
            'total_amount' => $cartData['total_amount'],
            'status' => 'pending', // Set status to pending
            'payment_method' => $request->payment_method, // Store payment method
        ]);

        // Add cart items to the order
        foreach ($cartData['cart_items'] as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->Price,
            ]);
        }

        // Clear the cart
        Auth::user()->carts()->delete();

        // Clear the session data
        session()->forget('cart_data');

        // Redirect to the orders page with a success message
        return redirect()->route('orders.index')->with('success', 'Payment successful! Your order has been placed.');
    }
}
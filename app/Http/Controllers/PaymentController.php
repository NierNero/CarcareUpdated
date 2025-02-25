<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Show the payment page
    public function index(Request $request, $productId = null)
{
    $user = auth()->user();

    if ($productId) {
        // If a product is purchased directly via "Buy Now"
        $product = Product::findOrFail($productId);
        $cartItems = collect([
            (object)[
                'product_id' => $product->id,
                'product' => $product,
                'quantity' => 1, // Buy Now always sets quantity to 1
            ]
        ]);
        $totalAmount = $product->Price;
        $isBuyNow = true; // Flag to indicate Buy Now purchase
    } else {
        // If accessing the payment page via the cart
        $cartItems = $user->carts()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate the total amount
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->Price;
        });
        $isBuyNow = false; // Flag for normal cart checkout
    }

    // Store the cart data temporarily in the session
    session()->put('cart_data', [
        'user_id' => $user->id,
        'total_amount' => $totalAmount,
        'cart_items' => $cartItems,
        'isBuyNow' => $isBuyNow, // Track if it's a Buy Now order
    ]);

    return view('payments.index', compact('totalAmount', 'cartItems', 'isBuyNow'));
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

    if (!$cartData) {
        return redirect()->route('cart.index')->with('error', 'Cart session expired. Please try again.');
    }

    // Create the order
    $order = Order::create([
        'user_id' => $cartData['user_id'],
        'total_amount' => $cartData['total_amount'],
        'status' => 'pending',
        'payment_method' => $request->payment_method,
    ]);

    // Add cart items to the order
    foreach ($cartData['cart_items'] as $item) {
        $order->items()->create([
            'product_id' => $item->product_id,
            'quantity' => $item->quantity,
            'price' => $item->product->Price,
        ]);
    }

    // If this was a cart checkout, clear the cart
    if (!$cartData['isBuyNow']) {
        Auth::user()->carts()->delete();
    }

    // Clear the session data
    session()->forget('cart_data');

    return redirect()->route('orders.index')->with('success', 'Payment successful! Your order has been placed.');
}

}
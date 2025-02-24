<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->carts()->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function store(Request $request, Product $product)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ], [
            'quantity' => 0,
        ]);

        $cart->increment('quantity');

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function increment(Cart $cart)
{
    // Increase the quantity of the cart item
    $cart->increment('quantity');
    return redirect()->route('cart.index')->with('success', 'Product quantity increased.');
}

public function decrement(Cart $cart)
{
    // Only decrease the quantity if it's greater than 1, or optionally remove the item if quantity is 1
    if ($cart->quantity > 1) {
        $cart->decrement('quantity');
        return redirect()->route('cart.index')->with('success', 'Product quantity decreased.');
    } else {
        // Optionally, you can delete the cart item if the quantity drops to 0
        $cart->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }
}
}

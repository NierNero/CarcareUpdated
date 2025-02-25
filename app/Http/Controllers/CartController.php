<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function add(Request $request, $id)
    {
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to add items to the cart.');
        }

        // Retrieve product
        $product = Product::findOrFail($id);

        // Check if the product is already in the user's cart
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            // If the product exists in the cart, increase quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If not in cart, add new entry
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->Price
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
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
            'quantity' => 1,
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

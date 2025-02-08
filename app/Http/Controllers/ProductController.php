<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showprod()
    {
        // Retrieve products associated with the authenticated user only
        $products = Product::where('mechanic_id', auth()->id())->get(); 
        return view('mechanic.productdashboard', compact('products'));
    }

    public function created()
    {
        return view('mechanic.created');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        // Create the product and associate it with the authenticated user
        Product::create([
            'ProductName' => $request->ProductName,
            'Description' => $request->Description,
            'Price' => $request->Price,
            'Inventory' => $request->Inventory,
            'mechanic_id' => auth()->id(), // Associate with the authenticated user
        ]);

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        // Ensure that the product belongs to the authenticated user
        if ($product->mechanic_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('mechanic.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Ensure that the product belongs to the authenticated user
        if ($product->mechanic_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('mechanic.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate the incoming request data
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        // Ensure that the product belongs to the authenticated user
        if ($product->mechanic_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the product
        $product->update($request->only('ProductName', 'Description', 'Price', 'Inventory'));

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Ensure that the product belongs to the authenticated user
        if ($product->mechanic_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the product
        $product->delete();

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product deleted successfully.');
    }
}

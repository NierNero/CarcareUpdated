<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function showprod()
    {
        $products = Product::all(); // Fetch all products
        return view('mechanic.productdashboard', compact('products'));
    }

    public function create()
    {
        return view('mechanic.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        Product::create($request->all());

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('mechanic.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('mechanic.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        $product->update($request->all());

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('mechanic.productdashboard')->with('success', 'Product deleted successfully.');
    }
}

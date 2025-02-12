<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showprod()
    {
        // Retrieve products associated with the authenticated mechanic
        $products = Product::where('mechanic_id', Auth::guard('mechanic')->id())->get();
        return view('mechanic.productdashboard', compact('products'));
    }

    public function created()
    {
        return view('mechanic.created');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $field = $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        // Sanitize input
        $field['ProductName'] = strip_tags($field['ProductName']);
        $field['Description'] = strip_tags($field['Description']);
        $field['Price'] = strip_tags($field['Price']);
        $field['Inventory'] = strip_tags($field['Inventory']);
        $field['mechanic_id'] = Auth::guard('mechanic')->id();

        // Create the product
        Product::create($field);

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('mechanic.product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('mechanic.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate input data
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price' => 'required|numeric',
            'Inventory' => 'required|integer',
        ]);

        // Sanitize input
        $product->update([
            'ProductName' => strip_tags($request->input('ProductName')),
            'Description' => strip_tags($request->input('Description')),
            'Price' => strip_tags($request->input('Price')),
            'Inventory' => strip_tags($request->input('Inventory')),
        ]);

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Ensure that the product belongs to the authenticated mechanic
        if ($product->mechanic_id !== Auth::guard('mechanic')->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the product
        $product->delete();

        return redirect()->route('mechanic.productdashboard')->with('success', 'Product deleted successfully.');
    }
}

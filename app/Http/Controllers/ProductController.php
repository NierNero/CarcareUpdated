<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Mechanic;
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
            'Price'       => 'required|numeric',
            'Inventory'   => 'required|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'color'       => 'required|string|max:255',
            'width'       => 'required|string|max:255',
            'weight'      => 'required|string|max:255',
            'height'      => 'required|string|max:255',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
            $imagePath = $file_name; // Use the new file name
        }

        // Create the product
        Product::create([
            "ProductName"  => $request->ProductName,
            "Description"  => $request->Description,
            "Price"        => $request->Price,
            "Inventory"    => $request->Inventory,
            "color"        => $request->color,
            "width"        => $request->width,
            "weight"       => $request->weight,
            "height"       => $request->height,
            "image"        => $imagePath, // This will now be the proper file name
            "mechanic_id"  => Auth::guard('mechanic')->id(),
        ]);

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

        // Validate input data including new image if provided
        $request->validate([
            'ProductName' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Price'       => 'required|numeric',
            'Inventory'   => 'required|integer',
            'color'       => 'required|string|max:255',
            'width'       => 'required|string|max:255',
            'weight'      => 'required|string|max:255',
            'height'      => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Build data array for update
        $data = [
            'ProductName' => strip_tags($request->input('ProductName')),
            'Description' => strip_tags($request->input('Description')),
            'Price'       => strip_tags($request->input('Price')),
            'Inventory'   => strip_tags($request->input('Inventory')),
            'color'       => $request->color,
            'width'       => $request->width,
            'weight'      => $request->weight,
            'height'      => $request->height,
        ];

        // Check if a new image file is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload'), $file_name);
            $data['image'] = $file_name;
        }

        // Update the product with new data
        $product->update($data);

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
    
    // If you need a public view for the product (e.g., for customers)
    public function shows($id) {
        $product = Product::findOrFail($id);

        $mechanic = Mechanic::where('id', $product->mechanic_id)->first();

        return view('product-view', compact('mechanic','product'));
    }

    // In your Controller
// In your Controller
public function showed($id) {
    // Assume you have a Mechanic model and you are fetching the mechanic by ID
    $mechanic = Mechanic::findOrFail($id); // Fetch the mechanic or throw a 404 if not found

    return view('user.product', compact('mechanic'));
}
    
}

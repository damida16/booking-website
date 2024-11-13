<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Retrieve all products
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // Show form to create a new product
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate and store a new product
        $request->validate([
            'nama' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:products',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle file upload if present
        $fotoPath = $request->file('foto') ? $request->file('foto')->store('photos', 'public') : null;

        Product::create([
            'nama' => $request->nama,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        // Show details of a specific product
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // Show form to edit a product
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate and update the product
        $request->validate([
            'nama' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:products,serial_number,' . $product->id,
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('photos', 'public');
            $product->foto = $fotoPath;
        }

        $product->update([
            'nama' => $request->nama,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

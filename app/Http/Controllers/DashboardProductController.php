<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form to create a new product
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store a new product
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:products',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle file upload if present
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            // Store the profile picture and get the path
            $path = $request->file('foto')->store('foto', 'public');
            $fotoPath = $path;
        }

        Product::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'model' => $request->model,
            'serial_number' => $request->serial_number,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the user by their ID
        $product = Product::findOrFail($id);

        // Pass the user details to the view
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // Validate and update the product
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:products,serial_number,' . $product->id,
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle file upload if present
        if ($request->hasFile('foto')) {
            // Store the profile picture and get the path
            $path = $request->file('foto')->store('foto', 'public');

            if ($product->foto) {
                // Delete the existing profile picture file from the storage
                Storage::disk('public')->delete($product->foto);
            }

            // Save the path of the profile picture in the database
            $product->foto = $path;
        }

        $product->save();

        // Redirect or return a response (customize as needed)
        return redirect()->route('dashboard.products.index')->with('success', 'Products updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Find the user by ID

        if ($product->foto) {
            // Delete the existing profile picture file from the storage
            Storage::disk('public')->delete($product->foto);
        }

        $product->delete(); // Delete the user

        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;


class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('cart.index', compact('carts'));

    }
    public function addToCart(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',

        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Check if the product is available
        if ($product->status !== 'available') {
            return response()->json([
                'message' => 'Product is not available for booking.',
            ], 400);
        }

        // Check if the product is already in the user's cart
        $existingCartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCartItem) {
            // Update the quantity if the product is already in the cart

            $existingCartItem->save();

            return response()->json([
                'message' => 'Cart updated successfully.',
                'cart_item' => $existingCartItem,
            ]);
        }

        // Create a new cart item
        $cartItem = Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,

        ]);

        return redirect()->route('cart')->with('success', 'Product added successfully.');

        // return response()->json([
        //     'message' => 'Product added to cart successfully.',
        //     'cart_item' => $cartItem,
        // ]);
    }
}

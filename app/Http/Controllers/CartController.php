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
        if ($product->isAvailable == false) {
            return redirect()
                ->back() // Return to the previous page (current route)
                ->with('error', 'Product is not available for book') // Pass validation errors
                ->withInput();
        }

        // Check if the product is already in the user's cart
        $existingCartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if (!$existingCartItem) {

            // $existingCartItem->save();

            // return response()->json([
            //     'message' => 'Cart updated successfully.',
            //     'cart_item' => $existingCartItem,
            // ]);
            $cartItem = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ]);
        }

        // Create a new cart item

        return redirect()->route('cart')->with('success', 'Product added successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('welcome', compact('products'));

    }

    public function detailProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('home.details', compact('product'));

    }
}

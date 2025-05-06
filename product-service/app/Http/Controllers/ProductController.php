<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Add this line

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all();
    return view('welcome', compact('products'));
}

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }
}

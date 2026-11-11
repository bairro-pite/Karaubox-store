<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->get();
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $products = Product::where('name', 'LIKE', "%$query%")
                    ->orWhere('description', 'LIKE', "%$query%")
                    ->get();
        return view('products.index', compact('products'));
    }
}





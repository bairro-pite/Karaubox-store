<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $query = Product::query();
    
    if ($request->has('search') && $request->search != '') {
        $query->where('name', 'LIKE', "%{$request->search}%");
    }
    
    $products = $query->latest()->get();
    return view('home', compact('products'));
}
  public function kalsa()
    {
        $products = Product::where('category_id', 1)->get();
        return view('kalsa', compact('products'));
    }

    public function boxing()
    {
        $products = Product::where('category_id', 2)->get();
        return view('boxing', compact('products'));
    }

    public function equipamentu()
    {
        $products = Product::where('category_id', 3)->get();
        return view('equipamentu', compact('products'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminProductController extends Controller
{
    // Halaman Daftar Produk Admin
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Halaman Form Tambah Produk
    public function create()
    {
        return view('admin.products.create');
    }

    // Simpan Produk Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' =>'required|integer',
        ]);

        $data = $request->all();

        // Simpan Foto
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('products'), $name);
            $data['image'] = $name;
        }

        Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image' => $data['image'],
            'category_id' => $data['category_id'],
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Halaman Form Edit
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // Update Produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' =>'required|integer',
        ]);

        $data = $request->all();

        // Ganti Foto Baru
        if ($request->hasFile('image')) {
            // Hapus foto lama yang ada di public/products
            if ($product->image && File::exists(public_path('products/' . $product->image))) {
                File::delete(public_path('products/' . $product->image));
            }
            $file = $request->file('image');
            $name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('products'), $name);
            $data['image'] = $name;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate!');
    }

    // Hapus Produk
    public function destroy(Product $product)
    {
        // Hapus foto
        if ($product->image && File::exists(public_path('products/' . $product->image))) {
            File::delete(public_path('products/' . $product->image));
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}



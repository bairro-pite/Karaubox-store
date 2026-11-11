<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Nota;

class CartController extends Controller
{
    // Tampilkan Raga Orderan
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Tambah barang ke Raga Orderan
    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Susesu aumenta iha Raga');
    }

    // Hapus barang dari Raga Orderan
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        Session::put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
             return redirect()->route('cart.index')->with('error', 'Raga mamuk!');
        }
        return view('checkout.index', compact('cart'));
    }

public function proses(Request $request)
{
    $cart = Session::get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
    }

    // Hitung total
    $total = 0;
    foreach ($cart as $id => $item) {
        $total += $item['price'] * $item['quantity'];
        
        // Kurangi stok
        $product = \App\Models\Product::find($id);
        if ($product) {
            $product->stok = $product->stok - $item['quantity'];
            if ($product->stok < 0) $product->stok = 0;
            $product->save();
        }
    }

    // Simpan ke Database
    \App\Models\Nota::create([
        'nome'     => $request->nome,
        'telefone' => $request->telefone,
        'enderesu' => $request->enderesu,
        'nota'     => $request->nota,
        'metode'   => $request->metode,
        'total'    => $total,
        'produtu'  => json_encode($cart),
    ]);

    // Simpan ke sesi untuk tampilan Nota
    Session::put('dados_kliente', [
        'nome' => $request->nome,
        'telefone' => $request->telefone,
        'enderesu' => $request->enderesu,
        'nota' => $request->nota,
        'metode' => $request->metode,
    ]);
    Session::put('cart_sukses', $cart);
    Session::forget('cart');

    return redirect()->route('checkout.sukses');
}

    public function sukses()
{
    if (!Session::has('dados_kliente')) {
        return redirect()->route('home');
    }
    $cart = Session::get('cart_sukses', []);
    return view('checkout.sukses', compact('cart'));
}

public function listNota()
{
    $notas = Nota::latest()->get();
    return view('admin.notas', compact('notas'));
}

public function notifikasi()
{
    // Ambil nota yang belum dikonfirmasi saja
    $notifikasi = \App\Models\Nota::where('dikonfirmasi', false)
        ->latest()
        ->get();
    
    return view('admin.notifikasi', compact('notifikasi'));
}
public function konfirmasi($id)
{
    $nota = \App\Models\Nota::findOrFail($id);
    
    $produkList = json_decode($nota->produtu, true);
    
    if ($produkList && is_array($produkList)) {
        foreach ($produkList as $id => $item) {
            $product = \App\Models\Product::findOrFail($id);
            $product->stok = $product->stok - $item['quantity'];
            if ($product->stok < 0) $product->stok = 0;
            $product->save();
        }
    }
    
    $nota->dikonfirmasi = true;
    $nota->dibaca_admin = true;
    $nota->save();
    
    return redirect()->route('admin.notifikasi')->with('success','✅ Transasaun konfirmadu ho Susesu!');
}

}

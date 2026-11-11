<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminProductController; // ✅ TAMBAH INI

// Halaman yang BISA Dilihat Tanpa Login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ropa-kalsa', [HomeController::class, 'kalsa'])->name('ropa.kalsa');
Route::get('/ropa-boxing', [HomeController::class, 'boxing'])->name('ropa.boxing');
Route::get('/equipamentu-boxing', [HomeController::class, 'equipamentu'])->name('equipamentu.boxing');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// 🔒 HALAMAN HARUS LOGIN — Termasuk Admin
Route::middleware('auth')->group(function () {
    
    // Keranjang & Checkout
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/proses', [CartController::class,'proses'])->name('checkout.proses');
    Route::get('/checkout/sukses', [CartController::class, 'sukses'])->name('checkout.sukses');

// HALAMAN ADMIN LIHAT SEMUA NOTA
Route::middleware('auth')->group(function () {
    Route::get('/admin/notifikasi', [CartController::class, 'notifikasi'])->name('admin.notifikasi');
    Route::get('/admin/nota/{id}/konfirmasi', [CartController::class, 'konfirmasi'])->name('admin.nota.konfirmasi');
    Route::get('/admin/notas', [CartController::class, 'listNota'])->name('admin.notas');
});


    // ✅ ADMIN PRODUK — TARUH DI SINI DI DALAM!
    Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/profile/edit', function(){
        return redirect()->route('home');
    })->name('profile.edit');
});

require __DIR__.'/auth.php';

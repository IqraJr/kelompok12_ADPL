<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Landing Page dengan daftar produk per kategori
Route::get('/', [ProductController::class, 'index'])->name('landing');

// Halaman daftar produk (jika berbeda dari landing)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Keranjang
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Proses Pemesanan
Route::get('/order/form', [OrderController::class, 'showOrderForm'])->name('order.form');
Route::post('/order/process', [OrderController::class, 'processOrder'])->name('order.process');
Route::get('/order/pay/{orderId}', [OrderController::class, 'redirectToWhatsApp'])->name('order.pay');

// Route untuk admin menambah produk
// Route::post('/products', [ProductController::class, 'store'])->name('products.store')->middleware('auth'); 

<?php

// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan keranjang beserta total harga
    public function index()
    {
        $cartItems = Cart::with('product')->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    // Menambahkan produk ke keranjang dan mengurangi stok produk
    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
        }

        // Cek apakah produk sudah ada di keranjang
        $cartItem = Cart::where('product_id', $product->id)->first();
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create(['product_id' => $product->id, 'quantity' => 1]);
        }

        // Kurangi stok produk
        $product->decrement('stock');

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Menghapus item dari keranjang dan mengembalikan stok
    public function destroy($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->product->increment('stock', $cartItem->quantity);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item dihapus dari keranjang!');
    }
}

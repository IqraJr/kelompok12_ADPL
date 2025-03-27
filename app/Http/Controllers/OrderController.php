<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan form pengisian data user
    public function showOrderForm()
    {
        return view('order.form');
    }

    // Proses data pesanan, simpan ke database, dan tampilkan detail pesanan
    public function processOrder(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required',
            'customer_phone' => 'required'
        ]);

        // Ambil data keranjang
        $cartItems = Cart::with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $orderDetails = $cartItems->map(function ($item) {
            return [
                'product'  => $item->product->name,
                'price'    => $item->product->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->product->price * $item->quantity,
            ];
        })->toArray();

        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Simpan data pesanan ke database
        $order = Order::create([
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'order_details'  => json_encode($orderDetails),
            'total_price'    => $totalPrice,
        ]);

        // Kosongkan keranjang setelah pesanan selesai
        Cart::truncate();

        // Tampilkan halaman detail pesanan
        return view('order.detail', compact('order', 'orderDetails'));
    }

    // Redirect ke WhatsApp untuk pembayaran
    public function redirectToWhatsApp($orderId)
    {
        $order = Order::findOrFail($orderId);
        // Contoh pesan ke WhatsApp
        $message = "Halo, saya ingin membayar pesanan dengan ID: {$order->id} dengan total Rp " . number_format($order->total_price, 0, ',', '.');
        $whatsappUrl = "https://wa.me/6287783351801?text=" . urlencode($message);
        return redirect()->away($whatsappUrl);
    }
}

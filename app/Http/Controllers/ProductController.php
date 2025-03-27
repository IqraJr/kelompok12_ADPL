<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan landing page beserta daftar produk per kategori
    public function index()
    {
        // Mengambil kategori beserta produk di masing-masing kategori
        $categories = Category::with('products')->get();
        return view('landing', compact('categories'));
    }

    // Method untuk menyimpan produk (misalnya admin menambahkan produk)
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
            $imageUrl = str_replace('public/', 'storage/', $imagePath);
        } else {
            $imageUrl = null;
        }

        Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'image'       => $imageUrl,
        ]);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
}

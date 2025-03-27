@extends('layouts.app')

@section('content')
    <h2>Daftar Produk</h2>
    @foreach($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <p>Rp. {{ number_format($product->price) }}</p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit">Tambahkan ke Keranjang</button>
            </form>
        </div>
    @endforeach
@endsection

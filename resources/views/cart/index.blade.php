@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <h2>Keranjang Belanja</h2>
    @if($cartItems->isEmpty())
        <p>Keranjang kosong.</p>
    @else
        <ul>
            @foreach($cartItems as $item)
                <li>
                    {{ $item->product->name }} x {{ $item->quantity }} 
                    = Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <h3>Total: Rp {{ number_format($totalPrice, 0, ',', '.') }}</h3>
        <a href="{{ route('order.form') }}"><button>Pesan Sekarang</button></a>
    @endif
@endsection

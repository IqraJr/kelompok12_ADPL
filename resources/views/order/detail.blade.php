@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <h2>Detail Pesanan</h2>
    <p>Nama: {{ $order->customer_name }}</p>
    <p>No. Telepon: {{ $order->customer_phone }}</p>
    <h3>Pesanan Anda:</h3>
    <ul>
        @foreach($orderDetails as $item)
            <li>
                {{ $item['product'] }} x {{ $item['quantity'] }} 
                = Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
            </li>
        @endforeach
    </ul>
    <h3>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
    <a href="{{ route('order.pay', $order->id) }}"><button>Bayar Sekarang</button></a>
@endsection

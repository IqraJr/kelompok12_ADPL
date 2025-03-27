@extends('layouts.app')

@section('title', 'Form Pemesanan')

@section('content')
    <h2>Isi Data Pemesanan</h2>
    <form action="{{ route('order.process') }}" method="POST">
        @csrf
        <label for="customer_name">Nama:</label>
        <input type="text" name="customer_name" required>
        
        <label for="customer_phone">No. Telepon:</label>
        <input type="text" name="customer_phone" required>
        
        <button type="submit">Lihat Detail Pesanan</button>
    </form>
@endsection

@extends('layouts.app')

@section('title', 'Landing Page Bengkel Mobil')

@section('content')


        <!-- Bagian Bengkel dengan efek scroll horizontal -->
        <section id="bengkel">
            <div class="carousel-container">
                <button id="prevBtn" class="nav-button">&#10094;</button>
                <div class="carousel">
                    <div class="carousel-track">
                        <img src="{{ asset('images/bengkel1.jpg') }}" alt="Bengkel 1">
                        <img src="{{ asset('images/bengkel1.jpg') }}" alt="Bengkel 2">
                        <img src="{{ asset('images/bengkel1.jpg') }}" alt="Bengkel 3">
                    </div>
                </div>
                <button id="nextBtn" class="nav-button">&#10095;</button>
            </div>
        </section>

    <!-- Bagian Produk -->


@endsection

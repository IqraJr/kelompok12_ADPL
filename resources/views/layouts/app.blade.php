<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bengkel Mobil')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/carousel.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    

</head>
<body>
<header>
        <nav>
            <a href="{{ route('landing') }}">Beranda</a>
            <a href="#about">Tentang Kami</a>
            <a href="#branches">Cabang Kami</a>
            <a href="{{ route('cart.index') }}">Keranjang</a>
        </nav>
</header>

    <div class="container">
        <section id="home">
            @yield('content')
        </section>

        @if (Request::route()->getName() === 'landing')  
        <!-- Hanya tampil di halaman landing -->
        <section id="about" class="about-container">
            <div class="about-text">
                <h2>Tentang Kami</h2>
                <p>Kami adalah bengkel spesialis perawatan dan perbaikan mobil terbaik...</p>
            </div>
            <div class="about-image">
                <img src="{{ asset('images/bengkel1.jpg') }}" alt="Bengkel Kami">
            </div>
        </section>

        <section id="products">
        <h2>Produk Kami</h2>

        <!-- Daftar Kategori -->
        <div class="category-list">
        @foreach($categories as $category)
            <button class="category-btn" data-category="{{ $category->id }}">
                <i class="{{ $category->icon }}"></i> <!-- Ikon diambil dari database -->
                {{ $category->name }}
            </button>
        @endforeach
    </div>

        <!-- Daftar Produk (Disembunyikan Awal) -->
        @foreach($categories as $category)
            <div class="product-list" id="category-{{ $category->id }}" style="display: none;">
                @foreach($category->products as $product)
                    <div class="product-item">
                        @if($product->image)
                           <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-img">
                        @endif
                        <h4>{{ $product->name }}</h4>
                        <p>Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <p>Stok: {{ $product->stock }}</p>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="button">Tambah ke Keranjang</button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endforeach
    </section>



            <section id="branches">
                <h2>Cabang Kami</h2>
                <p>Kunjungi cabang kami di lokasi berikut:</p>
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?..." width="100%" height="300"></iframe>
                    <iframe src="https://www.google.com/maps/embed?..." width="100%" height="300"></iframe>
                    <iframe src="https://www.google.com/maps/embed?..." width="100%" height="300"></iframe>
                </div>
            </section>
        @endif
    </div>
</body>
</html>

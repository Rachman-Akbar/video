@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Home')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section py-5 mb-5 position-relative overflow-hidden" style="background-color: var(--primary-color);">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <span class="badge mb-3" style="background-color: var(--accent-color);">Restoran Terbaik</span>
                    <h1 class="display-4 fw-bold mb-4" style="color: var(--dark-color);">Ayam Goreng Jos</h1>
                    <p class="lead mb-4" style="color: var(--dark-color);">Nikmati kelezatan ayam goreng dengan berbagai pilihan sambal yang menggugah selera. Dibuat dengan bahan berkualitas dan bumbu rahasia warisan keluarga.</p>
                    <div class="d-flex gap-3">
                        <a href="#menu" class="btn btn-lg" style="background-color: var(--dark-color); color: var(--primary-color);">
                            <i class="bi bi-arrow-right-circle me-2"></i>Lihat Menu
                        </a>
                        <a href="{{ route('kontak') }}" class="btn btn-lg btn-outline-dark">
                            <i class="bi bi-telephone me-2"></i>Hubungi Kami
                        </a>
                    </div>
                    <div class="mt-4 d-flex gap-4">
                        <div>
                            <h3 class="fw-bold mb-0" style="color: var(--dark-color);">4.8</h3>
                            <p class="text-muted mb-0">Rating</p>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0" style="color: var(--dark-color);">1000+</h3>
                            <p class="text-muted mb-0">Pelanggan</p>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0" style="color: var(--dark-color);">15+</h3>
                            <p class="text-muted mb-0">Menu</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="{{ asset('images/ayam goreng.jpg') }}" alt="Ayam Goreng Jos" class="img-fluid rounded-3 shadow-lg">
                        <div class="position-absolute bottom-0 end-0 p-3 bg-white rounded-3 shadow-lg m-3">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-clock-fill fs-4" style="color: var(--accent-color);"></i>
                                <div>
                                    <p class="mb-0 fw-bold">Buka Setiap Hari</p>
                                    <p class="mb-0 text-muted">10:00 - 22:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-absolute top-50 end-0 translate-middle-y d-none d-lg-block" style="z-index: 1; opacity: 0.1;">
            <i class="bi bi-egg-fried display-1" style="font-size: 20rem; color: var(--dark-color);"></i>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Menu Section -->
    <div class="container" id="menu">
        <div class="text-center mb-5">
            <span class="badge mb-2" style="background-color: var(--accent-color);">Menu Spesial</span>
            <h2 class="fw-bold">Menu Pilihan Kami</h2>
            <p class="text-muted">Pilihan menu terbaik dengan cita rasa autentik</p>
        </div>
        <div class="row g-4">
            @foreach($menus as $menu)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition rounded-4 overflow-hidden" style="background-color: white;">
                        <div class="position-relative">
                            <img src="{{ asset($menu->gambar) }}" class="card-img-top" alt="{{ $menu->nama }}" style="height: 250px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge rounded-pill" style="background-color: var(--accent-color);">{{ $menu->kategori }}</span>
                            </div>
                            @if(!$menu->tersedia)
                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0,0,0,0.7);">
                                    <div class="text-center">
                                        <i class="bi bi-x-circle display-6 text-white mb-2"></i>
                                        <h5 class="text-white mb-0">Habis</h5>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold mb-2">{{ $menu->nama }}</h5>
                            <p class="card-text text-muted mb-3">{{ $menu->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="mb-0" style="color: var(--dark-color);">Rp{{ number_format($menu->harga, 0, ',', '.') }}</h4>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-star-fill me-1" style="color: var(--accent-color);"></i>
                                    <span>4.5</span>
                                </div>
                            </div> 
                            @if($menu->tersedia)
                                <div class="d-flex gap-2">
                                    <form action="{{ route('checkout.direct') }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn w-100" style="background-color: var(--dark-color); color: white;">
                                            <i class="bi bi-lightning-charge-fill me-2"></i>Pesan Sekarang
                                        </button>
                                    </form>
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <button type="submit" class="btn btn-lg" style="border-color: var(--accent-color); color: var(--accent-color);" title="Tambah ke Keranjang">
                                            <i class="bi bi-cart-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="bi bi-x-circle me-2"></i>Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Features Section -->
    <div class="container my-5 py-5">
        <div class="text-center mb-5">
            <span class="badge mb-2" style="background-color: var(--accent-color);">Kenapa Memilih Kami?</span>
            <h2 class="fw-bold">Keunggulan Kami</h2>
            <p class="text-muted">Kami berkomitmen memberikan pengalaman kuliner terbaik untuk Anda</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 hover-shadow transition">
                    <div class="rounded-circle bg-light p-3 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-shield-check fs-2" style="color: var(--accent-color);"></i>
                    </div>
                    <h5 class="fw-bold">Kualitas Terjamin</h5>
                    <p class="text-muted">Bahan berkualitas dan proses memasak yang higienis</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 hover-shadow transition">
                    <div class="rounded-circle bg-light p-3 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-lightning fs-2" style="color: var(--accent-color);"></i>
                    </div>
                    <h5 class="fw-bold">Pengiriman Cepat</h5>
                    <p class="text-muted">Layanan pengiriman cepat ke lokasi Anda</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 hover-shadow transition">
                    <div class="rounded-circle bg-light p-3 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-wallet2 fs-2" style="color: var(--accent-color);"></i>
                    </div>
                    <h5 class="fw-bold">Harga Terjangkau</h5>
                    <p class="text-muted">Nikmati menu berkualitas dengan harga bersahabat</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 text-center p-4 hover-shadow transition">
                    <div class="rounded-circle bg-light p-3 d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
                        <i class="bi bi-headset fs-2" style="color: var(--accent-color);"></i>
                    </div>
                    <h5 class="fw-bold">Layanan 24/7</h5>
                    <p class="text-muted">Dukungan pelanggan siap membantu Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-5" style="background-color: var(--primary-color);">
        <div class="container my-5">
            <div class="text-center mb-5">
                <span class="badge mb-2" style="background-color: var(--accent-color);">Testimoni</span>
                <h2 class="fw-bold">Apa Kata Mereka?</h2>
                <p class="text-muted">Pengalaman pelanggan yang telah menikmati hidangan kami</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 p-4 h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-person-circle fs-2" style="color: var(--accent-color);"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Ahmad Rizki</h5>
                                <p class="text-muted mb-0">Food Blogger</p>
                            </div>
                        </div>
                        <p class="mb-0">"Ayam gorengnya crispy di luar tapi tetap juicy di dalam. Sambalnya juga mantap, pedasnya pas dan bervariasi. Recommended banget!"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4 h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-person-circle fs-2" style="color: var(--accent-color);"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Siti Aminah</h5>
                                <p class="text-muted mb-0">Pelanggan Setia</p>
                            </div>
                        </div>
                        <p class="mb-0">"Sudah langganan di sini sejak lama. Rasanya konsisten enak, pelayanannya ramah, dan harganya worth it banget!"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 p-4 h-100">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                    <i class="bi bi-person-circle fs-2" style="color: var(--accent-color);"></i>
                                </div>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Budi Santoso</h5>
                                <p class="text-muted mb-0">Food Enthusiast</p>
                            </div>
                        </div>
                        <p class="mb-0">"Menu-menunya bervariasi dan semuanya enak. Porsinya juga pas, cocok untuk makan siang atau malam. Pasti bakal balik lagi!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Checkout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Page Title -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: var(--dark-color);">Checkout</h2>
                    <p class="text-muted mb-0">Lengkapi informasi pengiriman untuk menyelesaikan pesanan</p>
                </div>
                <a href="{{ route('cart') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Keranjang
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('cart'))
                <div class="row g-4">
                    <!-- Shipping Details Form -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4" style="color: var(--dark-color);">Detail Pengiriman</h5>
                                <form action="{{ route('checkout.process') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
                                                <label for="nama">Nama Lengkap</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="Nomor Telepon" required>
                                                <label for="telepon">Nomor Telepon</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap" style="height: 100px" required></textarea>
                                                <label for="alamat">Alamat Lengkap</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" id="catatan" name="catatan" placeholder="Catatan (opsional)" style="height: 80px"></textarea>
                                                <label for="catatan">Catatan (opsional)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delivery Info -->
                                    <div class="mt-4 p-3 rounded-3" style="background-color: var(--primary-color);">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="bi bi-truck fs-3" style="color: var(--accent-color);"></i>
                                            <div>
                                                <h6 class="mb-1">Informasi Pengiriman</h6>
                                                <p class="mb-0 text-muted small">Pesanan akan dikirim dalam waktu 30-45 menit setelah pembayaran</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-lg w-100" style="background-color: var(--dark-color); color: white;">
                                            <i class="bi bi-bag-check me-2"></i>Proses Pesanan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold mb-4" style="color: var(--dark-color);">Ringkasan Pesanan</h5>
                                @php $total = 0 @endphp
                                <div class="mb-4">
                                    @foreach(session('cart') as $id => $details)
                                        @php $total += $details['harga'] * $details['quantity'] @endphp
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h6 class="mb-1">{{ $details['nama'] }}</h6>
                                                <span class="badge mb-2" style="background-color: var(--accent-color);">{{ $details['kategori'] }}</span>
                                                <div class="text-muted small">{{ $details['quantity'] }} x Rp {{ number_format($details['harga'], 0, ',', '.') }}</div>
                                            </div>
                                            <span class="fw-bold" style="color: var(--accent-color);">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="p-3 rounded-3 mb-3" style="background-color: var(--primary-color);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Subtotal</span>
                                        <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="text-muted">Biaya Pengiriman</span>
                                        <span class="fw-bold text-success">Gratis</span>
                                    </div>
                                    <hr class="my-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold">Total</span>
                                        <span class="fw-bold fs-5" style="color: var(--dark-color);">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Payment Methods -->
                                <div class="d-flex align-items-center gap-2 mt-3">
                                    <i class="bi bi-shield-check text-success"></i>
                                    <small class="text-muted">Pembayaran aman dengan:</small>
                                </div>
                                <div class="d-flex gap-2 mt-2">
                                    <span class="badge bg-light text-dark border">COD</span>
                                    <span class="badge bg-light text-dark border">Transfer Bank</span>
                                    <span class="badge bg-light text-dark border">E-Wallet</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card border-0 shadow-sm rounded-4 text-center p-5">
                    <div class="py-5">
                        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                            <i class="bi bi-cart-x display-5" style="color: var(--accent-color);"></i>
                        </div>
                        <h3 class="fw-bold mb-2" style="color: var(--dark-color);">Keranjang Belanja Kosong</h3>
                        <p class="text-muted mb-4">Anda belum menambahkan menu apapun ke keranjang.</p>
                        <a href="{{ route('home') }}" class="btn btn-lg" style="background-color: var(--accent-color); color: white;">
                            <i class="bi bi-arrow-right-circle me-2"></i>Mulai Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
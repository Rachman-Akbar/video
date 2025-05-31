@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Keranjang Belanja')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Page Title -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="fw-bold mb-1" style="color: var(--dark-color);">Keranjang Belanja</h2>
                    <p class="text-muted mb-0">Periksa kembali pesanan Anda sebelum checkout</p>
                </div>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Menu
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @php $total = 0 @endphp

            @if(session('cart'))
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background-color: var(--primary-color);">
                                    <tr>
                                        <th class="px-4 py-3">Menu</th>
                                        <th class="px-4 py-3">Harga</th>
                                        <th class="px-4 py-3" width="150">Jumlah</th>
                                        <th class="px-4 py-3">Subtotal</th>
                                        <th class="px-4 py-3" width="80">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(session('cart') as $id => $details)
                                        @php $total += $details['harga'] * $details['quantity'] @endphp
                                        <tr>
                                            <td class="px-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($details['gambar']) }}" alt="{{ $details['nama'] }}" 
                                                        class="rounded-3 me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-1">{{ $details['nama'] }}</h6>
                                                        <span class="badge" style="background-color: var(--accent-color);">{{ $details['kategori'] }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 fw-bold" style="color: var(--dark-color);">Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                                            <td class="px-4">
                                                <form action="{{ route('cart.update') }}" method="POST" class="d-flex gap-2">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" 
                                                        class="form-control form-control-sm text-center" style="width: 70px;">
                                                    <button type="submit" class="btn btn-sm" style="background-color: var(--accent-color); color: white;">
                                                        <i class="bi bi-arrow-clockwise"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-4 fw-bold" style="color: var(--accent-color);">Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}</td>
                                            <td class="px-4">
                                                <form action="{{ route('cart.remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus item">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Cart Summary -->
                        <div class="p-4" style="background-color: var(--primary-color);">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="bi bi-shield-check fs-1" style="color: var(--accent-color);"></i>
                                        <div>
                                            <h6 class="mb-1">Jaminan Kualitas</h6>
                                            <p class="mb-0 text-muted small">Kami menjamin kualitas dan kehigienisan produk kami</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end mt-4 mt-md-0">
                                        <p class="mb-1 text-muted">Total Pembayaran:</p>
                                        <h3 class="fw-bold mb-3" style="color: var(--dark-color);">Rp {{ number_format($total, 0, ',', '.') }}</h3>
                                        <a href="{{ route('checkout') }}" class="btn btn-lg w-100 w-md-auto" style="background-color: var(--dark-color); color: white;">
                                            Lanjut ke Pembayaran <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
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

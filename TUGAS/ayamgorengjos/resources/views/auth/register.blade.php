@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Register')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <!-- Logo and Welcome Text -->
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold mb-2" style="color: var(--dark-color);">Daftar Akun Baru</h1>
                <p class="text-muted">Bergabunglah dengan kami untuk menikmati menu spesial</p>
            </div>

            <!-- Register Card -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name Input -->
                        <div class="form-floating mb-3">
                            <input id="name" type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" 
                                placeholder="Nama Lengkap"
                                required autocomplete="name" autofocus>
                            <label for="name">Nama Lengkap</label>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email Input -->
                        <div class="form-floating mb-3">
                            <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" 
                                placeholder="nama@email.com"
                                required autocomplete="email">
                            <label for="email">Alamat Email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="form-floating mb-3">
                            <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                placeholder="Password"
                                required autocomplete="new-password">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="form-floating mb-4">
                            <input id="password-confirm" type="password" 
                                class="form-control" 
                                name="password_confirmation" 
                                placeholder="Konfirmasi Password"
                                required autocomplete="new-password">
                            <label for="password-confirm">Konfirmasi Password</label>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn btn-lg w-100 mb-3" style="background-color: var(--dark-color); color: white;">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="mb-0">Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-decoration-none" style="color: var(--accent-color);">Masuk Sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center mt-4">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-shield-check text-success"></i>
                    <small class="text-muted">Data Anda aman bersama kami</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
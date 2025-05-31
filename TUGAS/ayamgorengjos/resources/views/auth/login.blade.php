@extends('layouts.app')

@section('title', 'Ayam Goreng Jos - Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <!-- Logo and Welcome Text -->
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold mb-2" style="color: var(--dark-color);">Selamat Datang Kembali</h1>
                <p class="text-muted">Silakan login untuk melanjutkan</p>
            </div>

            <!-- Login Card -->
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-floating mb-3">
                            <input id="email" type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" 
                                placeholder="nama@email.com"
                                required autocomplete="email" autofocus>
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
                                required autocomplete="current-password">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none" style="color: var(--accent-color);" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-lg w-100 mb-3" style="background-color: var(--dark-color); color: white;">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </button>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0">Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-decoration-none" style="color: var(--accent-color);">Daftar Sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center mt-4">
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-shield-check text-success"></i>
                    <small class="text-muted">Login aman dengan SSL encryption</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
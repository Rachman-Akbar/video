<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            overflow-x: hidden;
        }
        
        .hover-effect {
            transition: all 0.3s ease;
            display: inline-block;
            width: auto;
        }
        .hover-effect:hover {
            background-color: #00ff004d;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
                
        footer {
            background-color: #000000 !important;
            color: #ffffff;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.2);
            padding: 2rem 0;
        }
    </style>
</head>
<body>
    @php
        $hideLayout = request()->is('login') || request()->is('register');
    @endphp
    @if(!$hideLayout)
    <header class="container-fluid px-0" style="position: sticky; top: 0; z-index: 1030; overflow-y: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background-color: white; transition: all 0.3s ease;">
        <nav class="navbar navbar-expand-lg py-2">
            <div class="container-fluid align-items-center">
                <a href="/" class="d-flex align-items-center">
                    <img style="width: 180px; transition: transform 0.3s ease;" 
                         src="{{ asset('gambar/logo.jpeg') }}" 
                         alt="Logo"
                         class="hover-scale"
                         onmouseover="this.style.transform='scale(1.05)'"
                         onmouseout="this.style.transform='scale(1)'">
                    </a>
                <ul class="navbar-nav gap-4" style="margin-left: auto;">

                    @if (session()->has('cart'))
                        <li class="nav-item position-relative">
                            <a href="{{ url('cart') }}" class="nav-link px-3 py-2 rounded" style="transition: all 0.3s ease;">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    @php
                                        $count = count(session('cart'));
                                        echo $count;
                                    @endphp
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="#" class="nav-link px-3 py-2 rounded" style="transition: all 0.3s ease;">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                    @endif
                        
                        @if (session()->missing('idpelanggan'))
                            <li class="nav-item gap-2 mr-3">
                            <a href="{{ url('register') }}" class="btn btn-success px-4 py-2 rounded" style="transition: all 0.3s ease;">Register</a>
                            <a href="{{ url('login') }}" class="btn btn-outline-success px-4 py-2 rounded" style="transition: all 0.3s ease;">Login</a>
                        </li>
                    @endif
                    
                    @if (session()->has('idpelanggan'))
                        <li class="nav-item">
                            <span class="nav-link px-3 py-2 rounded" style="transition: all 0.3s ease;">{{ session('idpelanggan')['email']}}</span>
                        </li>   
                        <li class="nav-item">
                            <a href="{{ url('logout') }}" class="btn btn-outline-danger px-4 py-2 rounded" id="logoutBtn" style="transition: all 0.3s ease;">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
            </nav>
        </header>
        
    <main class="row mt-4">
        <div class="col-2">
            <div class="nav flex-column">
                <h3 class="px-3 py-2" style="color: #000000;">
                    <i class="fas fa-list me-2"></i>Kategori Menu
                </h3>
                <ul class="nav flex-column" style="padding-left: 1.5rem;">
                    @foreach ($kategoris as $kategori)
                        <li class="nav-item ">
                            <a href="{{ url('show/'.$kategori->idkategori) }}" 
                               class="text-dark nav-link d-flex align-items-center px-3 py-2 hover-effect" 
                               style="border-radius: 8px; margin-bottom: 5px; transition: all 0.3s ease; color: #070707;">
                                <span>{{ $kategori->kategori }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-10">
            @yield('content')
        </div>
    </main>
    <footer class="mt-5 py-4">
        <div class="container">
            <div class="row justify-content-between g-4">
                <div class="col-md-4">
                    <h5>Tentang Kami</h5>
                    <p>Restoran SMK menyajikan makanan berkualitas dengan harga terjangkau untuk pelanggan kami.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kontak</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. SMK Revit No. 123</p>
                    <p><i class="fas fa-phone me-2"></i> (021) 12345678</p>
                    <p><i class="fas fa-envelope me-2"></i> info@smkrevit.com</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Jam Operasional</h5>
                    <p>Senin - Jumat: 10.00 - 22.00</p>
                    <p>Sabtu - Minggu: 09.00 - 23.00</p>
                    <div class="social-media mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center pt-3 border-top">
                <p>&copy; 2023 SMK Revit. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @else
    <div class="container mt-5">
        @yield('content')
    </div>
    @endif
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutBtn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('logout') }}";
            }
        });
    });
</script>
</body>
</html>
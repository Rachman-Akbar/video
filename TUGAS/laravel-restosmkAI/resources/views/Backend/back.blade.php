<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .list-group-item a {
            text-decoration: none;
            color: #495057;
            display: flex;
            align-items: center;
        }
        .list-group-item:hover a {
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid px-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark px-4 fixed-top" style="z-index: 1020; box-shadow: 0 4px 12px rgba(147, 155, 223, 0.521);">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="#" style="font-weight: 600;">
                    <i class="fas fa-user-shield me-2"></i>Admin Page
                </a>
                <div class="d-flex align-items-center">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                        <li class="nav-item">
                            <span class="nav-link text-white d-flex align-items-center">
                                <i class="fas fa-envelope me-2"></i>{{ Auth::user()->email }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-white d-flex align-items-center">
                                <i class="fas fa-user-tag me-2"></i>Level: {{ Auth::user()->level }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link logout-btn d-flex align-items-center" href="{{ url('admin/logout') }}" style="transition: all 0.3s ease;">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <style>
                .logout-btn:hover {
                    transform: scale(1.1);
                    color: #ff6b6b !important;
                }
            </style>
    </div>
        <div class="row g-0">
            <div class="col-md-2">
                <div class="sidebar" style="position: fixed; width: 16.666667%; height: 100vh; background: #0b2842; padding: 1rem; overflow-y: auto;">
                    <ul class="list-group" style="border: none;">
                        @if (Auth::user()->level == 'admin')
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/user') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-users me-2"></i> User
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->level == 'kasir')
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/order') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-cash-register me-2"></i> Order
                                </a>
                            </li>
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/orderdetail') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-receipt me-2"></i> Order Detail
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->level == 'manager')
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/kategori') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-tags me-2"></i> Kategori
                                </a>
                            </li>
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/menu') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-utensils me-2"></i> Menu
                                </a>
                            </li>
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/pelanggan') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-user-friends me-2"></i> Pelanggan
                                </a>
                            </li>
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/order') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-shopping-cart me-2"></i> Order
                                </a>
                            </li>
                            <li class="list-group-item mb-2" style="background: rgba(255,255,255,0.1); border-radius: 5px; transition: all 0.3s ease;">
                                <a href="{{ url('admin/orderdetail') }}" class="text-white d-flex align-items-center" style="text-decoration: none; transform: translateY(0); transition: all 0.3s ease;" onmouseover="this.parentElement.style.transform='translateY(-3px)'; this.parentElement.style.background='rgba(255,255,255,0.2)';" onmouseout="this.parentElement.style.transform='translateY(0)'; this.parentElement.style.background='rgba(255,255,255,0.1)';">
                                    <i class="fas fa-list-alt me-2"></i> Order Detail
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-md-10 p-3 mt-5" style="margin-left: 16.666667%;">
                @yield('admincontent')
            </div>
        </div>
        <footer class="bg-dark text-white py-4 text-center" style="position: fixed; bottom: 0; width: 100%; box-shadow: 0 4px 12px rgba(147, 155, 223, 0.521);">
            <p class="mb-0">© 2025 SMK Revit. All rights reserved.</p>
        </footer>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.logout-btn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('admin/logout') }}";
            }
        });
    });
</script>
</body>
</html>
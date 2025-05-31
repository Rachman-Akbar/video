<?php
session_start();

// Cek login admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin Toko</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1"><i class="fas fa-cogs"></i> Admin Panel</span>
    <a href="?f=dasbor&m=logout" class="btn btn-outline-light"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</nav>
<div class="d-flex">

<div class="bg-dark text-white p-4 shadow" style="width: 260px; min-height: 100vh; border-radius: 0 1rem 1rem 0;">
  <div class="d-flex align-items-center mb-4">
    <div class="bg-secondary rounded-circle d-flex justify-content-center align-items-center" style="width:48px; height:48px;">
      <i class="fas fa-user-shield fa-lg"></i>
    </div>
    <div class="ms-3">
      <h5 class="mb-0">Admin Panel</h5>
      <small class="text-muted">Administrator</small>
    </div>
  </div>
  <ul class="nav flex-column mt-3">
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=dashboard" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-home me-2"></i> Dashboard
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=kategori" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-list me-2"></i> Kategori
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=produk" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-box me-2"></i> Produk
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=user" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-users-cog me-2"></i> Users
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=order" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-shopping-bag me-2"></i> Orders
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=order_item" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-file-alt me-2"></i> Order Items
      </a>
    </li>
    <li class="nav-item mb-2">
      <a href="?f=dasbor&m=customers" class="nav-link text-white d-flex align-items-center">
        <i class="fas fa-user-friends me-2"></i> Customers
      </a>
    </li>
  </ul>
</div>

<?php 
    if (isset($_GET['f']) && isset($_GET['m'])) {
        $f = $_GET['f'];
        $m = $_GET['m'];
        
        // Blok akses ke halaman login/register jika sudah login
        if (isset($_SESSION['customer_id']) && ($m === 'login' || $m === 'register')) {
            header("Location: index.php");
            exit();
        }
        
        $file = $f.'/'.$m.'.php';
        if (file_exists($file)) {
            require_once $file;
        } else {
            require_once "dasbor/product.php";
        }
    } else {
        require_once "dasbor/dashboard.php";
    }
  ?>

</div> 
<footer class="bg-light text-center py-3">
  <div>&copy; <?= date('Y') ?> Admin Toko Online</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .nav-link.active, .nav-link:hover {
    background: rgba(255,255,255,0.1);
    border-radius: .5rem;
    color: #ffc107 !important;
    transition: background 0.2s, color 0.2s;
  }
</style>
</body>
</html>


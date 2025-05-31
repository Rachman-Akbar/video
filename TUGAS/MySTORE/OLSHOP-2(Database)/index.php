<?php
session_start();

// Koneksi database
$servername = "localhost";
$username = "root";
$password = ""; // sesuaikan
$dbname = "mystore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek jika aksi logout diminta
if (isset($_GET['f']) && $_GET['f'] === 'home' && isset($_GET['m']) && $_GET['m'] === 'logout') {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    .dropdown-toggle::after {
      display: none;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fas fa-store"></i> Toko Online</a>
    
    <div class="d-flex align-items-center">
      <div class="position-relative me-3">
        <a href="?f=home&m=cart" class="btn btn-outline-light position-relative">
          <i class="fas fa-shopping-cart"></i>
          <?php if (!empty($_SESSION['cart'])): ?>
            <span class="cart-badge badge bg-danger rounded-pill">
              <?= array_sum($_SESSION['cart']) ?>
            </span>
          <?php endif; ?>
        </a>
      </div>
      
      <?php if (isset($_SESSION['customer_id'])): ?>
        <div class="dropdown">
          <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle me-1"></i> <?= htmlspecialchars($_SESSION['customer_email']) ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="?f=home&m=order"><i class="fas fa-receipt me-2"></i>Pesanan</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="?f=home&m=logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
          </ul>
        </div>
      <?php else: ?>
        <a href="?f=home&m=login" class="btn btn-outline-light me-2">
          <i class="fas fa-sign-in-alt"></i> Login
        </a>
        <a href="?f=home&m=register" class="btn btn-outline-light">
          <i class="fas fa-user-plus"></i> Register
        </a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container my-4">
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
            require_once "home/product.php";
        }
    } else {
        require_once "home/product.php";
    }
  ?>
</div>

<footer class="bg-dark text-white text-center py-4 mt-5 shadow-lg">
  <div class="container">
    <div class="mb-2">
      <i class="fas fa-store fa-lg me-2"></i>
      <strong>Toko Online</strong>
    </div>
    <div class="small mb-2">
      Dibuat dengan <i class="fas fa-heart text-danger"></i> oleh Tim Developer
    </div>
    <div class="small">
      &copy; <?= date('Y') ?> Toko Online. All rights reserved.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
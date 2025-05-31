<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<style>
  .sidebar {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      width: 250px;
      background-color: #343a40;
      padding-top: 60px;
      transition: all 0.3s;
      z-index: 1000;
    }
    .sidebar a {
      color: white;
      padding: 15px;
      display: block;
      text-decoration: none;
      transition: background 0.3s;
    }

  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    overflow-x: hidden;
    font-family: sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  .wrapper {
    display: flex;
  }

  .sidebar .link-text,
  .sidebar #sidebarTitleText {
    transition: opacity 0.3s ease;
    opacity: 1;
    display: inline;
  }

  .sidebar.collapsed .link-text,
  .sidebar.collapsed #sidebarTitleText {
    opacity: 0;
    pointer-events: none;
    display: none;
  }

  .sidebar .nav-link {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  main {
  margin-left: 220px;
  width: calc(100% - 220px);
  transition: all 0.3s ease;
  padding: 20px;
  flex: 1;
}
</style>
<body>
  
<div class="container-fluid">
  <div class="row">
      
<!-- Sidebar -->
<div class="wrapper">
<nav class="sidebar d-flex flex-column px-3 py-3 text-white" id="sidebar">
  <div class="d-flex justify-content-between align-items-center my-4">
    <h5 class="fw-bold m-0 text-white d-flex align-items-center">
      <span class="me-2">🛍️</span>
      <span id="sidebarTitleText">MyStore Admin</span>
    </h5>
  </div>
  <a href="?f=dasboard&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-speedometer2 me-2"></i><span class="link-text">Dasbor</span>
  </a>
  <a href="?f=banner&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-image me-2"></i><span class="link-text">Banner</span>
  </a>
  <a href="?f=kategori&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-grid me-2"></i><span class="link-text">Kategori Produk</span>
  </a>
  <a href="?f=product&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-box me-2"></i><span class="link-text">Produk</span>
  </a>
  <a href="?f=orderdetail&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-bag me-2"></i><span class="link-text">Pesanan</span>
  </a>
  <a href="?f=order&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi-cash-stack me-2"></i><span class="link-text">Pembayaran</span>
  </a>
  <a href="?f=pelanggan&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-people me-2"></i><span class="link-text">Pelanggan</span>
  </a>
  <a href="?f=about&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-info-circle me-2"></i><span class="link-text">Tentang</span>
  </a>
  <a href="?f=contact&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-envelope me-2"></i><span class="link-text">Kontak</span>
  </a>
  <a href="?f=review&m=select" class="nav-link text-white mb-2 d-flex align-items-center">
    <i class="bi bi-chat-left-dots me-2"></i><span class="link-text">Review</span>
  </a>
</nav>

<main class="col-md-10 ms-sm-auto px-4 flex-grow-1 px-4">
<div class="content" id="content">
<main id="mainContent mr-5">
  <header class="d-flex justify-content-between align-items-center mt-3 mb-4">
    <form class="d-flex w-50">
      <input class="form-control me-2" type="search" placeholder="Cari..." aria-label="Search">
        <a class="btn btn-primary" href="">
          <span class="material-icons">search</span>
        </a>
    </form>
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-person-circle me-2"></i>admin@email.com
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#">Logout</a></li>
      </ul>
    </div>
  </header>

    <?php
      if (isset($_GET['f']) && isset($_GET['m'])) {
        $f = $_GET['f'];
        $m = $_GET['m'];
        $file = '../' . $f . '/' . $m . '.php';
        require_once $file;
      } else {
        require_once "../dasboard/select.php";
      }
    ?>
    
  <footer class="footer mt-auto">
        &copy; 2025 MyStore Admin Panel. All rights reserved.
  </footer> 
  </main>  
  </div>
 </main>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('salesChart') ? document.getElementById('salesChart').getContext('2d') : null;
  if(ctx) {
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
        datasets: [{
          label: 'Penjualan',
          data: [1200000, 1500000, 1700000, 1400000, 1800000],
          borderColor: 'rgba(78, 115, 223, 1)',
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });
  }
</script>

<style>
.footer {
  position: fixed;
  left: 250px;
  bottom: 0;
  width: calc(100% - 250px);
  z-index: 900;
  background-color: #e9ecef;
  text-align: center;
  padding: 1rem;
  border-top: 1px solid #dee2e6;
}
@media (max-width: 991.98px) {
  .footer {
    left: 0;
    width: 100%;
  }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


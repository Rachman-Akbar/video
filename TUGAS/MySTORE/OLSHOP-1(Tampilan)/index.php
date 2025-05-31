<?php
  $noHeaderFooter = false;

  if (isset($_GET['f']) && isset($_GET['m'])) {
    $f = $_GET['f'];
    $m = $_GET['m'];

    if ($m == 'login' || $m == 'register') {
      $noHeaderFooter = true;
    }

    $file = $f . '/' . $m . '.php';
  } else {
    $file = '';
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Toko Fashion Online</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<style>
  .position-absolute{
  top: 550px;
  right: 210px;
}
</style>
<body>

<?php if (!$noHeaderFooter): ?>
<header class="mb-5">
    <nav class="navbar navbar-expand-lg custom-navbar py-3 bg-light">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
        <a class="navbar-brand" href="index.php">
            <span class="material-icons align-middle">storefront</span> MyStore
        </a>
        </div>

        <div class="d-flex flex-grow-1 justify-content-center mx-3 gap-2" style="max-width: 600px;">
        <div class="input-group w-100">
            <div class="dropdown">
            <a class="mt-1 btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Elektronik</a></li>
                <li><a class="dropdown-item" href="#">Pakaian</a></li>
                <li><a class="dropdown-item" href="#">Aksesoris</a></li>
            </ul>
            </div>
            <input class="form-control" type="search" placeholder="Cari Produk..." aria-label="Search">
            <button class="btn btn-primary" type="submit">
            <span class="material-icons">search</span>
            </button>
        </div>
        </div>

        <div class="d-flex align-items-center gap-3">
        <a class="nav-link nav-hover d-flex align-items-center gap-1 position-relative" href="?f=home&m=cart">
            <span class="material-icons">shopping_cart</span>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-flex align-items-center justify-content-center" style="width: 15px; height: 15px; font-size: auto; padding: 10;">2
            </span>
        </a>
        <a class="nav-link nav-hover" href="?f=home&m=about">About Me</a>
        <a class="nav-link nav-hover" href="?f=home&m=contact">Contact</a>
        <div>
            <a href="?f=home&m=login" class="btn btn-primary" type="button">Login</a>
            <a href="?f=home&m=register" class="btn btn-outline-primary" type="button">Register</a>
        </div>
        </div>
    </div>
    </nav>
</header>
<?php endif; ?>

<?php
  if (isset($_GET['f']) && isset($_GET['m'])) {
    $f = $_GET['f'];
    $m = $_GET['m'];

    $file = $f . '/' . $m . '.php';
    require_once $file;

  } else {
    require_once "home/banner.php";
    require_once "home/kategori.php";
    echo '
    <div class="container">
      <div class="position-absolute flex-shrink-0 p-1 d-flex flex-column align-items-center kategori-small" style="width: 80px;">
        <a href="?f=home&m=kategori" style="text-decoration: none; color: inherit;">
          <div class=" mb-2 d-flex justify-content-center align-items-center" data-aos="fade-up" style="width: 60px; height: 60px;">
            <i class="bi bi-grid me-2" style="font-size: 2rem;"></i>
          </div>
          <div class="text-center mt-2">Lainnya</div>
        </a>
      </div>
    </div>';

    echo '
      <div class="container position-relative"> 
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h3>Produk Kami</h3>
          <a class="btn btn-outline-primary" href="?f=home&m=product">
            Lihat Lebih Banyak
          </a>
        </div>
      </div>
    ';
    require_once "home/product.php";
  }
?>

<?php if (!$noHeaderFooter): ?>
  <footer class="bg-dark text-white pt-4 pb-4">
  <div class="container">
    <div class="row text-center text-md-start">
      <div class="col-md-3 mb-4">
        <h5>Produk Kami</h5>
        <div class="footer-link">
          <a href="#">Pria</a>
          <a href="#">Wanita</a>
          <a href="#">Anak-anak</a>
          <a href="#">Aksesoris</a>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <h5>Pembayaran</h5>
        <p>
          <span class="material-icons">account_balance</span> Transfer Bank<br>
          <span class="material-icons">qr_code</span> QRIS<br>
          <span class="material-icons">account_balance_wallet</span> e-Wallet
        </p>
      </div>
      <div class="col-md-3 mb-4">
        <h5>Media Sosial</h5>
        <div class="footer-link">
          <a href="#"><span class="material-icons">facebook</span> Facebook</a>
          <a href="#"><span class="material-icons">photo_camera</span> Instagram</a>
          <a href="#"><span class="material-icons">alternate_email</span> Twitter</a>
          <a href="#"><span class="material-icons">smart_display</span> YouTube</a>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <h5>Tentang Kami & Kontak</h5>
        <p>Jl. Fashion No.123, Jakarta<br />Telp: 0812-3456-7890<br />Email: info@fashionstore.id</p>
      </div>
    </div>
  </div>
</footer>
<?php endif; ?>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <script>
document.querySelectorAll('.lihat-btn').forEach(button => {
  button.addEventListener('click', function () {
    const nama = this.getAttribute('data-nama');
    const harga = this.getAttribute('data-harga');
    const gambar = this.getAttribute('data-gambar');
    const deskripsi = this.getAttribute('data-deskripsi');

    document.getElementById('modalNama').textContent = nama;
    document.getElementById('modalHarga').textContent = harga;
    document.getElementById('modalGambar').src = gambar;
    document.getElementById('modalDeskripsi').textContent = deskripsi;
  });
});
</script>
<script>
  const container = document.querySelector('.row.text-center');
  const leftArrow = document.getElementById('left-arrow');
  const rightArrow = document.getElementById('right-arrow');

  leftArrow.addEventListener('click', () => {
    container.scrollBy({ left: -200, behavior: 'smooth' });
  });

  rightArrow.addEventListener('click', () => {
    container.scrollBy({ left: 200, behavior: 'smooth' });
  });

  container.classList.add('kategori-scroll-container');

  const items = container.querySelectorAll('.col-4');
  items.forEach(item => item.classList.add('kategori-item'));
</script>


</body>
</html>

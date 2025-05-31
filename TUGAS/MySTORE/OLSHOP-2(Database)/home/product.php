<?php

// Koneksi database
$servername = "localhost";
$username = "root";
$password = ""; // sesuaikan
$dbname = "mystore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi keranjang belanja jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Menangani penambahan ke keranjang
if (isset($_POST['add_to_cart']) && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }

    // Set pesan sukses
    $_SESSION['message'] = "Produk berhasil ditambahkan ke keranjang!";
    header("Location: index.php?f=home&m=cart"); // Diubah ke halaman cart
    exit();
}

// Memeriksa parameter kategori_id untuk filter produk
$where = '';
if (isset($_GET['kategori_id']) && $_GET['kategori_id'] !== '') {
    $kategori_id = (int)$_GET['kategori_id'];
    $where = "WHERE category_id = $kategori_id";
}
?>

<style>
    .product-card {
      transition: transform 0.3s;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .cart-badge {
      position: absolute;
      top: -5px;
      right: -5px;
    }
</style>

<div class="container my-4">
  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <?= $_SESSION['message'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>

  <h3 class="mb-4 text-center">Daftar Produk</h3>
  
  <!-- Filter Kategori -->
  <div class="mb-4">
    <form method="get" class="row g-3">
      <div class="col-md-4">
        <select class="form-select" name="kategori_id" onchange="this.form.submit()">
          <option value="">Semua Kategori</option>
          <?php
          $kategori = $conn->query("SELECT * FROM categories");
          while ($k = $kategori->fetch_assoc()):
          ?>
          <option value="<?= $k['id'] ?>" <?= isset($_GET['kategori_id']) && $_GET['kategori_id'] == $k['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($k['name']) ?>
          </option>
          <?php endwhile; ?>
        </select>
      </div>
    </form>
  </div>
  
  <!-- Daftar Produk -->
  <div class="row g-4">
    <?php
    $produk = $conn->query("SELECT * FROM products $where");
    while ($p = $produk->fetch_assoc()):
    ?>
    <div class="col-md-4 col-sm-6">
      <div class="card h-100 shadow-sm product-card">
        <?php if ($p['image']): ?>
          <img src="admin/Uploads/<?= htmlspecialchars($p['image']) ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?= htmlspecialchars($p['name']) ?>">
        <?php else: ?>
          <img src="https://via.placeholder.com/300x250?text=No+Image" class="card-img-top" style="height: 250px; object-fit: cover;" alt="No Image">
        <?php endif; ?>
        <div class="card-body d-flex flex-column">
          <h5 class="card-title"><?= htmlspecialchars($p['name']) ?></h5>
          <p class="card-text text-muted">Rp <?= number_format($p['price'], 0, ',', '.') ?></p>
          <p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
          
          <form method="post" class="mt-auto">
            <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
            <div class="input-group mb-3">
              <input type="number" name="quantity" class="form-control" value="1" min="1">
              <button type="submit" name="add_to_cart" class="btn btn-success">
                <i class="fas fa-cart-plus"></i> Tambah
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>



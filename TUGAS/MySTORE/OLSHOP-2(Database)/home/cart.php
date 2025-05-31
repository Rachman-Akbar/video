<?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mystore";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Handle GET actions (add/remove)
if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 0;
    }
    $_SESSION['cart'][$id]++;
    header("Location: index.php?f=home&m=cart");
    exit;
}

if (isset($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    header("Location: index.php?f=home&m=cart");
    exit;
}

if (isset($_GET['decrease'])) {
    $id = (int)$_GET['decrease'];
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]--;
        if ($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    header("Location: index.php?f=home&m=cart");
    exit;
}
?>

<style>
    .quantity-input {
      width: 60px;
      text-align: center;
    }
    .quantity-btn {
      width: 30px;
    }
  </style>


<div class="container my-4">
  <h4 class="mb-4"><i class="fas fa-shopping-cart"></i> Keranjang Belanja</h4>
  
  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show">
      <?= $_SESSION['message'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>
  
  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show">
      <?= $_SESSION['error'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
    <form method="post" action="?f=home&m=cart">
      <table class="table table-bordered table-hover">
        <thead class="table-primary">
          <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $total = 0;
          foreach ($_SESSION['cart'] as $id => $qty):
            $data = $conn->query("SELECT * FROM products WHERE id=$id");
            if ($data->num_rows > 0):
              $p = $data->fetch_assoc();
              $subtotal = $qty * $p['price'];
              $total += $subtotal;
          ?>
          <tr>
            <td>
                <h6><?= htmlspecialchars($p['name']) ?></h6>
            </td>
            <td class="align-middle">Rp <?= number_format($p['price']) ?></td>
            <td class="align-middle">
              <div class="input-group">
                <a href="?f=home&m=cart&decrease=<?= $id ?>" class="btn btn-outline-secondary quantity-btn">
                  <i class="fas fa-minus"></i>
                </a>
                <input type="number" name="quantity[<?= $id ?>]" value="<?= $qty ?>" min="1" class="form-control quantity-input">
                <a href="?f=home&m=cart&add=<?= $id ?>" class="btn btn-outline-secondary quantity-btn">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </td>
            <td class="align-middle">Rp <?= number_format($subtotal) ?></td>
            <td class="align-middle">
              <a href="?f=home&m=cart&remove=<?= $id ?>" class="btn btn-danger btn-sm" title="Hapus">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php endif; endforeach; ?>
          <tr>
            <td colspan="3" class="text-end"><strong>Total:</strong></td>
            <td colspan="2"><strong>Rp <?= number_format($total) ?></strong></td>
          </tr>
        </tbody>
      </table>
      
      <div class="d-flex justify-content-between">
        <a href="index.php" class="btn btn-outline-primary">
          <i class="fas fa-arrow-left"></i> Lanjutkan Belanja
        </a>
        <div>
          <a href="?f=home&m=checkout" class="btn btn-success">
            <i class="fas fa-credit-card"></i> Proses Checkout
          </a>
        </div>
      </div>
    </form>
  <?php else: ?>
    <div class="alert alert-warning text-center py-5">
      <i class="fas fa-shopping-cart fa-3x mb-3"></i>
      <h5>Keranjang belanja Anda kosong</h5>
      <p class="mb-0">Mulai belanja dan temukan produk menarik untuk ditambahkan ke keranjang</p>
      <a href="index.php" class="btn btn-primary mt-3">
        <i class="fas fa-store"></i> Mulai Belanja
      </a>
    </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Auto submit when quantity is changed manually
document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', function() {
        this.closest('form').querySelector('button[name="update_cart"]').click();
    });
});
</script>

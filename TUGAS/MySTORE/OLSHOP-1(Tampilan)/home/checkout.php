<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['alamat'] = $_POST['alamat'];
    $_SESSION['telepon'] = $_POST['telepon'];
    $_SESSION['email'] = $_POST['email'];
    $pesan = "Data berhasil disimpan. Silakan lanjutkan ke proses order.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Data Diri Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mb-3 mt-5">
    <h2 class="mb-4"><i class="fas fa-user"></i> Checkout - Data Diri Pelanggan</h2>
    <?php if(isset($pesan)): ?>
        <div class="alert alert-success"> <?= $pesan ?> </div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?= isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= isset($_SESSION['alamat']) ? htmlspecialchars($_SESSION['alamat']) : '' ?></textarea>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required value="<?= isset($_SESSION['telepon']) ? htmlspecialchars($_SESSION['telepon']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
        </div>
        <a href="?f=home&m=detail" type="submit" class="btn btn-primary">Simpan & Lanjutkan</a>
    </form>
</div>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
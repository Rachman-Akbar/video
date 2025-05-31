<?php

$success = '';
$error = '';

if (isset($_POST['register'])) {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Cek apakah email sudah digunakan
    $cek = $conn->prepare("SELECT id FROM customers WHERE email = ?");
    $cek->bind_param("s", $email);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        $error = "Email sudah terdaftar!";
    } else {
        $stmt = $conn->prepare("INSERT INTO customers (name, email, password, status) VALUES (?, ?, ?, 'active')");
        $stmt->bind_param("sss", $nama, $email, $password);
        if ($stmt->execute()) {
            $success = "Registrasi berhasil. <a href='?f=home&m=login'>Login di sini</a>";
        } else {
            $error = "Gagal menyimpan data!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
  <h3 class="mb-4 text-center">Registrasi Pelanggan</h3>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php elseif (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label>Nama</label>
      <input name="nama" type="text" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input name="email" type="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input name="password" type="password" class="form-control" required>
    </div>
    <button name="register" class="btn btn-success w-100">Daftar</button>
  </form>
</div>
</body>
</html>

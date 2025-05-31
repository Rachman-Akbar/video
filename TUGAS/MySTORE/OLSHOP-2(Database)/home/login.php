<?php

$error = '';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ? AND status = 'active'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $cust = $result->fetch_assoc();

    if ($cust && password_verify($password, $cust['password'])) {
        $_SESSION['customer_id'] = $cust['id'];
        $_SESSION['customer_name'] = $cust['name'];
        $_SESSION['customer_email'] = $cust['email'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Email atau password salah, atau akun tidak aktif.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
  <h3 class="mb-4 text-center">Login Pelanggan</h3>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button name="login" class="btn btn-primary w-100">Login</button>
    <p class="mt-3 text-center">Belum punya akun? <a href="?f=home&m=register">Daftar di sini</a></p>
  </form>
</div>
</body>
</html>

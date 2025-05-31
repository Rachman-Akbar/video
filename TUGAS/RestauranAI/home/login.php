<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Restauran | Restauran SMK JAYA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../styles.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5 col-sm-8">
                <div class="card shadow-sm animate-form">
                    <div class="card-header bg-gradient-primary text-white text-center">
                        <h3 class="mb-0"><i class="fas fa-sign-in-alt me-2"></i>Login Restauran</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_POST['login'])): ?>
                            <?php 
                                $email = $_POST['email'];
                                $password = $_POST['password'];
                                $sql = "SELECT * FROM tblpelanggan WHERE email='$email' AND password='$password' AND aktif=1";
                                $count = $db->rowCOUNT($sql);
                                if ($count == 0) {
                            ?>
                                    <div class="alert alert-danger alert-dismissible fade show animate-alert" role="alert">
                                        <i class="fas fa-exclamation-circle me-2"></i>Email atau Password Salah!!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php } else { ?>
                                <?php 
                                    $sql = "SELECT * FROM tblpelanggan WHERE email='$email' AND password='$password' AND aktif=1";
                                    $row = $db->getITEM($sql);
                                    $_SESSION['pelanggan'] = $row['email'];
                                    $_SESSION['idpelanggan'] = $row['idpelanggan'];
                                    header("Location:index.php");
                                ?>
                            <?php } ?>
                        <?php endif; ?>
                        <form action="" method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                                <div class="invalid-feedback">Email harus diisi dengan format yang valid.</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required minlength="3">
                                <div class="invalid-feedback">Password harus diisi (minimal 6 karakter).</div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" name="login" value="login" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login
                                </button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <p class="mb-0">Belum punya akun? <a href="?f=home&m=daftar" class="text-primary">Daftar di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- Form Validation Script -->
    <script>
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>
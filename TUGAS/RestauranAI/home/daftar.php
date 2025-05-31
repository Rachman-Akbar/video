<?php 
    if (isset($_POST['simpan'])) {
        $pelanggan = $_POST['pelanggan'];
        $alamat = $_POST['alamat'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $konfirmasi = $_POST['konfirmasi'];
        $level = $_POST['level'] ?? 'customer'; // Default to 'customer' if level is not provided
        if ($konfirmasi === $password) {
            $sql = "INSERT INTO tblpelanggan VALUES ('', ?, ?, ?, ?, ?, 1)";
            $db->runSQL($sql, [$pelanggan, $alamat, $telp, $email, $password]);
            header("location:?f=home&m=info");
        } else {
            $error = "PASSWORD TIDAK SESUAI";
        }
    }
?>

<div class="container my-4">
    <h3 class="text-primary fw-bold mb-4"><i class="fas fa-user-plus me-2"></i>Registrasi Pelanggan</h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show animate-alert" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm animate-form">
        <div class="card-body">
            <form action="" method="post" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="pelanggan" class="form-label"><i class="fas fa-user me-2"></i>Nama Pelanggan</label>
                    <input type="text" name="pelanggan" id="pelanggan" class="form-control" placeholder="Masukkan nama pelanggan" required>
                    <div class="invalid-feedback">Nama pelanggan harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat" required>
                    <div class="invalid-feedback">Alamat harus diisi.</div>
                </div>
                <div class="mb-3">
                    <label for="telp" class="form-label"><i class="fas fa-phone me-2"></i>Telepon</label>
                    <input type="tel" name="telp" id="telp" class="form-control" placeholder="Masukkan nomor telepon" required pattern="[0-9]+">
                    <div class="invalid-feedback">Nomor telepon harus diisi dengan angka.</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" required>
                    <div class="invalid-feedback">Email harus diisi dengan format yang valid.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required minlength="6">
                    <div class="invalid-feedback">Password harus diisi (minimal 6 karakter).</div>
                </div>
                <div class="mb-3">
                    <label for="konfirmasi" class="form-label"><i class="fas fa-lock me-2"></i>Konfirmasi Password</label>
                    <input type="password" name="konfirmasi" id="konfirmasi" class="form-control" placeholder="Konfirmasi password" required minlength="6">
                    <div class="invalid-feedback">Konfirmasi password harus diisi.</div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" name="simpan" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Bootstrap form validation
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
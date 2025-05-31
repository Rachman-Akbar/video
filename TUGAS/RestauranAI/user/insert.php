<h3 class="mb-4 fw-bold"><i class="fas fa-user-plus me-2"></i>Insert User</h3>

<div class="card shadow-sm p-4 w-75 mx-auto">
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Nama User</label>
            <input type="text" name="user" required placeholder="Isi nama user" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" required placeholder="Masukkan email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" required placeholder="Password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="konfirmasi" required placeholder="Ulangi password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
            <select name="level" class="form-select" required>
                <option value="admin">Admin</option>
                <option value="koki">Koki</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>

        <div class="text-end">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary px-4">
        </div>
    </form>

    <?php 
        if (isset($_POST['simpan'])) {
            $user = $_POST['user'];
            $email = $_POST['email'];
            $password = hash('sha256', $_POST['password']);
            $konfirmasi = hash('sha256', $_POST['konfirmasi']);
            $level = $_POST['level'];

            if ($konfirmasi === $password) {
                $sql = "INSERT INTO tbluser VALUES ('', '$user', '$email', '$password', '$level', 1)";
                $db->runSQL($sql);
                header("location:?f=user&m=select");
                exit;
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>Password tidak sesuai!
                      </div>';
            }
        }
    ?>
</div>

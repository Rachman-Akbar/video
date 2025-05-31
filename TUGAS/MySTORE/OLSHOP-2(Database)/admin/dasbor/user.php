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

// Tambah user
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (name, email, password) VALUES ('$nama', '$email', '$password')");
}

// Hapus user
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM users WHERE id = {$_GET['hapus']}");
}

// Ubah password user
if (isset($_POST['ubah_password'])) {
    $id = (int)$_POST['user_id'];
    $newpass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$newpass' WHERE id=$id");
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            Password berhasil diubah.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
}
?>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin-top: 30px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            font-weight: 600;
        }
        .form-control {
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        .btn-primary, .btn-warning, .btn-danger {
            border-radius: 5px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover, .btn-warning:hover, .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }
        .modal-content {
            border-radius: 10px;
        }
        .modal-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }
        @media (max-width: 576px) {
            .table-responsive {
                font-size: 14px;
            }
            .btn-sm {
                padding: 5px 10px;
                font-size: 12px;
            }
        }
    </style>

    <div class="container">
        <h2 class="mb-4"><i class="fas fa-users-cog me-2"></i>Kelola User</h2>
        
        <!-- Form Tambah User -->
        <div class="card mb-4">
            <div class="card-header">
                Tambah User Baru
            </div>
            <div class="card-body">
                <form method="POST" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="nama" class="form-control" placeholder="Nama User" required>
                    </div>
                    <div class="col-md-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-4">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-12 text-end">
                        <button name="tambah" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Tambah</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel User -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("SELECT * FROM users");
                    while ($row = $data->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>
                                    <a href='?f=dasbor&m=user&hapus={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus user ini?')\">
                                        <i class='fas fa-trash me-1'></i>Hapus
                                    </a>
                                    <button type='button' class='btn btn-warning btn-sm ms-1' data-bs-toggle='modal' data-bs-target='#ubahPasswordModal{$row['id']}'>
                                        <i class='fas fa-key me-1'></i>Ubah Password
                                    </button>
                                    
                                    <!-- Modal Ubah Password -->
                                    <div class='modal fade' id='ubahPasswordModal{$row['id']}' tabindex='-1' aria-labelledby='ubahPasswordLabel{$row['id']}' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <form method='POST'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='ubahPasswordLabel{$row['id']}'>Ubah Password User</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='user_id' value='{$row['id']}'>
                                                        <div class='mb-3'>
                                                            <label class='form-label'>Password Baru</label>
                                                            <input type='password' name='new_password' class='form-control' required>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                        <button type='submit' name='ubah_password' class='btn btn-warning'>Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

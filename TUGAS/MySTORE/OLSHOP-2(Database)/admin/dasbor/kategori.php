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

// Fungsi Tambah Kategori
if (isset($_POST['tambah_kategori'])) {
    $nama = trim($_POST['nama_kategori']);
    if ($nama != "") {
        $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $nama);
        $stmt->execute();
        $stmt->close();
        echo "<script>window.location='index.php?f=dasbor&m=kategori';</script>";
        exit;
    }
}

// Fungsi Edit Kategori
if (isset($_POST['edit_kategori'])) {
    $id = intval($_POST['id_kategori']);
    $nama = trim($_POST['nama_kategori']);
    if ($nama != "") {
        $stmt = $conn->prepare("UPDATE categories SET name=? WHERE id=?");
        $stmt->bind_param("si", $nama, $id);
        $stmt->execute();
        $stmt->close();
        echo "<script>window.location='index.php?f=dasbor&m=kategori';</script>";
        exit;
    }
}

// Fungsi Hapus Kategori
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $stmt = $conn->prepare("DELETE FROM categories WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    echo "<script>window.location='index.php?f=dasbor&m=kategori';</script>";
    exit;
}

// Ambil data kategori untuk edit (jika ada)
$edit_data = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM categories WHERE id=$id");
    if ($result->num_rows > 0) {
        $edit_data = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori dan Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        .form-control, .form-select {
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        .btn-success, .btn-warning, .btn-danger, .btn-primary {
            border-radius: 5px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }
        .btn-success:hover, .btn-warning:hover, .btn-danger:hover, .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
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
</head>
<body>
    <div class="container"> 
      
    <!-- Tabel Kategori -->
        <h3 class="mb-3"><i class="fas fa-list me-2"></i>Daftar Kategori</h3>
                <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("SELECT * FROM categories");
                    if ($data->num_rows == 0) {
                        echo "<tr><td colspan='3' class='text-center'>Tidak ada kategori ditemukan.</td></tr>";
                    } else {
                        $no = 1;
                        while ($row = $data->fetch_assoc()) {
                            echo "<tr>
                                    <td>$no</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>
                                        <a href='?f=dasbor&m=kategori&edit=" . $row['id'] . "' class='btn btn-warning btn-sm me-1'><i class='fas fa-edit me-1'></i>Edit</a>
                                        <a href='?f=dasbor&m=kategori&hapus=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Hapus kategori ini?')\"><i class='fas fa-trash me-1'></i>Hapus</a>
                                    </td>
                                  </tr>";
                            $no++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form Tambah/Edit Kategori -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori" required value="<?php echo isset($edit_data) ? htmlspecialchars($edit_data['name']) : ''; ?>">
                    <?php if (isset($edit_data)): ?>
                        <input type="hidden" name="id_kategori" value="<?php echo $edit_data['id']; ?>">
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <?php if (isset($edit_data)): ?>
                        <button type="submit" name="edit_kategori" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Update</button>
                        <a href="kategori.php" class="btn btn-secondary">Batal</a>
                    <?php else: ?>
                        <button type="submit" name="tambah_kategori" class="btn btn-success"><i class="fas fa-plus me-1"></i>Tambah</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
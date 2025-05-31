<?php
require_once('dasbor/produk.php');
?><?php
// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mystore";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Direktori untuk upload gambar
$upload_dir = 'Uploads/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Tambah produk
if (isset($_POST['tambah_produk'])) {
    $nama = $_POST['nama_produk'];
    $category_id = (int)$_POST['category_id'];
    $harga = (float)$_POST['harga'];
    $description = $_POST['description'];
    $image = null;

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $file_name;
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    Gagal mengunggah gambar.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
        }
    }

    $stmt = $conn->prepare("INSERT INTO products (name, category_id, price, description, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sidss", $nama, $category_id, $harga, $description, $image);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Produk berhasil ditambahkan.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Gagal menambahkan produk.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    $stmt->close();
}

// Hapus produk
if (isset($_GET['hapus_produk'])) {
    $id = (int)$_GET['hapus_produk'];
    
    // Ambil nama file gambar untuk dihapus
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc() && $row['image']) {
        $image_path = $upload_dir . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Produk berhasil dihapus.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Gagal menghapus produk.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    $stmt->close();
    // Redirect ke halaman yang sama
    echo "<script>window.location='?f=dasbor&m=produk';</script>";
    exit;
}

// Edit produk
if (isset($_POST['edit_produk'])) {
    $id = (int)$_POST['produk_id'];
    $nama = $_POST['nama_produk'];
    $category_id = (int)$_POST['category_id'];
    $harga = (float)$_POST['harga'];
    $description = $_POST['description'];
    $image = null;

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        // Hapus gambar lama
        $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row && $row['image']) {
            $image_path = $upload_dir . $row['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $stmt->close();

        $file_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = $file_name;
        }
    }

    // Update produk
    $query = $image ? "UPDATE products SET name = ?, category_id = ?, price = ?, description = ?, image = ? WHERE id = ?" : 
                      "UPDATE products SET name = ?, category_id = ?, price = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($image) {
        $stmt->bind_param("sidssi", $nama, $category_id, $harga, $description, $image, $id);
    } else {
        $stmt->bind_param("sidsi", $nama, $category_id, $harga, $description, $id);
    }
    if ($stmt->execute()) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Produk berhasil diperbarui.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Gagal memperbarui produk.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    $stmt->close();
}

// Ambil data produk untuk edit jika ada
$edit_produk_data = null;
if (isset($_GET['edit_produk'])) {
    $id_edit = (int)$_GET['edit_produk'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id_edit);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $edit_produk_data = $result->fetch_assoc();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
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
        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .form-control, .form-select {
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        .btn-success, .btn-warning, .btn-danger, .btn-secondary {
            border-radius: 5px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }
        .btn-success:hover, .btn-warning:hover, .btn-danger:hover, .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .badge {
            font-size: 0.9em;
        }
        @media (max-width: 576px) {
            .card-title, .card-text {
                font-size: 14px;
            }
            .btn-sm {
                padding: 5px 10px;
                font-size: 12px;
            }
            .badge {
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4"><i class="fas fa-box-open me-2"></i>Kelola Produk</h2>

        <div class="row">
            <!-- Daftar Produk -->
            <div class="col-md-8">
                <div class="row">
                    <?php
                    $produk = $conn->query("SELECT products.*, categories.name AS kategori FROM products LEFT JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC");
                    if ($produk->num_rows == 0) {
                        echo "<div class='col-12'><div class='alert alert-info text-center'>Belum ada produk.</div></div>";
                    } else {
                        while ($row = $produk->fetch_assoc()) {
                    ?>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                <?php if ($row['image']): ?>
                                    <img src="Uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" style="object-fit: cover; height: 180px;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/300x180?text=No+Image" class="card-img-top" style="object-fit: cover; height: 180px;">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title mb-2"><?php echo htmlspecialchars($row['name']); ?></h5>
                                    <div class="mb-2">
                                        <span class="badge bg-primary"><i class="fas fa-tag me-1"></i><?php echo htmlspecialchars($row['kategori'] ?: 'Tanpa Kategori'); ?></span>
                                    </div>
                                    <p class="card-text fw-semibold text-success mb-2">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                    <p class="card-text"><?php echo htmlspecialchars($row['description'] ?: 'Tanpa Deskripsi'); ?></p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
                                    <a href="?f=dasbor&m=produk&edit_produk=<?php echo urlencode($row['id']); ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit me-1"></i>Edit</a>
                                    <a href="?f=dasbor&m=produk&hapus_produk=<?php echo urlencode($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')"><i class="fas fa-trash me-1"></i>Hapus</a>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Form Tambah/Edit Produk -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <?php echo $edit_produk_data ? 'Edit Produk' : 'Tambah Produk'; ?>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <?php if ($edit_produk_data): ?>
                                <input type="hidden" name="produk_id" value="<?php echo $edit_produk_data['id']; ?>">
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" required value="<?php echo $edit_produk_data ? htmlspecialchars($edit_produk_data['name']) : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="" disabled <?php echo !$edit_produk_data ? 'selected' : ''; ?>>Pilih Kategori</option>
                                    <?php
                                    $cat = $conn->query("SELECT * FROM categories");
                                    while ($c = $cat->fetch_assoc()) {
                                        $selected = $edit_produk_data && $edit_produk_data['category_id'] == $c['id'] ? 'selected' : '';
                                        echo "<option value='{$c['id']}' $selected>" . htmlspecialchars($c['name']) . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" required min="0" step="0.01" value="<?php echo $edit_produk_data ? $edit_produk_data['price'] : ''; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" name="image" class="form-control" accept="image/*" <?php echo $edit_produk_data ? '' : 'required'; ?>>
                                <?php if ($edit_produk_data && $edit_produk_data['image']): ?>
                                    <img src="Uploads/<?php echo htmlspecialchars($edit_produk_data['image']); ?>" class="img-thumbnail mt-2" width="100">
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="4"><?php echo $edit_produk_data ? htmlspecialchars($edit_produk_data['description']) : ''; ?></textarea>
                            </div>
                            <div class="d-grid">
                                <?php if ($edit_produk_data): ?>
                                    <button type="submit" name="edit_produk" class="btn btn-warning"><i class="fas fa-edit me-1"></i>Update</button>
                                    <a href="produk.php" class="btn btn-secondary mt-2">Batal</a>
                                <?php else: ?>
                                    <button type="submit" name="tambah_produk" class="btn btn-success"><i class="fas fa-plus me-1"></i>Tambah</button>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
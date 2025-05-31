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

// Update status pesanan
if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];
    
    // Validasi status
    $valid_statuses = ['pending', 'processing', 'completed', 'cancelled'];
    if (in_array($status, $valid_statuses)) {
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Status pesanan berhasil diubah.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Status tidak valid.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
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
        .form-select, .btn {
            border-radius: 5px;
        }
        .btn-primary {
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .status-badge {
            font-size: 0.9em;
            padding: 0.4em 0.8em;
        }
        @media (max-width: 576px) {
            .table-responsive {
                font-size: 14px;
            }
            .btn-sm {
                padding: 5px 10px;
                font-size: 12px;
            }
            .status-badge {
                font-size: 0.8em;
            }
        }
    </style>

    <div class="container">
        <h2 class="mb-4"><i class="fas fa-shopping-cart me-2"></i>Pesanan Masuk</h2>
        
        <!-- Tabel Pesanan -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("SELECT orders.*, customers.name FROM orders JOIN customers ON customers.id = orders.customer_id");
                    if ($data->num_rows == 0) {
                        echo "<tr><td colspan='6' class='text-center'>Tidak ada pesanan ditemukan.</td></tr>";
                    } else {
                        while ($row = $data->fetch_assoc()) {
                            // Menentukan kelas badge berdasarkan status
                            $badge_class = '';
                            switch ($row['status']) {
                                case 'pending':
                                    $badge_class = 'bg-warning text-dark';
                                    break;
                                case 'processing':
                                    $badge_class = 'bg-info text-dark';
                                    break;
                                case 'completed':
                                    $badge_class = 'bg-success text-white';
                                    break;
                                case 'cancelled':
                                    $badge_class = 'bg-danger text-white';
                                    break;
                            }
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['order_date']) . "</td>
                                    <td>" . number_format($row['total'], 0, ',', '.') . "</td>
                                    <td>
                                        <span class='badge status-badge $badge_class'>" . ucfirst($row['status']) . "</span>
                                    </td>
                                    <td>
                                        <form method='POST' class='d-flex align-items-center'>
                                            <input type='hidden' name='id' value='{$row['id']}'>
                                            <select name='status' class='form-select form-select-sm me-2' style='width: 150px;'>
                                                <option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option>
                                                <option value='processing' " . ($row['status'] == 'processing' ? 'selected' : '') . ">Processing</option>
                                                <option value='completed' " . ($row['status'] == 'completed' ? 'selected' : '') . ">Completed</option>
                                                <option value='cancelled' " . ($row['status'] == 'cancelled' ? 'selected' : '') . ">Cancelled</option>
                                            </select>
                                            <button type='submit' name='update' class='btn btn-primary btn-sm'><i class='fas fa-save me-1'></i>Ubah</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

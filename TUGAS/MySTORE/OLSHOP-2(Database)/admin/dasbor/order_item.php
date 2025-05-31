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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Item Pesanan</title>
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
        @media (max-width: 576px) {
            .table-responsive {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4"><i class="fas fa-list-ul me-2"></i>Detail Item Pesanan</h2>
        
        <!-- Tabel Detail Item Pesanan -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Order ID</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("
                        SELECT oi.*, p.name AS product 
                        FROM order_items oi 
                        JOIN products p ON p.id = oi.product_id
                    ");
                    if ($data->num_rows == 0) {
                        echo "<tr><td colspan='5' class='text-center'>Tidak ada item pesanan ditemukan.</td></tr>";
                    } else {
                        while ($row = $data->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>" . htmlspecialchars($row['order_id']) . "</td>
                                    <td>" . htmlspecialchars($row['product']) . "</td>
                                    <td>" . htmlspecialchars($row['quantity']) . "</td>
                                    <td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                                  </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
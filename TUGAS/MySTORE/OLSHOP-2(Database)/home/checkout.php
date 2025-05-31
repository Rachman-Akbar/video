<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mystore";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (!isset($_SESSION['customer_id'])) {
    header("Location: ../index.php?f=home&m=login");
    exit;
}

if (!empty($_SESSION['cart'])) {
    $cid = $_SESSION['customer_id'];
    $tanggal = date('Y-m-d');
    $total = 0;

    // Hitung total
    foreach ($_SESSION['cart'] as $id => $qty) {
        $p = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
        $total += $p['price'] * $qty;
    }

    // Simpan order
    $conn->query("INSERT INTO orders (customer_id, order_date, total, status) VALUES ($cid, '$tanggal', $total, 'pending')");
    $order_id = $conn->insert_id;

    // Simpan order item
    foreach ($_SESSION['cart'] as $id => $qty) {
        $p = $conn->query("SELECT * FROM products WHERE id = $id")->fetch_assoc();
        $price = $p['price'];
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($order_id, $id, $qty, $price)");
    }

    unset($_SESSION['cart']);

    // Tampilkan detail pesanan
    echo "<div class='container my-4'>";
    echo "<div class='alert alert-success'><strong>Checkout berhasil!</strong> Pesanan Anda telah diterima.</div>";
    echo "<h4>Detail Pesanan #$order_id</h4>";
    echo "<table class='table table-bordered'>";
    echo "<tr><th>Produk</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>";
    $data = $conn->query("SELECT oi.*, p.name FROM order_items oi JOIN products p ON p.id = oi.product_id WHERE order_id = $order_id");
    $grand = 0;
    while ($item = $data->fetch_assoc()) {
        $sub = $item['quantity'] * $item['price'];
        $grand += $sub;
        echo "<tr>
                <td>{$item['name']}</td>
                <td>{$item['quantity']}</td>
                <td>Rp " . number_format($item['price']) . "</td>
                <td>Rp " . number_format($sub) . "</td>
              </tr>";
    }
    echo "<tr><td colspan='3' class='text-end'><strong>Total</strong></td><td><strong>Rp " . number_format($grand) . "</strong></td></tr>";
    echo "</table>";

    // Tampilkan daftar pesanan
    echo "<h4 class='mt-5'>Daftar Pesanan Anda</h4>";
    echo "<table class='table table-bordered'>";
    echo "<tr><th>ID</th><th>Tanggal</th><th>Total</th><th>Status</th></tr>";
    $orders = $conn->query("SELECT * FROM orders WHERE customer_id = $cid ORDER BY id DESC");
    while ($o = $orders->fetch_assoc()) {
        echo "<tr>
                <td>{$o['id']}</td>
                <td>{$o['order_date']}</td>
                <td>Rp " . number_format($o['total']) . "</td>
                <td>{$o['status']}</td>
              </tr>";
    }
    echo "</table>";
    echo "<a href='index.php' class='btn btn-primary mt-3'><i class='fas fa-store'></i> Kembali ke Beranda</a>";
    echo "</div>";
} else {
    header("Location: cart.php");
    exit;
}
?>

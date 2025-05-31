<?php
$order_id = $_GET['id'];
?>

<div class="container my-4">
  <h3 class="mb-4"><i class="fas fa-receipt"></i> Detail Pesanan #<?= htmlspecialchars($order_id) ?></h3>
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-primary">
        <tr>
          <th>Produk</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $data = $conn->query("SELECT oi.*, p.name FROM order_items oi JOIN products p ON p.id = oi.product_id WHERE order_id = $order_id");
        $grand = 0;
        while ($item = $data->fetch_assoc()) {
            $sub = $item['quantity'] * $item['price'];
            $grand += $sub;
            echo "<tr>
                    <td>" . htmlspecialchars($item['name']) . "</td>
                    <td>{$item['quantity']}</td>
                    <td>Rp " . number_format($item['price']) . "</td>
                    <td>Rp " . number_format($sub) . "</td>
                  </tr>";
        }
        ?>
        <tr>
          <td colspan="3" class="text-end"><strong>Total</strong></td>
          <td><strong>Rp <?= number_format($grand) ?></strong></td>
        </tr>
      </tbody>
    </table>
  </div>
  <a href="?f=home&m=order" class="btn btn-secondary mt-3">
    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
  </a>
</div>

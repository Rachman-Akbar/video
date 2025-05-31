
<div class="container my-4">
  <h3 class="mb-4"><i class="fas fa-list"></i> Pesanan Saya</h3>
  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
      <thead class="table-primary">
        <tr>
          <th>Tanggal</th>
          <th>Total</th>
          <th>Status</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        
      <?php
        $id = $_SESSION['customer_id'];
        $data = $conn->query("SELECT * FROM orders WHERE customer_id = $id ORDER BY id DESC");
        if ($data->num_rows > 0):
          while ($o = $data->fetch_assoc()):
        ?>
        <tr>
          <td><?= htmlspecialchars($o['order_date']) ?></td>
          <td>Rp <?= number_format($o['total']) ?></td>
          <td>
            <?php if ($o['status'] == 'pending'): ?>
              <span class="badge bg-warning text-dark"><?= htmlspecialchars($o['status']) ?></span>
            <?php elseif ($o['status'] == 'completed'): ?>
              <span class="badge bg-success"><?= htmlspecialchars($o['status']) ?></span>
            <?php else: ?>
              <span class="badge bg-secondary"><?= htmlspecialchars($o['status']) ?></span>
            <?php endif; ?>
          </td>
          <td>
            <a href="?f=home&m=order_items&id=<?= $o['id'] ?>" class="btn btn-sm btn-info">
              <i class="fas fa-eye"></i> Lihat
            </a>
          </td>
        </tr>
        <?php endwhile; else: ?>
        <tr>
          <td colspan="4" class="text-center text-muted">Belum ada pesanan.</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
?>

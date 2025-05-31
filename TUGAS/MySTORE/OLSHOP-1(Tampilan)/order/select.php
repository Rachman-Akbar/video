<div class="container-fluid px-3">
  <h1 class="">Pembayaran</h1>
  <div class="mb-3 mt-2">
    <input type="text" id="filterInput" class="form-control" placeholder="Cari Nama, ID Order, atau Status...">
  </div>

  <div class="table-responsive shadow p-3 rounded bg-white">
    <table class="table table-bordered table-hover shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>ID Order</th>
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Total</th>
          <th>Bayar</th>
          <th>Kembali</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#001</td>
          <td>Andi</td>
          <td>2025-04-01</td>
          <td>Rp 300.000</td>
          <td>Rp 300.000</td>
          <td>Rp 0</td>
          <td><span class="badge bg-success"><i class="fas fa-check-circle"></i> Sudah</span></td>
        </tr>
        <tr>
          <td>#002</td>
          <td>Budi</td>
          <td>2025-04-02</td>
          <td>Rp 150.000</td>
          <td>Rp 150.000</td>
          <td>Rp 0</td>
          <td><span class="badge bg-warning text-light"><i class="fas fa-hourglass-half"></i> Belum</span></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<script>
  document.getElementById('filterInput').addEventListener('keyup', function() {
    var filter = this.value.toLowerCase();
    var rows = document.querySelectorAll('table tbody tr');
    rows.forEach(function(row) {
      var text = row.textContent.toLowerCase();
      row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
    });
  });
</script>


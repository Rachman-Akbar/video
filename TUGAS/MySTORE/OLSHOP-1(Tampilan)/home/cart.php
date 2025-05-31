<div class="container mb-5">
  <table class="table table-bordered mt-4">
    <thead class="table-dark text-center">
      <tr>
        <th><input type="checkbox" /></th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="text-center"><input type="checkbox" /></td>
        <td>Tas</td>
        <td>Rp. 100.000</td>
        <td>2</td>
        <td>Rp. 200.000</td>
      </tr>
      <tr>
        <td class="text-center"><input type="checkbox" /></td>
        <td>Baju</td>
        <td>Rp. 50.000</td>
        <td>2</td>
        <td>Rp. 100.000</td>
      </tr>
      <tr>
        <td colspan="4" class="text-end"><h3>Total Keseluruhan</h3></td>
        <td><h3>Rp. 300.000</h3></td>
      </tr>
    </tbody>
  </table>
  <div class="d-flex gap-2">
    <a class="btn btn-success" href="?f=home&m=checkout">Checkout</a>
    <a class="btn btn-danger" href="index.php">Batal Checkout</a>
  </div>
</div>

<?php
  echo '
      <div class="container"> 
        <div class="align-items-center mb-3">
          <h3>Product Lainnya yang Mungkin Anda Suka</h3></h3>
        </div>
      </div>
  ';
  require_once 'home/product.php';
?>
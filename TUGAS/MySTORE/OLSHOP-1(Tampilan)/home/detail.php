<?php
// Contoh data diri pelanggan (bisa diganti dengan data dari session/database)
$nama = "Budi Santoso";
$alamat = "Jl. Melati No. 123, Jakarta";
$telepon = "08123456789";
$email = "budi@email.com";
// Contoh data produk yang dibeli (bisa diganti dengan data dari database)
$produk = [
    ["nama" => "Kaos Polos Hitam", "qty" => 2, "harga" => 75000],
    ["nama" => "Celana Jeans", "qty" => 1, "harga" => 150000],
    ["nama" => "Sepatu Sneakers", "qty" => 1, "harga" => 250000],
];
function rupiah($angka) {
    return "Rp" . number_format($angka,0,',','.');
}
$total = 0;
foreach ($produk as $item) {
    $total += $item["qty"] * $item["harga"];
}
?>

    <style>
        body { font-family: 'Roboto', Arial, sans-serif; background: #f8f9fa; }
        .struk-box { max-width: 600px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 32px; }
        .struk-title {align-items: center; font-weight: 700; font-size: 1.5rem; margin-bottom: 24px; }
        .table th, .table td { vertical-align: middle; }
        .total-row { font-weight: bold; background: #f1f3f4; }

    </style>

<div class="struk-box">
    <div class="mb-3">
        <h1 class="text-center struk-title">Struk Belanja</h1>
    </div>
    <hr>
    <h6 class="mb-2">Data Diri Pelanggan</h6>
    <table class="table table-borderless mb-4">
        <tr><th style="width:150px">Nama</th><td>: <?php echo $nama; ?></td></tr>
        <tr><th>Alamat</th><td>: <?php echo $alamat; ?></td></tr>
        <tr><th>No. Telepon</th><td>: <?php echo $telepon; ?></td></tr>
        <tr><th>Email</th><td>: <?php echo $email; ?></td></tr>
    </table>
    <h6 class="mb-2">Rincian Belanjaan</h6>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">No</th>
                    <th>Nama Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($produk as $i => $item): ?>
                <tr>
                    <td class="text-center"><?php echo $i+1; ?></td>
                    <td><?php echo $item["nama"]; ?></td>
                    <td class="text-center"><?php echo $item["qty"]; ?></td>
                    <td><?php echo rupiah($item["harga"]); ?></td>
                    <td><?php echo rupiah($item["qty"] * $item["harga"]); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4" class="text-end">Total</td>
                    <td><?php echo rupiah($total); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="text-center mt-4">
        <span class="text-muted">Terima kasih telah berbelanja di toko kami!</span>
    </div>
</div>
<script src="https://kit.fontawesome.com/1c2e0b3b7f.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

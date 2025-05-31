<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $where = "WHERE idkategori=$id";
        $id_param = "&id=".$id;
    } else {
        $where = "";
        $id_param = "";
    }

    $jumlahdata = $db->rowCOUNT("SELECT idmenu FROM tblmenu $where");
    $banyak = 3;
    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM tblmenu $where ORDER BY menu ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<div class="container my-4">
    <h3 class="text-primary fw-bold mb-4"><i class="fas fa-utensils me-2"></i>Menu</h3>

    <div class="row">
        <?php if (!empty($row)) { ?>
            <?php foreach ($row as $r): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm animate-card">
                        <img src="upload/<?php echo htmlspecialchars($r['gambar']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($r['menu']); ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($r['menu']); ?></h5>
                            <p class="card-text text-muted">Rp <?php echo number_format($r['harga'], 0, ',', '.'); ?></p>
                            <a href="?f=home&m=beli&id=<?php echo $r['idmenu']; ?>" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-cart-plus me-2"></i>Beli
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } else { ?>
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>No menu items available.
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Pagination -->
    <?php if ($halaman > 1): ?>
        <nav aria-label="Menu pagination" class="mt-4">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $halaman; $i++): ?>
                    <li class="page-item <?php echo ($i == $p) ? 'active' : ''; ?>">
                        <a class="page-link" href="?f=home&m=product&p=<?php echo $i . $id_param; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    <?php endif; ?>
</div>
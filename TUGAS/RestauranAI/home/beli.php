<?php 
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        unset($_SESSION['_'.$id]);
        header("Location:?f=home&m=beli");
    }
    if (isset($_GET['tambah'])) {
        $id = $_GET['tambah'];
        $_SESSION['_'.$id]++;
        header("Location:?f=home&m=beli");
    }
    if (isset($_GET['kurang'])) {
        $id = $_GET['kurang'];
        $_SESSION['_'.$id]--;
        if ($_SESSION['_'.$id] == 0) {
            unset($_SESSION['_'.$id]);
        }
        header("Location:?f=home&m=beli");
    }
    if (!isset($_SESSION['pelanggan'])) {
        header("Location: ?f=home&m=login");
    } else {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            isi($id);
            header("Location: ?f=home&m=beli");
        } else {
            keranjang();
        }
    }

    function isi($id) {
        if (isset($_SESSION['_'.$id])) {
            $_SESSION['_'.$id]++;
        } else {
            $_SESSION['_'.$id] = 1;
        }
    }

    function keranjang() {
        global $db;
        $total = 0;
?>
        <div class="container my-4">
            <h3 class="text-primary fw-bold mb-4"><i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja</h3>
            <?php if (!empty($_SESSION) && count(array_filter(array_keys($_SESSION), fn($key) => $key !== 'pelanggan' && $key !== 'idpelanggan' && $key !== 'user' && $key !== 'level' && $key !== 'iduser')) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($_SESSION as $key => $value) {
                                if ($key !== 'pelanggan' && $key !== 'idpelanggan' && $key !== 'user' && $key !== 'level' && $key !== 'iduser') {
                                    $id = substr($key, 1);
                                    $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
                                    $row = $db->getALL($sql);
                                    foreach ($row as $r) {
                            ?>
                                        <tr class="animate-row">
                                            <td><?php echo htmlspecialchars($r['menu']); ?></td>
                                            <td>Rp <?php echo number_format($r['harga'], 0, ',', '.'); ?></td>
                                            <td>
                                                <a href="?f=home&m=beli&tambah=<?php echo $r['idmenu']; ?>" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-plus"></i></a>
                                                <span class="mx-2"><?php echo $value; ?></span>
                                                <a href="?f=home&m=beli&kurang=<?php echo $r['idmenu']; ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-minus"></i></a>
                                            </td>
                                            <td>Rp <?php echo number_format($r['harga'] * $value, 0, ',', '.'); ?></td>
                                            <td>
                                                <a href="?f=home&m=beli&hapus=<?php echo $r['idmenu']; ?>" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                            <?php 
                                        $total += ($value * $r['harga']);
                                    }
                                }
                            }
                            ?>
                            <tr class="table-light">
                                <td colspan="4" class="fw-bold text-end">GRAND TOTAL:</td>
                                <td class="fw-bold">Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <a href="?f=home&m=checkout&total=<?php echo $total; ?>" class="btn btn-primary btn-lg mt-3">
                    <i class="fas fa-check-circle me-2"></i>Checkout
                </a>
            <?php else: ?>
                <div class="alert alert-warning text-center" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>Keranjang belanja Anda kosong.
                </div>
            <?php endif; ?>
        </div>
<?php
    }
?>
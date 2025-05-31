<?php 
    if (isset($_POST['opsi'])) {
        $opsi = $_POST['opsi'];
        $where = "WHERE idkategori = $opsi";
    } else {
        $opsi = 0;
        $where = "";
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
<div class="menu-container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold animate__animated animate__fadeIn"><i class="fas fa-book me-2"></i>Menu</h3>
        <a class="btn btn-primary btn-sm animate__animated animate__fadeInRight" href="?f=menu&m=insert" role="button">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>

    <div class="mb-4">
        <?php 
            $categories = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
        ?>
        <form action="" method="post">
            <select name="opsi" class="form-select form-select-sm w-auto animate__animated animate__fadeIn" onchange="this.form.submit()">
                <option value="0" <?php if ($opsi == 0) echo "selected"; ?>>Semua Kategori</option>
                <?php foreach ($categories as $r): ?>
                <option value="<?php echo $r['idkategori'] ?>" <?php if ($r['idkategori'] == $opsi) echo "selected"; ?>>
                    <?php echo $r['kategori'] ?>
                </option>
                <?php endforeach; ?>
            </select>
        </form>
    </div>

    <div class="row g-3">
        <?php if (!empty($row)) { ?>
        <?php foreach ($row as $r): ?>
        <div class="col-md-4">
            <div class="card menu-card animate__animated animate__fadeInUp" style="animation-delay: <?php echo ($no - $mulai - 1) * 0.1; ?>s;">
                <img src="../upload/<?php echo $r['gambar'] ?>" class="card-img-top" alt="<?php echo $r['menu'] ?>" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $r['menu'] ?></h5>
                    <p class="card-text mb-2">Harga: Rp <?php echo number_format($r['harga'], 0, ',', '.'); ?></p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="?f=menu&m=delete&id=<?php echo $r['idmenu'] ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                        <a href="?f=menu&m=update&id=<?php echo $r['idmenu'] ?>" class="btn btn-warning btn-sm text-white">
                            <i class="fas fa-edit"></i> Update
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } else { ?>
        <div class="col-12">
            <div class="card menu-card animate__animated animate__fadeIn">
                <div class="card-body text-center">
                    <p class="card-text">Tidak ada data</p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $halaman; $i++): ?>
                <li class="page-item <?php echo ($i == $p) ? 'active' : ''; ?> animate__animated animate__fadeIn" style="animation-delay: <?php echo ($i - 1) * 0.1; ?>s;">
                    <a class="page-link" href="?f=menu&m=select&p=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<style>
    .menu-container {
        font-family: 'Inter', system-ui, sans-serif;
    }
    .menu-container .menu-card {
        border: none;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .menu-container .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    .menu-container .card-img-top {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .menu-container .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
    }
    .menu-container .card-text {
        color: #555;
    }
    .menu-container .btn-primary {
        background: #667eea;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .menu-container .btn-primary:hover {
        background: #5a67d8;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .menu-container .btn-danger,
    .menu-container .btn-warning {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .menu-container .btn-danger:hover,
    .menu-container .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .menu-container .form-select {
        border-radius: 8px;
        padding: 0.5rem;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #e0e7ff;
        transition: all 0.3s ease;
    }
    .menu-container .form-select:hover {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .menu-container .page-link {
        border-radius: 5px;
        margin: 0 2px;
        color: #667eea;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.2s ease;
    }
    .menu-container .page-item.active .page-link {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }
    .menu-container .page-link:hover {
        background: #e0e7ff;
        color: #5a67d8;
        transform: scale(1.1);
    }
    @media (max-width: 576px) {
        .menu-container .menu-card {
            font-size: 0.85rem;
        }
        .menu-container .card-title {
            font-size: 1.1rem;
        }
        .menu-container .btn-sm {
            font-size: 0.75rem;
            padding: 0.35rem 0.5rem;
        }
        .menu-container .h3 {
            font-size: 1.5rem;
        }
        .menu-container .form-select {
            font-size: 0.85rem;
        }
        .menu-container .card-img-top {
            height: 120px;
        }
    }
</style>

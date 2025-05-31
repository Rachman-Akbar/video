<?php 
    $jumlahdata = $db->rowCOUNT("SELECT idkategori FROM tblkategori");
    $banyak = 4;

    $halaman = ceil($jumlahdata / $banyak);

    if (isset($_GET['p'])) {
        $p = $_GET['p'];
        $mulai = ($p * $banyak) - $banyak;
    } else {
        $mulai = 0;
    }

    $sql = "SELECT * FROM tblkategori ORDER BY kategori ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold"><i class="fas fa-tags me-2"></i>Kategori</h3>
        <a class="btn btn-primary btn-sm" href="?f=kategori&m=insert" role="button">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered bg-white rounded shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th scope="col" style="width: 10%;">No</th>
                    <th scope="col">Kategori</th>
                    <th scope="col" style="width: 15%;">Delete</th>
                    <th scope="col" style="width: 15%;">Update</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($row)) { ?>
                <?php foreach ($row as $r): ?>
                <tr class="table-row animate__animated animate__fadeInUp" style="animation-delay: <?php echo ($no - $mulai - 1) * 0.1; ?>s;">
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $r['kategori'] ?></td>
                    <td>
                        <a href="?f=kategori&m=delete&id=<?php echo $r['idkategori'] ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt text-white"></i> Delete
                        </a>
                    </td>
                    <td>
                        <a href="?f=kategori&m=update&id=<?php echo $r['idkategori'] ?>" class="btn btn-warning btn-sm text-white">
                            <i class="fas fa-edit text-white"></i> Update
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php } else { ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $halaman; $i++): ?>
                <li class="page-item <?php echo ($i == $p) ? 'active' : ''; ?>">
                    <a class="page-link" href="?f=kategori&m=select&p=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<style>
    .table {
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .table th, .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    .table-primary {
        background: #667eea !important;
        color: white !important;
    }
    .table-row:hover {
        background: rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
        transition: all 0.2s ease;
    }
    .btn-primary {
        background: #667eea;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-primary:hover {
        background: #5a67d8;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .btn-danger, .btn-warning {
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-danger:hover, .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .page-link {
        border-radius: 5px;
        margin: 0 2px;
        color: #667eea;
        transition: all 0.2s ease;
    }
    .page-item.active .page-link {
        background: #667eea;
        border-color: #667eea;
        color: white;
    }
    .page-link:hover {
        background: #e0e7ff;
        color: #5a67d8;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 576px) {
        .table {
            font-size: 0.9rem;
        }
        .btn-sm {
            font-size: 0.8rem;
            padding: 0.4rem 0.6rem;
        }
    }
</style>

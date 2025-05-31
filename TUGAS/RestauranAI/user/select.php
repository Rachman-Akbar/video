<?php 
    $jumlahdata = $db->rowCOUNT("SELECT iduser FROM tbluser");
    $banyak = 4;
    $halaman = ceil($jumlahdata / $banyak);

    $p = isset($_GET['p']) ? $_GET['p'] : 1;
    $mulai = ($p * $banyak) - $banyak;

    $sql = "SELECT * FROM tbluser ORDER BY user ASC LIMIT $mulai, $banyak";
    $row = $db->getALL($sql);
    $no = 1 + $mulai;
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold"><i class="fas fa-user me-2"></i>User</h3>
        <a class="btn btn-primary btn-sm" href="?f=user&m=insert">
            <i class="fas fa-plus me-1"></i> Tambah Data
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered bg-white rounded shadow-sm">
            <thead class="table-primary">
                <tr>
                    <th style="width: 5%;">No</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Delete</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($row)) : ?>
                    <?php foreach ($row as $r) : ?>
                        <?php 
                            $isAktif = $r['aktif'] == 1;
                            $status = $isAktif ? 'Aktif' : 'Banned';
                            $statusClass = $isAktif ? 'btn-success' : 'btn-secondary';
                            $statusIcon = $isAktif ? 'fa-check-circle' : 'fa-ban';
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r['user'] ?></td>
                            <td><?= $r['email'] ?></td>
                            <td><?= $r['level'] ?></td>
                            <td>
                                <a href="?f=user&m=update&id=<?= $r['iduser'] ?>" 
                                    class="btn btn-sm <?= $statusClass ?>  justify-content-center gap-1">
                                    <i class="fas <?= $statusIcon ?>"></i> <?= $status ?>
                                </a>
                            </td>
                            <td>
                                <a href="?f=user&m=delete&id=<?= $r['iduser'] ?>" 
                                    class="btn btn-danger btn-sm justify-content-center gap-1">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" class="mt-3">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $halaman; $i++) : ?>
                <li class="page-item <?= ($i == $p) ? 'active' : '' ?>">
                    <a class="page-link" href="?f=user&m=select&p=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<style>
    .table th, .table td {
        vertical-align: middle;
        padding: 0.75rem;
    }
    .table-primary {
        background-color: #667eea;
        color: white;
    }
    .btn-sm {
        font-size: 0.85rem;
        padding: 0.4rem 0.5rem;
    }
    .btn-primary:hover,
    .btn-danger:hover,
    .btn-success:hover,
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease;
    }
    .page-link {
        color: #667eea;
    }
    .page-item.active .page-link {
        background-color: #667eea;
        border-color: #667eea;
        color: white;
    }
</style>

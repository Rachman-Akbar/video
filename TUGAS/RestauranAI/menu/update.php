<h3 class="mb-4">Update Menu</h3>

<?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tblmenu WHERE idmenu = $id";
        $item = $db->getITEM($sql);
        $idkategori = $item['idkategori'];
    }

    $row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
?>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="row g-3">

        <!-- Kategori -->
        <div class="col-md-6">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="idkategori" id="kategori" class="form-select" required>
                <?php foreach($row as $r): ?>
                    <option value="<?php echo $r['idkategori'] ?>" 
                        <?php if ($idkategori == $r['idkategori']) echo "selected"; ?>>
                        <?php echo $r['kategori'] ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Nama Menu -->
        <div class="col-md-6">
            <label for="menu" class="form-label">Nama Menu</label>
            <input type="text" name="menu" id="menu" value="<?php echo $item['menu'] ?>" class="form-control" required>
        </div>

        <!-- Harga -->
        <div class="col-md-6">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" value="<?php echo $item['harga'] ?>" class="form-control" required>
        </div>

        <!-- Gambar -->
        <div class="col-md-6">
            <label for="gambar" class="form-label">Gambar (Opsional)</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
            <small class="text-muted">Gambar saat ini: <?php echo $item['gambar'] ?></small>
        </div>

        <!-- Tombol Simpan -->
        <div class="col-12">
            <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan Perubahan</button>
        </div>

    </form>
</div>

<?php 
    if (isset($_POST['simpan'])) {
        $idkategori = $_POST['idkategori'];
        $menu = $_POST['menu'];
        $harga = $_POST['harga'];
        $gambar = $item['gambar'];
        $temp = $_FILES['gambar']['tmp_name'];

        // Jika user upload gambar baru
        if (!empty($temp)) {
            $gambar = $_FILES['gambar']['name'];
            move_uploaded_file($temp, '../upload/' . $gambar);
        }

        $sql = "UPDATE tblmenu 
                SET idkategori = $idkategori, menu = '$menu', gambar = '$gambar', harga = '$harga'  
                WHERE idmenu = $id";

        $db->runSQL($sql);
        header("Location: ?f=menu&m=select");
        exit;
    }
?>

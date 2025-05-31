<?php 
    $row = $db->getALL("SELECT * FROM tblkategori ORDER BY kategori ASC");
?>

<h3 class="mb-4">Insert Menu</h3>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="row g-3">
        
        <!-- Kategori -->
        <div class="col-md-6">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="idkategori" id="kategori" class="form-select" required>
                <?php foreach($row as $r): ?>
                    <option value="<?php echo $r['idkategori'] ?>"><?php echo $r['kategori'] ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Nama Menu -->
        <div class="col-md-6">
            <label for="menu" class="form-label">Nama Menu</label>
            <input type="text" name="menu" id="menu" class="form-control" placeholder="Isi nama menu" required>
        </div>

        <!-- Harga -->
        <div class="col-md-6">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" placeholder="Isi harga" required>
        </div>

        <!-- Gambar -->
        <div class="col-md-6">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
        </div>

        <!-- Tombol Submit -->
        <div class="col-12">
            <button type="submit" name="simpan" class="btn btn-primary mt-3">Simpan</button>
        </div>

    </form>
</div>

<?php 
    if (isset($_POST['simpan'])) {
        $idkategori = $_POST['idkategori'];
        $menu =  $_POST['menu'];
        $harga = $_POST['harga'];
        $gambar = $_FILES['gambar']['name'];
        $temp = $_FILES['gambar']['tmp_name'];

        if (empty($gambar)) {
            echo "<div class='alert alert-danger mt-3'>Gambar belum dipilih!</div>";
        } else {
            $sql = "INSERT INTO tblmenu VALUES  ('',$idkategori,'$menu','$gambar',$harga)";
            move_uploaded_file($temp,'../upload/'.$gambar);
            $db->runSQL($sql);
            header("Location: ?f=menu&m=select");
            exit;
        }
    }
?>

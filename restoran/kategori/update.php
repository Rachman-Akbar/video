
<?php

   require_once "../function.php";

   $sql = "SELECT * FROM tblkategori WHERE idkategori = $id";
   $result = mysqli_query($koneksi, $sql);

   $row = mysqli_fetch_assoc($result);

   // $kategori = 'jelly bean';
   // $id = 16;
   // $sql = "UPDATE tblkategori SET kategori = '$kategori' WHERE idkategori= $id ";

   // $result = mysqli_query($koneksi, $sql);

   // echo $sql;

?>
<form action="" method="post">
   Kategori:
   <input type="text" name="kategori" value="<?php echo $row['kategori']?>">
   <input type="submit" name="simpan" value="simpan">
</form>

<?php

   if (isset($_POST['simpan'])) {
      $kategori = $_POST['kategori'];

      $sql = "UPDATE tblkategori SET kategori = '$kategori' WHERE idkategori= $id ";

      $result = mysqli_query($koneksi, $sql);

      header("location: http://localhost/phpsmk/restoran/kategori/select.php");
   }

?>
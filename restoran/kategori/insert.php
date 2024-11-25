<form method="post" action="">
   kategori :
   <input type="text" name="kategori">
   <br>
   <input type="submit" name="simpan" value="simpan">
</form>
<?php

   require_once "../function.php";

   if (isset($_POST['simpan'])) {
      $kategori = $_POST['kategori'];
      $sql = "INSERT INTO tblkategori VALUES ('','$kategori')";
      $result = mysqli_query($koneksi, $sql);
      echo "data sudah disimpan";

      header("location: http://localhost/phpsmk/restoran/kategori/select.php");
   }

   

?>
<?php

   require_once "../function.php";

   

   $sql = "DELETE FROM tblkategori WHERE idkategori = $id";

   $result = mysqli_query($koneksi, $sql);
   
   header("lcation: http://localhost/phpsmk/restoran/kategori/select.php");

?>
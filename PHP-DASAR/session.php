<nav>
   <ul>
      <li><a href="?menu=isi">Isi</a></li>
      <li><a href="?menu=hapus">Hapus</a></li>
      <li><a href="?menu=destroy">Destroy</a></li>
   </ul>
</nav>
<?php
   session_start ();

   var_dump ($_SESSION);
   echo "<br>";

   if (isset($_GET["menu"])){
      $menu = $_GET["menu"];

      echo $menu;

      switch ($menu){
         case "isi":
            isiSession();
            break;
         case "hapus":
            unset ($_SESSION["user"]);
            break;
         case "destroy":
            session_destroy();
            break;
      }
   }
   function isiSession(){
      $_SESSION["user"] = "joni";
      $_SESSION["nama"] = "joni rambo";
      $_SESSION["alamat"] = "Sidoarjo";
   }
?>
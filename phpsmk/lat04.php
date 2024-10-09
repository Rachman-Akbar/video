<?php
   //Operator Mtk
   $a = 2;
   $b = 2;

   $c= $a + $b.'<br>';
   echo $c;

   $c= $a - $b.'<br>';
   echo $c;

   $c= $a * $b.'<br>';
   echo $c;

   $c= $a / $b;
   echo floor($c).'<br>';

   $c = $a % $b;
   echo $c.'<br>';

   //operator logika
   $c = $a < $b;
   echo $c;

   $c = $a > $b;
   echo $c;

   $c = $a == $b;
   echo $c;

   $c = $a != $b;
   echo $c.'<br>';

   //Operator Increment
   $a++;
   echo $a.'<br>';

   //Operator String
   $kata = 'Sura';
   $kota = 'baya';
   $hasil = $kata.$kota;
   $hasil .=' Kota Pahlawan';
   echo $hasil;
?>

<?php
$conn = new mysqli("localhost", "root", "", "mystore");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
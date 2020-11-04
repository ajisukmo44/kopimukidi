<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$id   = mysqli_real_escape_string($conn, $_GET['id_produk']);

$sql = "DELETE FROM tb_produk WHERE id_produk = '$id' ";

if (mysqli_query($conn, $sql)) {
    echo "<script>location.replace('../../dataproduk.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

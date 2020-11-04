<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$id   = mysqli_real_escape_string($conn, $_GET['id_pembelian']);

$sql = "DELETE FROM tb_pembelian_bahanbaku WHERE id_pembelian = '$id' ";

if (mysqli_query($conn, $sql)) {
    echo "<script>location.replace('../../datapembelian.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

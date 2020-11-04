<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$id   = mysqli_real_escape_string($conn, $_GET['id_pengiriman']);

$sql = "DELETE FROM tb_pengiriman WHERE id_pengiriman = '$id' ";

if (mysqli_query($conn, $sql)) {
    echo "<script>location.replace('../../datapengiriman.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

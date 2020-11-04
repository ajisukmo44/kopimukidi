<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$id   = mysqli_real_escape_string($conn, $_GET['id']);

$sql = "DELETE FROM tb_update_stok WHERE id_updatestok = '$id' ";

if (mysqli_query($conn, $sql)) {
    echo "<script>location.replace('../../dataupdatestok.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

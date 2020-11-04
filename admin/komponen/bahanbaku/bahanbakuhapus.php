<?php session_start();
include '../../koneksi.php';                  // Panggil koneksi ke database

$idbb   = mysqli_real_escape_string($conn, $_GET['id_bahanbaku']);

$sql = "DELETE FROM tb_bahanbaku WHERE id_bahanbaku = '$idbb' ";
if (mysqli_query($conn, $sql)) {
    echo "<script>location.replace('../../databahanbaku.php')</script>";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

<?php session_start();
include '../koneksi.php';

$id   = mysqli_real_escape_string($conn, $_GET['id']);

if (isset($id)) {

    // Proses insert data dari form ke db
    $sql = "UPDATE tb_pembelian_bahanbaku SET status_pembelian = 3 WHERE id_pembelian= '$id'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id',3, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Data Berhasil Diupdate! Klik ok untuk melanjutkan');location.replace('../datapembelian.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

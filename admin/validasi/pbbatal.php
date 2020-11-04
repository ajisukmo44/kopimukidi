<?php session_start();
include '../koneksi.php';

$id   = mysqli_real_escape_string($conn, $_GET['id']);

if (isset($id)) {

    // Proses insert data dari form ke db
    $sql = "UPDATE tb_pembelian_bahanbaku SET status_pembelian = 0 WHERE id_pembelian= '$id'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id',0, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Pembatalan berhasil! Klik ok untuk melanjutkan');location.replace('../datapembelian.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

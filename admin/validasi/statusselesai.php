<?php session_start();
include '../koneksi.php';                    // Panggil koneksi ke database

$id_pemesanan = mysqli_real_escape_string($conn, $_GET['id_pemesanan']);

if (isset($id_pemesanan)) {
    $sql = "UPDATE tb_pemesanan SET status_pemesanan = 5 WHERE id_pemesanan = '$id_pemesanan' ";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Status Berhasil diupdate! Klik ok untuk melanjutkan');location.replace('../datapemesanan.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

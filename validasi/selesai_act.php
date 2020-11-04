<?php session_start();
include '../koneksi.php';                    // Panggil koneksi ke database

$id  = mysqli_real_escape_string($koneksi, $_GET['id']);

if (isset($id)) {
    $sql = "UPDATE tb_pemesanan SET status_pemesanan = 5 WHERE id_pemesanan = '$id'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id',5, now())";

    if (mysqli_multi_query($koneksi, $sql)) {
        echo "<script>alert('Status Berhasil di Update! Klik ok untuk melanjutkan');location.replace('../datatransaksi.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

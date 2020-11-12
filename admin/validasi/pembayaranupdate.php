<?php session_start();
include '../koneksi.php';                    // Panggil koneksi ke database

$idt = mysqli_real_escape_string($conn, $_GET['id_pemesanan']);

if (isset($idt)) {
    $sql = "UPDATE tb_pemesanan  SET status_pemesanan = 3 WHERE id_pemesanan = '$idt'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$idt', 3, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../datapemesanan.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

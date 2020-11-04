<?php session_start();
include '../koneksi.php';                    // Panggil koneksi ke database

$idb = mysqli_real_escape_string($conn, $_GET['id_pembayaran']);
$idt = mysqli_real_escape_string($conn, $_GET['id_pemesanan']);

if (isset($idb)) {
    $sql = "UPDATE tb_pemesanan a, tb_pembayaran b SET a.status_pemesanan = 3, b.status_pembayaran = 2 WHERE a.id_pemesanan = '$idt' AND b.id_pembayaran = '$idb'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$idt', 3, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Validasi data berhasil! Klik ok untuk melanjutkan');location.replace('../datapembayaran.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

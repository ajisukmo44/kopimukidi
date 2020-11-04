<?php session_start();
include '../koneksi.php';

$id   = mysqli_real_escape_string($conn, $_GET['id']);
$idb   = mysqli_real_escape_string($conn, $_GET['idb']);
$jumlah   = mysqli_real_escape_string($conn, $_GET['jml']);

if (isset($id)) {

    $isi = mysqli_query($conn, "SELECT * FROM tb_bahanbaku WHERE id_bahanbaku='$idb'");
    $i = mysqli_fetch_assoc($isi);
    $stoklama = $i['stok_bahanbaku'];
    $stokbaru = $stoklama + $jumlah;

    // Proses insert data dari form ke db
    $sql = "UPDATE tb_pembelian_bahanbaku SET status_pembelian = 5 WHERE id_pembelian= '$id'; ";

    $sql .= "UPDATE tb_bahanbaku SET stok_bahanbaku = $stokbaru WHERE id_bahanbaku = '$idb'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id',5, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../datapembelian.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

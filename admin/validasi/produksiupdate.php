<?php session_start();
include '../koneksi.php';                    // Panggil koneksi ke database

$idp = mysqli_real_escape_string($conn, $_GET['id']);
$idb = mysqli_real_escape_string($conn, $_GET['idb']);
$jb = mysqli_real_escape_string($conn, $_GET['jb']);


if (isset($idp)) {

    $isi = mysqli_query($conn, "SELECT * FROM tb_bahanbaku WHERE id_bahanbaku='$idb'");
    $i = mysqli_fetch_assoc($isi);
    $stoklama = $i['stok_bahanbaku'];
    $stokbaru = $stoklama - $jb;

    $sql = "UPDATE tb_produksi a, tb_bahanbaku b SET a.status_produksi = 2, b.stok_bahanbaku = $stokbaru  WHERE a.id_produksi= '$idp' AND b.id_bahanbaku = '$idb';";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
VALUES ('','$idp', 2, now())";

    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../permintaanproduksi.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

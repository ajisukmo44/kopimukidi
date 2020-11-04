<?php session_start();
include '../koneksi.php';

if (isset($_POST['submit'])) {

    $id   = mysqli_real_escape_string($conn, $_POST['id']);
    $idp   = mysqli_real_escape_string($conn, $_POST['idp']);
    $stok   = mysqli_real_escape_string($conn, $_POST['stok']);

    $isi = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk='$idp'");
    $i = mysqli_fetch_assoc($isi);
    $stoklama = $i['stok'];
    $stokbaru = $stoklama + $stok;

    // Proses insert data dari form ke db
    $sql = "UPDATE tb_produksi SET status_produksi = 3, jumlah_stok_baru = $stok WHERE id_produksi = '$id'; ";

    $sql .= "UPDATE tb_produk SET stok = $stokbaru WHERE id_produk = '$idp'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id', 3, now())";

    if (mysqli_multi_query($conn, $sql)) {

        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../permintaanproduksi.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

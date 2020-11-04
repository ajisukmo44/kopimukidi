<?php session_start();
include '../../koneksi.php';
include '../../fungsi/cek_session.php';

if (isset($_POST['simpan'])) {

    $produk   = mysqli_real_escape_string($conn, $_POST['id_produk']);
    $jumlah   = mysqli_real_escape_string($conn, $_POST['jumlah']);

    $isi      = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk='$produk'");
    $i        = mysqli_fetch_assoc($isi);
    $stokbaru = $i['stok'] + $jumlah;

    mysqli_query($conn, "UPDATE tb_produk SET stok='$stokbaru' WHERE id_produk='$produk'");

    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_update_stok ( id_updatestok, id_produk, jumlah, tanggal, id_user)
    VALUES ('','$produk','$jumlah',NOW(),'$sesen_id_user');";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../dataupdatestok.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

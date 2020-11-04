<?php session_start();
include '../../koneksi.php';
include '../../fungsi/cek_session.php';

if (isset($_POST['simpan'])) {

    $id   = mysqli_real_escape_string($conn, $_POST['id_penjualan']);
    $no_resi   = mysqli_real_escape_string($conn, $_POST['no_resi']);
    $tanggal   = mysqli_real_escape_string($conn, $_POST['tanggal_kirim']);



    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_pengiriman ( id_pengiriman, id_penjualan, no_resi, tanggal_kirim, id_user)
    VALUES ('','$id','$no_resi','$tanggal','$sesen_id_user');";
    $sql .= "UPDATE tb_penjualan SET status_transaksi = 4 WHERE id_penjualan = '$id' ";


    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapengiriman.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

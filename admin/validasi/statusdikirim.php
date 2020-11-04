<?php session_start();
include '../koneksi.php';

if (isset($_POST['submit'])) {

    $id             = mysqli_real_escape_string($conn, $_POST['id_pemesanan']);
    $noresi         = mysqli_real_escape_string($conn, $_POST['no_resi']);
    $tanggal        = mysqli_real_escape_string($conn, $_POST['tanggal_kirim']);
    $namapengirim   = mysqli_real_escape_string($conn, $_POST['nama_pengirim']);


    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_pengiriman ( id_pengiriman, id_pemesanan, no_resi, tanggal_kirim, nama_pengirim)
    VALUES ('','$id','$noresi','$tanggal','$namapengirim');";

    $sql .= "UPDATE tb_pemesanan SET status_pemesanan = 4 WHERE id_pemesanan = '$id'; ";

    $sql .= "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
    VALUES ('','$id', 4, now())";


    if (mysqli_multi_query($conn, $sql)) {
        echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../datapengiriman.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if (isset($_POST['simpan'])) {
    $id    = mysqli_real_escape_string($conn, $_POST['id_pengiriman']);
    $nr    = mysqli_real_escape_string($conn, $_POST['no_resi']);
    $tgl    = mysqli_real_escape_string($conn, $_POST['tanggal_kirim']);
    $np    = mysqli_real_escape_string($conn, $_POST['nama_pengirim']);

    // Proses update data dari form ke db

    $sql = "UPDATE tb_pengiriman SET id_pengiriman  = '$id',
                                     no_resi        = '$nr',
                                     tanggal_kirim  = '$tgl',
                                     nama_pengirim  = '$np'
                               WHERE id_pengiriman  = '$id' ";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapengiriman.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

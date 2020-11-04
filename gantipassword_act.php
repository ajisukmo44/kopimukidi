<?php session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {

    $id         = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
    $password   = md5($_POST['password']);

    // Proses update data dari form ke db

    $sql = "UPDATE tb_pelanggan SET password  = '$password'
                             WHERE  id_pelanggan    = '$id' ";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Password berhasil diubah!');location.replace('pelanggan.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if (isset($_POST['simpan'])) {
    $id_bahanbaku    = mysqli_real_escape_string($conn, $_POST['id_bahanbaku']);
    $nama    = mysqli_real_escape_string($conn, $_POST['nama_bahanbaku']);
    $stok    = mysqli_real_escape_string($conn, $_POST['stok_bahanbaku']);

    // Proses update data dari form ke db

    $sql = "UPDATE tb_bahanbaku SET id_bahanbaku  = '$id_bahanbaku',
                                nama_bahanbaku    = '$nama',
                                stok_bahanbaku    = '$stok'
                          WHERE id_bahanbaku      = '$id_bahanbaku' ";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../databahanbaku.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

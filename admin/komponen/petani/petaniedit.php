<?php session_start();
include '../../koneksi.php';                    // Panggil koneksi ke database

if (isset($_POST['simpan'])) {



    $idpetani    = mysqli_real_escape_string($conn, $_POST['id_petani']);
    $nama       = mysqli_real_escape_string($conn, $_POST['nama_petani']);
    $nohp       = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $alamat      = mysqli_real_escape_string($conn, $_POST['alamat']);
    $bergabung   = mysqli_real_escape_string($conn, $_POST['bergabung']);
    $username   = mysqli_real_escape_string($conn, $_POST['username']);

    // Proses update data dari form ke db

    $sql = "UPDATE tb_petani SET id_petani      = '$idpetani',
                                nama_petani     = '$nama',
                                no_hp           = '$nohp',
                                alamat          = '$alamat',
                                username        = '$username'
                          WHERE id_petani       = '$idpetani' ";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Update data berhasil! Klik ok untuk melanjutkan');location.replace('../../datapetani.php')</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

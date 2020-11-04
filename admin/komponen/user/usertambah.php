<?php session_start();
include '../../koneksi.php';

if (isset($_POST['simpan'])) {

  $nama       = mysqli_real_escape_string($conn, $_POST['nama_user']);
  $jabatan    = mysqli_real_escape_string($conn, $_POST['jabatan']);
  $username   = mysqli_real_escape_string($conn, $_POST['username']);
  $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $cekdata    = "SELECT username FROM tb_user WHERE username = '$username' ";
  $ada        =  mysqli_query($conn, $cekdata);
  if (mysqli_num_rows($ada) > 0) {
    echo "<script>alert('ERROR: Username telah terdaftar, silahkan pakai Username lain!');history.go(-1)</script>";
  } else {
    // Proses insert data dari form ke db
    $sql = "INSERT INTO tb_user ( nama_user,
                                jabatan,
                                username,
                                password)
                        VALUES (
                                '$nama',
                                '$jabatan',
                                '$username',
                                '$password')";

    if (mysqli_query($conn, $sql)) {
      echo "<script>alert('Insert data berhasil! Klik ok untuk melanjutkan');location.replace('../../datauser.php')</script>";
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
  }
} else {
  echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

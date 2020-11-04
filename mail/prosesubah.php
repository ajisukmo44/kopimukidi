<?php session_start();
include '../admin/koneksi.php';
// Panggil koneksi ke database
$email = $_POST['email'];
$password = md5($_POST['password']);

if (isset($email)) {
  $sql = "UPDATE tb_pelanggan SET password = '$password' WHERE email = '$email'; ";
  if (mysqli_multi_query($conn, $sql)) {
    echo "<script>alert('Password Berhasil Di ubah! Silahkan Login!');location.replace('../login.php')</script>";
  } else {
    echo "<script>alert('Email anda Tidak Terdaftar!');location.replace('../login.php')</script>";
  }
} else {
  echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

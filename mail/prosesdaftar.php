<?php session_start();
include '../admin/koneksi.php';
// Panggil koneksi ke database
$email = $_GET['email'];

if (isset($email)) {
  $sql = "UPDATE tb_pelanggan SET status_pelanggan = 1 WHERE email = '$email'; ";

  if (mysqli_multi_query($conn, $sql)) {
    header("location:../login.php?alert=tervalidasi");
  }
} else {
  echo "<script>alert('Gak boleh tembak langsung ya, pencet dulu tombol uploadnya!');history.go(-1)</script>";
}

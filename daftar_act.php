<?php
include 'koneksi.php';

$id  = $_POST['id_pelanggan'];
$nama  = $_POST['nama_pelanggan'];
$email = $_POST['email'];
$nohp = $_POST['hp'];
$alamat = $_POST['alamat'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$cek_email = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE email='$email'");
$cek_user = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE username='$username'");

if (mysqli_num_rows($cek_email) > 0) {
	header("location:daftar.php?alert=duplikatemail");
} else if (mysqli_num_rows($cek_user) > 0) {
	header("location:daftar.php?alert=duplikatusername");
} else {
	mysqli_query($koneksi, "INSERT INTO tb_pelanggan values ('$id','$username','$password','$nama','$email','$nohp','$alamat',0)");
	header("location:mail/send_daftar.php?id=$id&email=$email");
}

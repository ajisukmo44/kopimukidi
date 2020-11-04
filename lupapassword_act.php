<?php
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$email = $_POST['email'];

$lupapassword = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE email='$email");
$cek = mysqli_num_rows($lupapassword);
$data = mysqli_fetch_assoc($lupapassword);

if (mysqli_num_rows($cek) === "") {
	header("location:lupapassword.php?alert=gakterdaftar");
} else {
	header("location:lupapassword.php?alert=berhasil");
}

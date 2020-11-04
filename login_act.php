<?php
// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($login);
$data = mysqli_fetch_assoc($login);

if (mysqli_num_rows($login) == 0) {
	header("location:login.php?alert=gagal");
} elseif ($data['status_pelanggan'] == '2') {
	header("location:login.php?alert=gagalblokir");
} elseif ($data['status_pelanggan'] == '0') {
	header("location:login.php?alert=gagalvalidasi");
} elseif ($data['status_pelanggan'] == '1') {
	session_start();

	// hapus session yg lain, agar tidak bentrok dengan session pelanggan
	unset($_SESSION['id_pelanggan']);
	unset($_SESSION['nama_pelanggan']);
	unset($_SESSION['username']);
	unset($_SESSION['status']);

	// buat session pelanggan
	$_SESSION['id_pelanggan'] = $data['id_pelanggan'];
	$_SESSION['nama_pelanggan'] = $data['nama_pelanggan'];
	$_SESSION['username'] = $data['username'];
	$_SESSION['alamat'] = $data['alamat'];
	$_SESSION['email'] = $data['email'];
	$_SESSION['no_hp'] = $data['no_hp'];
	$_SESSION['status'] = "login";

	header("location:index.php");
} else {
	header("location:login.php?alert=gagal");
}

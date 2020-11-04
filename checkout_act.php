<?php
include 'koneksi.php';

session_start();
$query     = "SELECT max(id_pemesanan)AS kode FROM tb_pemesanan";
$cari_kd   = mysqli_query($koneksi, $query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'], 4, 7); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah = $kode + 1; //kode yang sudah di pecah di tambah 1
if ($tambah < 10) { //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
	$id_trn = "PSN-00" . $tambah;
} else {
	$id_trn = "PSN-0" . $tambah;
}

$id_plg = $_SESSION['id_pelanggan'];
$alamat = $_SESSION['alamat'];

$tanggal = date('Y-m-d');
$provinsi = $_POST['provinsi2'];
$kabupaten = $_POST['kabupaten2'];

$alamat1 = $alamat . ',' . $kabupaten . ',' . $provinsi;

$kurir = $_POST['kurir'] . " - " . $_POST['service'];
$berat = $_POST['berat'];

$ongkir = $_POST['ongkir2'];

$total_bayar = $_POST['total_bayar'] + $ongkir;

mysqli_query($koneksi, "INSERT INTO tb_pemesanan VALUES('$id_trn','$tanggal','$id_plg','$berat','$kurir','$ongkir','$total_bayar','1','')") or die(mysqli_error($koneksi));

$last_id = mysqli_insert_id($koneksi);

// transaksi

$jumlah_isi_keranjang = count($_SESSION['keranjang']);

for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
	$id_produk = $_SESSION['keranjang'][$a]['produk'];
	$jml = $_SESSION['keranjang'][$a]['jumlah'];

	$isi = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
	$i = mysqli_fetch_assoc($isi);

	$produk = $i['id_produk'];
	$stok = $i['stok'];

	$jumlah = $_SESSION['keranjang'][$a]['jumlah'];
	$harga = $i['harga'];

	$stokbaru = $stok - $jumlah;

	mysqli_query($koneksi, "INSERT INTO tb_detail_pemesanan VALUES('$id_trn','$produk','$harga','$jumlah');");

	mysqli_query($koneksi, "UPDATE tb_produk SET stok='$stokbaru' WHERE id_produk='$produk';");

	mysqli_query($koneksi, "INSERT INTO tb_riwayat_status VALUES ('','$id_trn', 1 , now())");

	unset($_SESSION['keranjang'][$a]);
}

// payment gateaway

header("location:mail/send.php?id=$id_trn");

// header("location:invoicetransaksi.php?id=$id_trn");

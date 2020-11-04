<?php
session_start();
include 'koneksi.php';

$query     = "SELECT max(id_pelanggan) AS kode FROM tb_pelanggan";
$cari_kd   = mysqli_query($koneksi, $query);
$tm_cari   = mysqli_fetch_array($cari_kd);
$kode      = substr($tm_cari['kode'], 0, 1); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 
$tambah = $kode + 1; //kode yang sudah di pecah di tambah 1
if ($tambah < 10) { //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka
	$id_plg = "0" . $tambah;
} else {
	$id_plg = "" . $tambah;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Kopi Mukidi</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="kopi/css/bootstrap.min.css">
	<link rel="stylesheet" href="kopi/css/style.css">
	<link type="text/css" rel="stylesheet" href="frontend/css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="frontend/css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="frontend/css/style8.css" />
	<link href="gambar/logo1.ico" rel="shortcut icon" />
</head>


<body>
	<header class="site-navbar py-4 bg-light site-navbar-target" role="banner">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-11 col-xl-4">
					<a href="index.php"> <img src="gambar/logo1.png" style="width: 200px;" alt=""></a>
				</div>
				<div class="col-12 col-md-8 d-none d-xl-block">
					<nav class="site-navigation position-relative text-right" role="navigation">
						<ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
							<a href="login.php" class="nav-link">Login?</a>
						</ul>
					</nav>
				</div>
				<div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
				</div>
			</div>
		</div>
	</header>


	<div class="section" style="background-color: #D5B487;">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row col-md-6 mt-5 mb-5 mr-5">
				<div class="col-md-11 mt-5 mb-5">
					<div class="order-summary clearfix">
						<div class="row">
							<img src="" alt="">
						</div>
					</div>
				</div>
			</div>

			<div class="row bg-white col-md-6  mt-3 mb-5" style="border-radius: 2%;">
				<div class="col-md-11 mt-5 mb-5 ml-4">
					<div class="order-summary clearfix">
						<!-- alert -->

						<div class="row">
							<div class="col-lg-12 ">
								<div>
								<center><h2>FORM REGISTER</h2></center>
								</div>
						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "duplikatusername") {
								echo "<div class='alert alert-danger text-center'>Maaf username ini sudah digunakan, silahkan gunakan email yang lain.</div>";
							} elseif ($_GET['alert'] == "duplikatemail") {
								echo "<div class='alert alert-danger text-center'>Maaf email ini sudah digunakan, silahkan gunakan email yang lain.</div>";
							} }
						?>
								<hr>
								<form action="daftar_act.php" method="post">
									<div class="form-group">
										<input type="hidden" class="input" name="id_pelanggan" value="<?= $id_plg ?>" readonly>
									</div>
									<div class="form-group">
										<label for="">Nama Lengkap</label>
										<input type="text" class="input" required="required" autocomplete="off" name="nama_pelanggan" placeholder="Masukkan nama anda ..">
									</div>
									<div class="form-group">
										<label for="">Email</label>
										<input type="email" class="input" required="required" autocomplete="off" name="email" placeholder="Masukkan email anda ..">
									</div>
									<div class="form-group">
										<label for="">Nomor HP</label>
										<input type="number" class="input" required="required" name="hp" placeholder="Masukkan nomor hp anda ..">
									</div>
									<div class="form-group">
										<label for="">Alamat Lengkap</label>
										<input type="text" class="input" required="required" name="alamat" placeholder="Masukkan alamat lengkap ..">
									</div>
									<div class="form-group">
										<label for="">Username</label>
										<input type="text" class="input" required="required" autocomplete="off" name="username" placeholder="Masukkan username ..">
									</div>
									<div class="form-group">
										<label for="">Password</label>
										<input type="password" class="input" minlength="6" required="required" autocomplete="off" name="password" placeholder="Masukkan password ..">
									</div>
									<div class="form-group">
										<input type="submit" class="primary-btn btn-block mb-4" value="Daftar">
										<center><b><a href="login.php">Sudah Punya Akun?</a></b></center>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->
</body>

</html>

<?php include 'footer.php' ?>
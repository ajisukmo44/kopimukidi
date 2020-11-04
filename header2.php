<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kopi Mukidi Temanggung</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Hind:100,400" rel="stylesheet">

    <!-- Bootstrap -->

    <link rel="stylesheet" href="kopi/css/bootstrap.min.css">
    <link rel="stylesheet" href="kopi/css/aos.css">
    <link rel="stylesheet" href="kopi/css/style.css">
    <link type="text/css" rel="stylesheet" href="frontend/css/bootstrap.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="frontend/css/font-awesome.min.css">
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="frontend/css/style8.css" />
    <link href="gambar/logo1.ico" rel="shortcut icon" />
</head>

<?php
include 'koneksi.php';

session_start();

$file = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['status'])) {

    // halaman yg dilindungi jika pelanggan belum login
    $lindungi = array('pelanggan.php', 'logout.php');

    // periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
    if (in_array($file, $lindungi)) {
        header("location:index.php");
    }

    if ($file == "checkout.php") {
        header("location:login.php?alert=login-dulu");
    }
} else {

    // halaman yg tidak boleh diakses jika pelanggan sudah login
    $lindungi = array('login.php', 'daftar.php');

    // periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
    if (in_array($file, $lindungi)) {
        header("location:pelanggan.php");
    }
}

if ($file == "checkout.php") {
    if (!isset($_SESSION['keranjang']) || count($_SESSION['keranjang']) == 0) {
        header("location:keranjang.php?alert=keranjang_kosong");
    }
}

?>

<body>

    <style>
        .product-name {
            height: 5px;
        }
    </style>
    <!-- HEADER -->
    <header class="bg-light">

        <!-- header -->
        <div id="header">
            <div class="container bg-light">
                <div class="pull-left">
                    <!-- Logo -->
                    <!-- /Logo -->

                    <!-- Search -->
                    <div class="header-search">
                        <a href="index.php"> <img src="gambar/logo1.png" style="width: 200px;" alt=""></a>
                    </div>
                    <!-- /Search -->
                </div>
                <div class="pull-right">
                    <ul class="header-btns">

                        <!-- Cart -->
                        <li class="header-cart dropdown default-dropdown">

                            <?php
                            if (isset($_SESSION['keranjang'])) {
                                $jumlah_isi_keranjang = count($_SESSION['keranjang']);
                            } else {
                                $jumlah_isi_keranjang = 0;
                            }
                            ?>

                            <a aria-expanded="true">
                                <div>
                                    <strong class="text-uppercase"> <a href="keranjang.php" class="main-btn"> <i class="fa fa-shopping-cart"></i> Keranjang : </strong>
                                    <span class="qty"><?php echo $jumlah_isi_keranjang; ?></span>
                            </a>
                </div>
                </a>
                <div class="custom-menu">
                    <div id="shopping-cart">
                        <div class="shopping-cart-list">
                            <?php
                            $total_berat = 0;
                            if (isset($_SESSION['keranjang'])) {

                                $jumlah_isi_keranjang = count($_SESSION['keranjang']);

                                if ($jumlah_isi_keranjang != 0) {
                                    // cek apakah produk sudah ada dalam keranjang
                                    for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
                                        $id_produk = $_SESSION['keranjang'][$a]['produk'];
                                        $isi = mysqli_query($koneksi, "select * from produk where produk_id='$id_produk'");
                                        $i = mysqli_fetch_assoc($isi);

                                        $total_berat += $i['produk_berat'];
                            ?>

                                        <div class="product product-widget">
                                            <div class="product-thumb">
                                                <?php if ($i['produk_foto1'] == "") { ?>
                                                    <img src="gambar/produk.png">
                                                <?php } else { ?>
                                                    <img src="gambar/produk/<?php echo $i['produk_foto1'] ?>">
                                                <?php } ?>
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-price"><?php echo "Rp. " . number_format($i['produk_harga']) . " ,-"; ?></h3>
                                                <h2 class="product-name"><a href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['produk_nama'] ?></a></h2>
                                            </div>
                                            <a class="cancel-btn" href="keranjang_hapus.php?id=<?php echo $i['produk_id']; ?>&redirect=keranjang"><i class="fa fa-trash"></i></a>
                                        </div>

                            <?php

                                    }
                                } else {
                                    echo "<center>Keranjang Masih Kosong.</center>";
                                }
                            } else {
                                echo "<center>Keranjang Masih Kosong.</center>";
                            }
                            ?>

                        </div>
                        <div>
                            <a class="main-btn" href="keranjang.php">Keranjang</a>
                            <a class="primary-btn" href="checkout.php">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                </li>
                <!-- /Cart -->

                <?php
                if (isset($_SESSION['status'])) {
                    $id_pelanggan = $_SESSION['id_pelanggan'];
                    $pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id_pelanggan'");
                    $c = mysqli_fetch_assoc($pelanggan);
                ?>
                    <!-- Account -->
                    <li class="header-account dropdown default-dropdown">
                        <div class="dropdown-toggle primary-btn" role="button" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-user-o"></i>
                            <span class="ml-2"><?php echo $c['username']; ?></span>
                        </div>
                        <ul class="custom-menu">
                            <li><a href="pelanggan.php"><i class="fa fa-user-o"></i> Akun Saya</a></li>
                            <li><a href="datatransaksi.php"><i class="fa fa-list"></i>Transaksi Saya</a></li>
                            <li><a href="gantipassword.php"><i class="fa fa-lock"></i> Ganti Password</a></li>
                            <li><a href="pelanggan_logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
                        </ul>
                    </li>
                    <!-- /Account -->
                <?php
                } else {
                ?>
                    <li class="header-account dropdown default-dropdown">
                        <a href="login.php" class="text-uppercase primary-btn btn-sm">Login</a>
                        <a href="daftar.php" class="text-uppercase main-btn btn-sm">Daftar</a>
                    </li>
                <?php
                }
                ?>

                <!-- Mobile nav toggle-->
                <li class="nav-toggle">
                    <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                </li>
                <!-- / Mobile nav toggle -->
                </ul>
            </div>
        </div>
        <!-- header -->
        </div>
        <!-- container -->
    </header>
    <!-- /HEADER -->
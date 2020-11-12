<!DOCTYPE html>
<html lang="en">

<?php
 include 'koneksi.php';
 $idp = $_GET['idp'];

 mysqli_query($koneksi, "UPDATE tb_pemesanan a, tb_pembayaran b SET a.status_pemesanan = 2, b.status_pembayaran = 2 WHERE a.id_pemesanan = '$idp' AND b.id_pemesanan = '$idp'; ");

 mysqli_query($koneksi, "INSERT INTO tb_riwayat_status (id, status_code, status, waktu)
 VALUES ('','$idp', 2, now())");


?>

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
              <a href="daftar.php">Payment Success</a>
            </ul>
          </nav>
        </div>
        <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black float-right"><span class="icon-menu h3"></span></a>
        </div>
      </div>
    </div>

  </header>

  <div class="section" style="background-color: #D5B487; ">
    <!-- container -->
    <div class="container" style="margin-top:5%; margin-bottom:7%" >
      <!-- row -->
      <div class="row col-md-3 mt-5 mb-5 mr-5">
        <div class="col-md-11 mt-5 mb-5">
          <div class="order-summary clearfix">
            <div class="row">
              <img src="" alt="">
            </div>
          </div>
        </div>
      </div>

      <div class="row bg-white col-md-6 mt-5 mb-5" style="border-radius: 2%;">
        <div class="col-md-11 mt-5 mb-5">
          <div class="order-summary clearfix">

            <div class="row">
              <div class="col-lg-12 ml-4">
                <div>
                  <center>
                    <h2>Pembayaran Berhasil !!</h2>
                    <!-- alert -->
                  </center>
                </div>
                <hr>
                <form action="#" method="post">
                  <div class="form-group">
                  <div class="form-group">
                    <a href="datatransaksi.php" class="primary-btn btn-block mb-4"><i class="fa fa-spinner"></i>&nbsp;Pesanan anda sedang kami proses packing ! </a>
                    <center><b><a href="index.php">Kembali belanja !</a> </a></b></center>
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
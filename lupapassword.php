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
              <a href="login.php">Login?</a>
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

      <div class="row bg-white col-md-6 mt-5 mb-5" style="border-radius: 2%;">
        <div class="col-md-11 mt-5 mb-5">
          <div class="order-summary clearfix">

            <div class="row">
              <div class="col-lg-12 ml-4">
                <div>
                  <center>
                    <h2>LUPA PASSWORD</h2>
                    <!-- alert -->
                    <?php
                    if (isset($_GET['alert'])) {
                      if ($_GET['alert'] == "gakterdaftar") {
                        echo "<div class='alert alert-danger text-center'>Email tidak terdaftar!</div>";
                      } elseif ($_GET['alert'] == "berhasil") {
                        echo "<div class='alert alert-success text-center'>reset password berhasil dikirim</div>";
                      } elseif ($_GET['alert'] == "gagal") {
                        echo "<div class='alert alert-danger text-center'>email gagal dikirim</div>";
                      }
                    }
                    ?>
                  </center>
                </div>
                <hr>
                <form action="mail/send2.php" method="post">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="input" autocomplete="off" name="email" placeholder="Masukkan email .." required>
                  </div>

                  <div class="form-group">
                    <button type="submit" name="submit" class="primary-btn btn-block mb-4"><i class="fa fa-lock"></i>&nbsp; KIRIM</button>
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
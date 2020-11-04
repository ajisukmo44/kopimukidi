<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kopi Mukidi</title>
    <meta name="description" content="Kopi Mukidi - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include 'style.php'
    ?>
</head>

<body>
    <?php
    include 'sidebar.php';
    ?>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php
        include 'header.php'
        ?>

        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- /#header -->
                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-xl-12 col-lg-8">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-success">LAPORAN PEMBELIAN BAHANBAKU
                            </div>
                            <form action="laporan/lap_pembelian.php" method="post" enctype="multipart/form-data">
                                <div class="form-group row mt-3 ml-3 ">
                                    <div class="col-3 mb-4">
                                        Tanggal Awal <input type="date" class="form-control" name="tanggal" id="tanggal">
                                    </div>
                                    <div class="col-3 mr-1">
                                        Tanggal Akhir <input type="date" class="form-control" name="tanggal1" id="tanggal1">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" name="submit" class="btn btn-info mt-4"><i class="fa fa-print"></i> CETAK LAPORAN</button>
                                    </div>
                                </div>
                        </div>
                        <div>
                            </form>
                            <!-- Card Body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#right-panel -->
            <?php
            include 'script.php';
            ?>
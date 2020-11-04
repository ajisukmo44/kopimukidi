<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session
?>

<!doctype html>
<html class="no-js" lang="">

<?php
include 'head.php';
?>

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
        <!-- /#header -->

        <!-- content -->
        <!-- query -->
        <?php
        include 'koneksi.php';

        ?>

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Tambah Data Bahanbaku</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/bahanbaku/bahanbakutambah.php" method="POST">
                                    <div class="form-group">
                                        <label class=" form-control-label">Nama Bahanbaku</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-diamond"></i></div>
                                            <input class="form-control" name="nama_bahanbaku" autocomplete="off" placeholder="nama bahanbaku" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Stok Bahanbaku / Kg</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                            <input class="form-control" name="stok_bahanbaku" autocomplete="off" placeholder="stok bahanbaku" required>
                                        </div>
                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" name="simpan" class="btn btn-success btn-sm float-right"><i class="fa fa-bookmark-o"></i> Simpan</button> <a href="datakategori.php" type="submit" class="btn btn-danger btn-sm float-right mr-2 "><i class="menu-icon fa fa-times"></i> Batal</a>
                                    </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- .animated -->
            </div>
            <!-- /.content -->

            <!-- end content -->
            <div class="clearfix"></div>
        </div>
        <!-- /#right-panel -->
        <?php
        include 'script.php';
        ?>
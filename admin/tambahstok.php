<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session

$id   = mysqli_real_escape_string($conn, $_GET['id']);
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
                                <strong>Tambah Stok Produk</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/updatestok/tambahstok.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class=" form-control-label">Nama Produk</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                                            <?php if ($id > 1) {
                                                include('komponen/updatestok/querytambahstok1.php');
                                            } else {
                                                include('komponen/updatestok/querytambahstok.php');
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Jumlah Stok Baru</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-bar-chart-o"></i></div>
                                            <input type="number" class="form-control" autocomplete="off" name="jumlah" placeholder="jumlah" required>
                                        </div>

                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" name="simpan" class="btn btn-success btn-sm float-right"><i class="fa fa-bookmark-o"></i> Simpan</button> <a href="datauser.php" type="submit" class="btn btn-danger btn-sm float-right mr-2 "><i class="menu-icon fa fa-times"></i> Batal</a>
                                    </div>
                            </div>
                        </div>
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
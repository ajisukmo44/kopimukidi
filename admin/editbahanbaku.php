<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session

$id   = mysqli_real_escape_string($conn, $_GET['id_bahanbaku']);
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
                                <strong>Edit Data Bahanbaku</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/bahanbaku/bahanbakuedit.php" method="POST">
                                    <?php
                                    $query_view = mysqli_query($conn, "SELECT * FROM tb_bahanbaku WHERE id_bahanbaku='$id'");
                                    //$result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($query_view)) {
                                        $idb = $row['id_bahanbaku'];
                                        $nb = $row['nama_bahanbaku'];
                                        $sb = $row['stok_bahanbaku'];
                                    ?>
                                        <input type="hidden" class="form-control" autocomplete="off" name="id_bahanbaku" value="<?= $idb ?>" readonly>
                                        <div class="form-group">
                                            <label class=" form-control-label">Stok Bahanbaku</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                                <input type="text" class="form-control" autocomplete="off" name="nama_bahanbaku" value="<?= $nb ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Nama Kategori</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                                <input type="text" class="form-control" autocomplete="off" name="stok_bahanbaku" value="<?= $sb ?>">
                                            </div>
                                        </div>

                                        <div class="form-actions form-group">
                                            <button type="submit" name="simpan" class="btn btn-success btn-sm float-right"><i class="menu-icon fa fa-bookmark-o"></i> Simpan</button> <a href="datakategori.php" type="submit" class="btn btn-danger btn-sm float-right mr-2 "><i class="menu-icon fa fa-times"></i> Batal</a>
                                        </div>

                            </div>
                        </div>
                    <?php
                                    }
                    ?>
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
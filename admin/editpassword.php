<?php session_start();
include 'koneksi.php';
include 'fungsi/cek_login.php';
include 'fungsi/cek_session.php';
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
                                <strong>Edit Password</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/user/passwordedit.php" method="POST">
                                    <?php
                                    $query_view = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$sesen_username' ");
                                    //$result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($query_view)) {
                                        $idu = $row['id_user'];
                                        $us = $row['username'];
                                    ?>
                                        <input type="hidden" class="form-control" autocomplete="off" name="id_kategori" value="<?= $us ?>" readonly>
                                        <div class="form-group">
                                            <label class="form-control-label">Password Baru</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                                <input type="password" class="form-control" autocomplete="off" name="password" placeholder="password baru">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control" autocomplete="off" name="username" value="<?= $us ?>">
                                            </div>
                                        </div>

                                        <div class="form-actions form-group">
                                            <button type="submit" name="simpan" class="btn btn-success btn-sm float-right"><i class="menu-icon fa fa-bookmark-o"></i> Simpan</button> <a href="home.php" type="submit" class="btn btn-danger btn-sm float-right mr-2 "><i class="menu-icon fa fa-times"></i> Batal</a>
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
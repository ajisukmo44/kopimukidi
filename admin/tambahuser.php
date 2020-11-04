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
                                <strong>Tambah Data User</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/user/usertambah.php" method="POST">
                                    <div class="form-group">
                                        <label class=" form-control-label">Nama User</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                            <input class="form-control" name="nama_user" autocomplete="off" placeholder="nama user" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Jabatan</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-list"></i></div>
                                            <select data-placeholder="jabatan.." name="jabatan" class="standardSelect form-control" tabindex="1">
                                                <option value="Admin">Admin</option>
                                                <option value="Pemilik">Pemilik</option>
                                                <option value="Bagian-Produksi">Bagian Produksi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-file"></i></div>
                                            <input type="text" class="form-control" autocomplete="off" name="username" placeholder="username" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Password</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
                                            <input type="password" class="form-control" name="password" placeholder="password" minlength="6" required>
                                        </div>
                                    </div>
                                    <div class="form-actions form-group">
                                        <button type="submit" name="simpan" class="btn btn-success btn-sm float-right"><i class="fa fa-bookmark-o"></i> Simpan</button> <a href="datauser.php" type="submit" class="btn btn-danger btn-sm float-right mr-2 "><i class="menu-icon fa fa-times"></i> Batal</a>
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
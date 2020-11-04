<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session
$id   = mysqli_real_escape_string($conn, $_GET['id_produk']);
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
                                <strong>Edit Data Produk</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/produk/produkedit.php" method="POST" enctype="multipart/form-data">
                                    <?php
                                    $query_view = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk='$id'");
                                    //$result = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($query_view)) {
                                        $np = $row['nama_produk'];
                                        $hr = $row['harga'];
                                        $st = $row['stok'];
                                        $kt = $row['id_kategori'];
                                        $ds = $row['deskripsi'];
                                        $br = $row['berat'];
                                        $img = $row['foto_produk'];
                                    ?>
                                        <div class="form-group">
                                            <label class=" form-control-label">ID Produk</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                <input class="form-control" name="id_produk" value="<?= $id ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Nama Produk</label>
                                            <div class="input-group">

                                                <div class="input-group-addon"><i class="fa fa-product-hunt"></i></div>
                                                <input class="form-control" name="nama_produk" value="<?= $np ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="id_kategori" name="id_kategori" value="<?= $kt ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="stok" name="stok" value="<?= $st ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Berat</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-balance-scale"></i></div>
                                                <input type="number" class="form-control" autocomplete="off" name="berat" value="<?= $br ?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Harga</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                                <input type="number" class="form-control" name="harga" value="<?= $hr ?>" required>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <div class="card">
                            <div class="card-header p-4">
                                <strong></strong>
                            </div>
                            <div class="card-body card-block">


                                <div class="form-group">
                                    <label class="form-control-label">Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-file-o"></i></div>
                                        <input type="text" class="form-control" name="deskripsi" value="<?= $ds ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Foto Lama</label>
                                    <div class="input-group">
                                    </div>
                                    <img style="margin-left:0px; margin-right:45px; margin-bottom:15px;" src="images/produk/<?php echo $img ?> " width="75px" height="75px" /><br>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Foto Baru</label>
                                    <div class="input-group">
                                        <input type="file" id="img" name="img" multiple="" class="form-control-file">
                                    </div>
                                    <br><b>Preview Gambar</b><br>
                                    <img id="preview" src="" alt="" width="25%" />
                                </div>
                                <hr>
                                <div class="form-actions form-group">
                                    <button type="submit" name="simpan" class="btn btn-success btn-sm float-right"><i class="menu-icon fa fa-bookmark-o"></i> Simpan</button> <a href="datauser.php" type="submit" class="btn btn-danger btn-sm float-right mr-2 "><i class="menu-icon fa fa-times"></i> Batal</a>
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
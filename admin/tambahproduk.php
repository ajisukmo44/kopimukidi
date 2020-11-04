<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session
include 'fungsi/imgpreview.php';
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
                                <strong>Tambah Data Produk</strong>
                            </div>
                            <div class="card-body card-block">
                                <form action="komponen/produk/produktambah.php" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class=" form-control-label">Nama Produk</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-product-hunt"></i></div>
                                            <input class="form-control" name="nama_produk" autocomplete="off" placeholder="nama produk" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Kategori</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                                <option value="">--Pilih Kategori--</option>
                                                <?php
                                                $query = "SELECT * FROM tb_kategori ORDER BY id_kategori";
                                                $sql = mysqli_query($conn, $query);
                                                while ($data = mysqli_fetch_array($sql)) {
                                                    echo '<option value="' . $data['id_kategori'] . '">' . $data['nama_kategori'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Berat / Gram</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-balance-scale"></i></div>
                                            <input type="number" class="form-control" autocomplete="off" name="berat" placeholder="berat" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" form-control-label">Harga</label>
                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                            <input type="number" class="form-control" name="harga" placeholder="harga" required>
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
                                    <label class="form-control-label">Stok</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-bar-chart-o"></i></div>
                                        <input type="number" class="form-control" name="stok" placeholder="stok" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Deskripsi</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-file-o mt-3"></i></div>
                                        <textarea type="text" class="form-control" name="deskripsi" placeholder="deskripsi" required>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Foto</label>
                                    <div class="input-group">
                                        <input type="file" id="img" name="img" multiple="" onchange="tampilkanPreview(this,'preview1')" class="form-control-file">
                                    </div>
                                    <br><b>Preview Gambar</b><br>
                                    <img id="preview1" src="" alt="" width="25%" />
                                </div>
                                <hr>
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
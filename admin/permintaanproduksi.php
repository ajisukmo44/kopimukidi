<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Kopi Mukidi</title>
    <meta name="description" content="Kopi Mukidi">
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
        <!-- /#header -->

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

                <!-- Orders -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>DATA PERMINTAAN PRODUKSI

                                </h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats  ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama&nbsp;Produk</th>
                                                <th>Nama&nbsp;Bahanbaku</th>
                                                <th>Jumlah&nbsp;Bahanbaku</th>
                                                <th>Stok&nbsp;Baru</th>
                                                <th>Status&nbsp;Produksi</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_produksi a JOIN tb_produk b ON a.id_produk = b.id_produk JOIN tb_bahanbaku c ON a.id_bahanbaku = c.id_bahanbaku ORDER BY a.id_produksi");
                                                while ($data = mysqli_fetch_assoc($query)) {

                                                    $idp = $data['id_produksi'];
                                                    $idb = $data['id_bahanbaku'];
                                                    $idproduk = $data['id_produk'];
                                                    $status = $data['status_produksi'];
                                                    $jb = $data['jumlah_bahanbaku'];
                                                    $tgl = date('d-m-Y', strtotime($data['tanggal_produksi']));
                                                ?>
                                                    <td><?= $no++ ?></td>
                                                    <td><?php echo $data['nama_produk']; ?></td>
                                                    <td><?php echo $data['nama_bahanbaku']; ?></td>
                                                    <td><?= $jb ?> Kg</td>
                                                    <td><?php echo $data['jumlah_stok_baru']; ?> Pcs</td>

                                                    <td>
                                                        <?php
                                                        if ($status == 1) {
                                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp' ><span class='badge badge-dark badge-sm'>Permintaan Belum Diproses</span></a>";
                                                        } else if ($status == 2) {
                                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp'> <span class='badge badge-warning'> On Proses </span> </a>";
                                                        } else {
                                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp'>  <span class='badge badge-success'><i class='fa fa-check'></i> Selesai</span> </a>";
                                                        }
                                                        ?>
                                                    <td>
                                                        <?php
                                                        $idp = $data['id_produksi'];
                                                        $a1 = "<h5><a href='validasi/produksiupdate.php?id=$idp&jb=$jb&idb=$idb' class='btn btn-warning btn-sm'> <i class='fa fa-spinner'></i> Proses</a></h5>";
                                                        $a2 = " <a href='#' type='button' class='btn btn-success btn-sm' data-toggle='modal' data-target='#myModal$idp'><i class='fa fa-check'></i> Selesai</a>";
                                                        $a3 = "<h5><a href='#'  class='btn btn-secondary btn-sm'><i class='fa fa-check'></i></a></h5>";
                                                        if ($status == 1) {
                                                            echo $a1;
                                                        } else if ($status == 2) {
                                                            echo $a2;
                                                        } else {
                                                            echo $a3;
                                                        };
                                                        ?>
                                                    </td>
                                            </tr>
                                            <div class="modal fade" id="myModal<?= $idp ?>" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <center>
                                                                    <h5>HASIL PRODUKSI
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </h5>
                                                                </center>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="validasi/produksiselesai.php" method="POST">
                                                                    <input type="hidden" class="form-control" name="id" value="<?= $idp ?>">
                                                                    <input type="hidden" class="form-control" name="idp" value="<?= $idproduk ?>">
                                                                    <div class="form-group">
                                                                        <label for="">Jumlah Stok Baru</label>
                                                                        <input type="text" class="form-control" name="stok" placeholder="jumlah stok baru /Pcs">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Simpan</button>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-8 -->
                    <!-- /.orders -->
                    <!-- /#add-category -->
                </div>
                <!-- .animated -->
            </div>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>
        <!-- /#right-panel -->
        <!-- /#right-panel -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center>
                            <p><b>STATUS PRODUKSI</b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
                        </center>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php
    include 'alerthapus.php';
    ?>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'modal/statusproduksi.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
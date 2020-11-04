<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session


$id   = mysqli_real_escape_string($conn, $_GET['id']);
$nb   = mysqli_real_escape_string($conn, $_GET['nama']);
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
    <title> Kopi Mukidi</title>
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
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class='box-title'> DATA PERMINTAAN BAHANBAKU</h4>
                                <hr>
                                <div class="modal-body">
                                    <form action="aksipermintaan/bahanbaku.php" method="POST">
                                        <h5>
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" name="id_bahanbaku" value="<?= $id ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Bahanbaku</label>
                                                <input type="text" class="form-control" name="namabahanbaku" value="<?= $nb ?>" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Pilih Petani</label>
                                                <select name="id_petani" id="id_petani" class="form-control" required>
                                                    <option value="">--Pilih Petani--</option>
                                                    <?php
                                                    $query = "SELECT * FROM tb_petani ORDER BY id_petani";
                                                    $sql = mysqli_query($conn, $query);
                                                    while ($data = mysqli_fetch_array($sql)) {
                                                        echo '<option value="' . $data['id_petani'] . '">' . $data['nama_petani'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jumlah Bahanbaku / Kg</label>
                                                <input type="text" class="form-control" name="jumlah" placeholder="jumlah bahanbaku ">
                                            </div>
                                            <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Kirim Permintaan</button>

                                    </form>

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
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p><b>BUKTI TRANSFER</b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
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
                    url: 'modal/buktitransfer.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
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
    <title> Kopi Mukidi</title>
    <meta name="description" content="Kopi Mukidi ">
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
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

                <!-- Orders -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <b>
                                    DATA STOK PRODUK
                                </b>
                                <?php
                                $sql   = "SELECT * FROM tb_produk WHERE stok < 10";
                                $result = mysqli_query($conn, $sql);
                                $jml = mysqli_num_rows($result);
                                ?>

                                <?php if ($jml > 0) {
                                    echo " <span class='alert alert-danger p-0' role='alert'> Ada 
                                    $jml Produk Stok Di Bawah 10 Pcs !! 
                                   </span>";
                                } else {
                                    echo "";
                                }
                                ?>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Nama Produk</th>
                                                <th>Stok Produk</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_produk ORDER BY id_produk");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $id = $data['id_produk'];
                                                    $stok = $data['stok'];
                                                    $np = $data['nama_produk'];
                                                ?>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $np; ?> </td>
                                                    <td>
                                                        <?php
                                                        if ($stok < 10) {
                                                            echo "<p style='color:red'>" . $stok . " Pcs</p>";
                                                        } else {
                                                            echo $stok . " Pcs";
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php
                                                        $id = $data['id_produk'];
                                                        ?>
                                                        <a href='#myModal' id='produksi' data-toggle='modal' data-id='<?= $id ?>' class='btn btn-info btn-sm'> <i class='fa fa-plus'></i> Kirim Permintaan Produksi</a>
                                                    </td>
                                            </tr>
                                        <?php
                                                }
                                        ?>

                                        </tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-8 -->
                </div>
                <!-- /.content -->

            </div>

            <div class="clearfix"></div>


            <!-- modal produksi -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="fetched-data"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- /#right-panel -->
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
                    url: 'modal/produksi.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
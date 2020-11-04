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

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

                <!-- Orders -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class='box-title'>DATA PEMBAYARAN
                                    <?php
                                    $no = 1;
                                    $sql   = "SELECT status_pembayaran FROM tb_pembayaran WHERE status_pembayaran = 1";
                                    $result = mysqli_query($conn, $sql);
                                    $jml = mysqli_num_rows($result);
                                    ?>

                                    <?php if ($jml > 0) {
                                        echo " <span class='alert alert-danger p-0' role='alert'>
                                $jml Data Pembayaran Belum Di Validasi !
                                </span>";
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats  ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID&nbsp;Pemesanan</th>
                                                <th>Metode&nbsp;Pembayaran</th>
                                                <th>Nama&nbsp;Rekening</th>
                                                <th>Bank</th>
                                                <th>Jumlah&nbsp;Transfer</th>
                                                <th>Tgl&nbsp;Transfer</th>
                                                <th>Bukti&nbsp;Transfer</th>
                                                <th>status&nbsp;Pembayaran</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_pembayaran ORDER BY id_pemesanan");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $status = $data['status_pembayaran'];
                                                    $tgl = date('d-m-Y', strtotime($data['tanggal_transfer']));
                                                ?>
                                                    <td><?= $no++ ?></td>
                                                    <td><?php echo $data['id_pemesanan']; ?></td>
                                                    <td><?php echo $data['metode_pembayaran']; ?></td>
                                                    <td><?php echo $data['nama_rekening']; ?></td>
                                                    <td><?php echo $data['nama_bank']; ?></td>
                                                    <td><?php echo $data['jumlah_transfer']; ?></td>
                                                    <td><?= $tgl; ?></td>
                                                    <?php echo "<td><h6><a href='#myModal' class='btn btn-light btn-sm' id='bayar' data-toggle='modal' data-id=" . $data['id_pembayaran'] . "> <i class='fa fa-eye'></i> bukti transfer </a></h6></td>"; ?>
                        <td>
                            <?php $bayar = $data['status_pembayaran'];
                            if ($bayar == 2) {
                                echo "<span class='badge badge-success'> <i class='fa fa-check'></i> Tervalidasi </span>";
                            } else {
                                echo "<span class='badge badge-danger'><i class='fa fa-times'></i> Belum Di Validasi </span>";
                            }
                            ?>
                            </>
                        <td>
                        <?php
                        $idt = $data['id_pemesanan'];
                        $idb = $data['id_pembayaran'];
                        $a1 = "<h5><a href='validasi/pembayaranupdate.php?id_pembayaran=$idb&id_pemesanan=$idt'  class='btn btn-success btn-sm'><i class='fa fa-check'></i></a></h5>";
                        $a2 = "<h5><a href='#'  class='btn btn-secondary btn-sm'><i class='fa fa-check'></i></a></h5>";
                        if ($status == 1) {
                            echo $a1;
                        } else {
                            echo $a2;
                        };
                        ?>
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
                <!-- .animated -->
            </div>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>

        <!-- modal bukti transfer -->
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

        <!-- end modal bukti transfer -->

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
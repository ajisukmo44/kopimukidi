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
                                                <th>Total&nbsp;Pembayaran</th>
                                                <th>Tgl&nbsp;Pembayaran</th>
                                                <th>Batas&nbsp;Pembayaran</th>
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
                                                    $tgl = date('d-m-Y', strtotime($data['tanggal_pembayaran']));
                                                    $tgl1 = date('h:i, d-m-Y', strtotime($data['batas_pembayaran']));
                                                ?>
                                                    <td><?= $no++ ?></td>
                                                    <td><?php echo $data['id_pemesanan']; ?></td>
                                                    <td><?php echo $data['metode_pembayaran']; ?></td>
                                                    <td><?php echo "Rp. " . number_format($data['total_pembayaran']); ?></td>
                                                    <td><?= $tgl ; ?></td>
                                                    <td><?= $tgl1 ;?></td>
                                                
                        <td>
                            <?php $bayar = $data['status_pembayaran'];
                            if ($bayar == 2) {
                                echo "<span class='badge badge-success'> <i class='fa fa-check'></i> Pembayaran Berhasil </span>";
                            } else {
                                echo "<span class='badge badge-danger'><i class='fa fa-times'></i> Belum Dibayar </span>";
                            }
                            ?>
                            </>
                        <td>

                        <?php
                        $idt = $data['id_pemesanan'];
                        $sql1 = "SELECT * FROM tb_pemesanan WHERE id_pemesanan= '$idt' ";
                        $query1 = mysqli_query($conn, $sql1);
                        $data1 = mysqli_fetch_array($query1);
                        $statuspesan = $data1['status_pemesanan'];
                    
                        $a1 = "<h5><a href='validasi/pembayaranupdate.php?id_pemesanan=$idt'  class='btn btn-info btn-sm'><i class='fa fa-cube'></i> Packing</a></h5>";
                        $a2 = "<h5><a href='#'  class='btn btn-secondary btn-sm'><i class='fa fa-check'></i></a></h5>";
                        if ($statuspesan == 2) {
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
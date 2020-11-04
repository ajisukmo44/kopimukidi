<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Kopi Mukidi</title>
    <meta name="description" content="Kopi Mukidi Temanggung">
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
                                <h4 class="box-title">DATA PEMESANAN </h4>
                            </div>
                            <div class="card-body--">

                                <div class="table-stats">
                                    <table class="table">
                                        <thead style="background-color: #F2F2F2;">
                                            <tr>
                                                <th>No</th>
                                                <th>ID&nbsp;Pemesanan</th>
                                                <th>Tgl&nbsp;Checkout</th>
                                                <th>Detail</th>
                                                <th>Nama&nbsp;Pelanggan</th>
                                                <th>Total&nbsp;Bayar</th>
                                                <th>status&nbsp;Pemesanan</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_pemesanan a JOIN tb_pelanggan b ON a.id_pelanggan = b.id_pelanggan ORDER BY a.id_pemesanan");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $tgl = date('d-m-Y', strtotime($data['tanggal_checkout']));
                                                    $status = $data['status_pemesanan'];
                                                    $id =  $data['id_pemesanan'];

                                                ?>

                                                    <td><?= $no++ ?></td>
                                                    <td><?php echo $data['id_pemesanan']; ?></td>
                                                    <td><?= $tgl; ?></td>
                                                    <td><a href="datapemesanandetail.php?id=<?= $id; ?>" class="btn btn-light btn-sm"><i class='fa fa-file-o'> </i> Detail</a></td>
                                                    <td><?php echo $data['nama_pelanggan']; ?></td>
                                                    <td><?php echo $data['total_bayar']; ?></td>

                                                    <!-- status pemesanan -->
                                                    <td>
                                                        <?php
                                                        if ($data['status_pemesanan'] == 0) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-danger'>Gagal</span></a>";
                                                        } elseif ($data['status_pemesanan'] == 1) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-danger'>Menunggu Pembayaran</span></a>";
                                                        } elseif ($data['status_pemesanan'] == 2) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-warning'>Sedang Diproses</span></a>";
                                                        } elseif ($data['status_pemesanan'] == 3) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-primary'>Sedang Dikemas</span></a>";
                                                        } elseif ($data['status_pemesanan'] == 4) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-info'>Sudah Dikirim</span></a>";
                                                        } elseif ($data['status_pemesanan'] == 5) {
                                                            echo "<a href='#myModal2' id='pesan' data-toggle='modal' data-id='$id' ><span class='badge badge-success'><i class='fa fa-check'> </i> Selesai</span></a>";
                                                        }

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $id = $data['id_pemesanan'];
                                                        $a1 = "<a href='#myModal' class='btn btn-primary btn-sm' id='bayar' data-toggle='modal' data-id='$id'>  <i class='fa fa-truck'></i> Kirim</a>";

                                                        $a2 = "-";

                                                        if ($status == 1) {
                                                            echo $a2;
                                                        } else if ($status == 2) {
                                                            echo $a2;
                                                        } else if ($status == 3) {
                                                            echo $a1;
                                                        } else if ($status == 4) {
                                                            echo $a2;
                                                        } else {
                                                            echo $a2;
                                                        };

                                                        ?>
                                                    </td>
                                            </tr>
                                        <?php
                                                }
                                                //mysql_close($host);
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

            <!-- modal pengiriman -->
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

        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center><p><b>STATUS PEMESANAN</b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p></center>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data2"></div>
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

    <?php
    include 'alerthapus.php';
    ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'modal/pengiriman.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
       <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal2').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'modal/statuspemesanan.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data2').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
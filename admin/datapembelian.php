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
                                <h4 class="box-title">DATA PEMBELIAN BAHANBAKU <a href="#myModal" id='tambah' data-toggle='modal' >
                                        <badge class="badge badge-success"><i class="fa fa-plus"> </i> Tambah Data Pembelian
                                        </badge>
                                    </a>
                                </h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tgl&nbsp;Pembelian</th>
                                                <th>Nama&nbsp;Bahanbaku</th>
                                                <th>Nama&nbsp;Petani</th>
                                                <th>Jumlah/Kg</th>
                                                <th>Total&nbsp;Harga</th>
                                                <th>Nota&nbsp;Pembelian</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_pembelian_bahanbaku a JOIN tb_bahanbaku b ON a.id_bahanbaku = b.id_bahanbaku JOIN  tb_petani c ON a.id_petani = c.id_petani ORDER BY a.id_pembelian");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $id  =  $data['id_pembelian'];
                                                    $tgl  = date('d-m-Y', strtotime($data['tanggal_pembelian']));
                                                    $idb  =  $data['id_bahanbaku'];
                                                    $nb   =  $data['nama_bahanbaku'];
                                                    $np   =  $data['nama_petani'];
                                                    $nota =  $data['nota_pembelian'];
                                                    $jml  =  $data['jumlah'];
                                                    $th   =  number_format($data['total_harga'], 0, ',', '.');
                                                ?>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= $tgl; ?></td>
                                                    <td><?= $nb; ?></td>
                                                    <td><?= $np; ?></td>
                                                    <td><?= $jml ?></td>
                                                    <td>Rp, <?= $th ?></td>
                                                    <td>
                                                      <a href="images/notapembelian/<?= $nota; ?>" > <img src="images/notapembelian/<?= $nota; ?>" alt="" width="px" height="50px"> </a>
                                                    </td>
                                                    <td>
                                                        <a href="#myModal2" id='edit' data-toggle='modal' data-id="<?= $id; ?>" class="btn btn-info btn-sm"><i class="menu-icon fa fa-edit"></i></a> <a href="komponen/pembelian/pembelianhapus.php?id_pembelian=<?= $data['id_pembelian']; ?>" onclick="return confirm('Anda yakin mau menghapus data ini ?')" class="btn btn-danger btn-sm"><i class="menu-icon fa fa-trash"></i></a>
                                                    </td>
                                            </tr>

                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div> <!-- /.table-stats -->
                            </div>
                        </div> <!-- /.card -->
                    </div> <!-- /.col-lg-8 -->

                    <!-- /#add-category -->
                </div>
                <!-- .animated -->
            </div>
            <!-- /.content -->
            <div class="clearfix"></div>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="fetched-data"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="fetched-data2"></div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- end modal  -->
        <!-- /#right-panel -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'modal/tambahpembelian.php',
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
                    url: 'modal/editpembelian.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data2').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
        <!-- Core plugin JavaScript-->

        <!-- Custom scripts for all pages-->
        <!-- /.content -->
        <!-- /.content -->


        <?php
        include 'alerthapus.php';
        ?>

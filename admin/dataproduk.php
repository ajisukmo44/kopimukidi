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
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

                <!-- Orders -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <b>
                                    DATA PRODUK
                                </b><a class="btn btn-success btn-sm ml-2" href="tambahproduk.php">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                                </b>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>Foto</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Berat</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                                <th>Deskripsi</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no =  1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_produk a JOIN tb_kategori b ON a.id_kategori = b.id_kategori ORDER BY a.id_produk");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                ?>
                                                    <td><?= $no++; ?></td>
                                                    <td style='text-align: center'><img src='images/produk/<?= $data['foto_produk'] ?>' width='50px' height='30px'></td>
                                                    <td><?php echo $data['nama_produk']; ?></td>
                                                    <td><?php echo $data['nama_kategori']; ?></td>
                                                    <td><?php echo $data['berat']; ?> Gram </td>
                                                    <td><?php echo $data['harga']; ?></td>
                                                    <td><?php echo $data['stok']; ?></td>
                                                    <?php echo "<td><h6><a href='#myModal' class='btn btn-light btn-sm' id='produk' data-toggle='modal' data-id=" . $data['id_produk'] . "> deskripsi </a></h6></td>"; ?>
                                                    <td>
                                                        <a href="editproduk.php?id_produk=<?= $data['id_produk']; ?>" class="btn btn-info btn-sm"><i class="menu-icon fa fa-edit"></i></a> <a href="komponen/produk/produkhapus.php?id_produk=<?= $data['id_produk']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" class="btn btn-danger btn-sm"><i class="menu-icon fa fa-trash"></i></a>
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
                    <!-- /.orders -->
                    <!-- /#add-category -->
                    <!-- .animated -->

                </div>
                <!-- /.content -->

            </div>

            <div class="clearfix"></div>
        </div>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p><b>DESKRIPSI PRODUK</b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /#right-panel -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->

    <!-- Custom scripts for all pages-->
    <!-- /.content -->
    <!-- /.content -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myModal').on('show.bs.modal', function(e) {
                var rowid = $(e.relatedTarget).data('id');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'modal/deskripsiproduk.php',
                    data: 'rowid=' + rowid,
                    success: function(data) {
                        $('.fetched-data').html(data); //menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>
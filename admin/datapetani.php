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
        <!-- query -->
        <?php
        include 'koneksi.php';

        ?>

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">

                <!-- Orders -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <b>
                                    DATA PETANI
                                </b><a class="btn btn-success btn-sm ml-2" href="tambahpetani.php">
                                    <i class="fa fa-plus"></i> Tambah Data
                                </a>
                                </b>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Nama Petani</th>
                                                <th>No Hp</th>
                                                <th>Alamat</th>
                                                <th>Bergabung</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_petani");
                                                while ($data = mysqli_fetch_assoc($query)) {

                                                    $bergabung = date('d-m-Y', strtotime($data['bergabung']));


                                                ?>
                                                    <td><?= $no++; ?></td>
                                                    <td><?php echo $data['username']; ?></td>
                                                    <td><?php echo $data['nama_petani']; ?></td>
                                                    <td><?php echo $data['no_hp']; ?></td>
                                                    <td><?php echo $data['alamat']; ?></td>
                                                    <td><?php echo $bergabung; ?></td>
                                                    <td>
                                                        <a href="editpetani.php?id_petani=<?= $data['id_petani']; ?>" class="btn btn-info btn-sm"><i class="menu-icon fa fa-edit"></i></a> <a href="komponen/petani/petanihapus.php?id_petani=<?= $data['id_petani']; ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" class="btn btn-danger btn-sm"><i class="menu-icon fa fa-trash"></i></a>
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
                </div>
                <!-- .animated -->
            </div>
            <!-- /.content -->

            <div class="clearfix"></div>
        </div>
        <!-- /#right-panel -->
        <?php
        include 'script.php';
        ?>


        <?php
        include 'alerthapus.php';
        ?>

        <script>
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
            $('#exampleModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* 
                var modal = $(this)
                modal.find('.modal-title').text('')
                modal.find('.modal-body input').val(recipient)
            });
        </script>
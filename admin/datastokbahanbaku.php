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
                                    DATA STOK BAHANBAKU
                                </b>
                                <?php
                                $sql   = "SELECT * FROM tb_bahanbaku WHERE stok_bahanbaku < 10";
                                $result = mysqli_query($conn, $sql);
                                $jml = mysqli_num_rows($result);
                                ?>

                                <?php if ($jml > 0) {
                                    echo " <span class='alert alert-danger p-0' role='alert'> Ada 
                                 $jml Bahanbaku Stok Di Bawah 10 Kg !! 
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
                                                <th>Nama Bahanbaku</th>
                                                <th class="text-left">Stok Bahanbaku</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $no = 1;
                                                $query = mysqli_query($conn, "SELECT * FROM tb_bahanbaku ORDER BY id_bahanbaku");
                                                while ($data = mysqli_fetch_assoc($query)) {
                                                    $id = $data['id_bahanbaku'];
                                                    $nb = $data['nama_bahanbaku'];
                                                    $stok = $data['stok_bahanbaku'];
                                                ?>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $nb; ?> </td>
                                                    <td class="text-left">
                                                        <?php
                                                        if ($stok < 10) {
                                                            echo "<p style='color:red'>" . $stok . " Kg</p>";
                                                        } else {
                                                            echo $stok . " Kg";
                                                        }
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
                    <!-- /.orders -->
                    <!-- /#add-category -->
                    <!-- .animated -->

                </div>
                <!-- /.content -->

            </div>

            <div class="clearfix"></div>

        
        </div>
    </div>


    <!-- /#right-panel -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->

    <!-- Custom scripts for all pages-->


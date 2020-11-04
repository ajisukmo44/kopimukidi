<?php session_start();
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session

$id = $_GET['id'];
$invoice = mysqli_query($conn, "SELECT * FROM tb_pemesanan a JOIN tb_pelanggan b ON a.id_pelanggan = b.id_pelanggan WHERE id_pemesanan='$id' ORDER BY id_pemesanan DESC");
while ($i = mysqli_fetch_array($invoice)) {
    $tgl = date('d-m-Y', strtotime($i['tanggal_checkout']));
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

                    <div class=" container">
                        <div class="row bg-white mt-4 mb-4 col-md-12" style="border-radius: 1%;">
                            <div id="main" class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-12 mt-3">
                                        <div class="mt-4">
                                            <p align="center"> <img src="../gambar/logo1.png" alt="" style="width:250px"> </p>
                                            <hr>
                                            <p align="center"> <strong>TGL: <?= $tgl ?> | ID Pemesanan : <?php echo $id; ?></strong> <br>
                                            </p>
                                        </div>
                                        <HR>
                                        <div class="pull-right">
                                            <a href="invoicepemesanan.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default btn-sm mr-4"><i class="fa fa-print"></i>&nbsp; CETAK</a>
                                        </div>
                                        <strong>Nama </strong>: <?= $i['nama_pelanggan']; ?><br />
                                        <strong>Alamat </strong>: <?= $i['alamat']; ?><br />
                                        <strong>No Hp </strong> : <?= $i['no_hp']; ?><br />
                                        <hr>
                                        <div class="table-stats order-table ov-h">
                                            <table class="table">
                                                <thead style="background-color: #41B883; color:#fff">
                                                    <th class="text-center" width="1%">NO</th>
                                                    <th class="text-center">Nama Produk</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-center">Total Berat</th>
                                                    <th class="text-center">Total Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    $total = 0;

                                                    $transaksi = mysqli_query($conn, "SELECT * FROM tb_detail_pemesanan a, tb_produk b WHERE a.id_produk = b.id_produk AND a.id_pemesanan='$id' ");

                                                    while ($d = mysqli_fetch_array($transaksi)) {
                                                        $jml = $d['jumlah_produk'];
                                                        $total += $d['harga'];
                                                        $berat = $d['berat'] * $d['jumlah_produk'];;
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $no++; ?></td>
                                                            <td class="text-center"><?php echo $d['nama_produk']; ?></td>
                                                            <td class="text-center">Rp, <?php echo  number_format($d['harga']); ?></td>
                                                            <td class="text-center"><?php echo number_format($d['jumlah_produk']); ?></td>
                                                            <td class="text-center"><?php echo $berat; ?> Gram</td>
                                                            <td class="text-center"><?php echo "Rp. " . number_format($d['jumlah_produk'] * $d['harga']); ?></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="3" style="border: none"></td>
                                                        <th colspan="2" style="text-align:right">Ongkir (<?php echo $i['kurir']; ?> - <?= $i['total_berat']; ?> Gram)</th>
                                                        <td class="text-center"><?php echo "Rp. " . number_format($i['ongkir']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="border: none; "></td>
                                                        <th colspan="2" style="text-align:right">Total Bayar</th>
                                                        <td class="text-center"><?php echo "Rp. " . number_format($i['total_bayar']); ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <h5 class="mb-2">Status :</h5>
                                        <?php
                                        if ($i['status_pemesanan'] == 0) {
                                            echo "<a href='#' ><span class='badge badge-danger'>Gagal</span></a>";
                                        } elseif ($i['status_pemesanan'] == 1) {
                                            echo "<a href='#' ><span class='badge badge-danger'>Belum Dibayar</span></a>";
                                        } elseif ($i['status_pemesanan'] == 2) {
                                            echo "<a href='#' ><span class='badge badge-warning'>Sedang Diproses</span></a>";
                                        } elseif ($i['status_pemesanan'] == 3) {
                                            echo "<a href='#' ><span class='badge badge-info'>Sedang Dipacking</span></a>";
                                        } elseif ($i['status_pemesanan'] == 4) {
                                            echo "<a href='#' ><span class='badge badge-primary'>Sudah Dikirim</span></a>";
                                        } elseif ($i['status_pemesanan'] == 5) {
                                            echo "<a href='#' ><span class='badge badge-success'><i class='fa fa-check'> </i> Selesai</span></a>";
                                        }

                                        ?>

                                    <?php
                                }
                                    ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- .animated -->
                </div>
                <!-- /.content -->
                <div class="clearfix"></div>
            </div>
            <!-- /#right-panel -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->

            <!-- Custom scripts for all pages-->
            <!-- /.content -->
            <!-- /.content -->


            <?php
            include 'alerthapus.php';
            ?>
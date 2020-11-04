<?php include 'header2.php';
$nama = $_SESSION['nama_pelanggan'];
$alamat = $_SESSION['alamat'];
$no_hp = $_SESSION['no_hp'];
?>

<?php
$idp = $_SESSION['id_pelanggan'];
$id = $_GET['id'];
$invoice = mysqli_query($koneksi, "SELECT * FROM tb_pemesanan WHERE id_pelanggan='$idp' AND id_pemesanan='$id' ORDER BY id_pemesanan DESC");
while ($i = mysqli_fetch_array($invoice)) {
    $tgl = date('d-m-Y', strtotime($i['tanggal_checkout']));
    $lk = $i['link_pembayaran'];
?>

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="bg-light">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Invoice </li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <div class="section" style="background-color: #D5B487;">
        <div class=" container">
            <div class="row bg-white mt-4 mb-4 col-md-12" style="border-radius: 1%;">
                <div id="main" class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12 mt-3">
                            <div class="mt-4">
                                <p align="center"> <img src="gambar/logo1.png" alt="" style="width:250px"> </p>
                                <hr>
                                <p align="center"> <strong>TGL: <?= $tgl ?> | ID PEMESANAN : <?php echo $id; ?></strong> <br>
                                </p>
                            </div>
                            <HR>
                            <div class="pull-right">
                                <a href="invoice.php?id=<?php echo $_GET['id'] ?>" target="_blank" class="btn btn-default btn-sm mr-4"><i class="fa fa-print"></i>&nbsp; CETAK</a>
                            </div>
                            <strong>Nama &nbsp;&nbsp;&nbsp;</strong>: <?= $nama ?><br />
                            <strong>Alamat </strong>: <?= $alamat ?><br />
                            <strong>No Hp &nbsp;&nbsp;:</strong> <?= $no_hp ?><br />
                            <hr>
                            <div class="table-responsive">
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

                                        $transaksi = mysqli_query($koneksi, "SELECT * FROM tb_detail_pemesanan a, tb_produk b WHERE a.id_produk = b.id_produk AND a.id_pemesanan='$id' ");

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
                            <h5>Status :</h5>
                            <?php
                            if ($i['status_pemesanan'] == 0) {
                                echo "<a href='#' ><span class='label label-danger'>Gagal</span></a>";
                            } elseif ($i['status_pemesanan'] == 1) {
                                echo "<a href='#' ><span class='label label-danger'>Menunggu Pembayaran</span></a>";
                            } elseif ($i['status_pemesanan'] == 2) {
                                echo "<a href='#' ><span class='label label-warning'>Sedang Diproses</span></a>";
                            } elseif ($i['status_pemesanan'] == 3) {
                                echo "<a href='#' ><span class='label label-primary'>Sedang Dipacking</span></a>";
                            } elseif ($i['status_pemesanan'] == 4) {
                                echo "<a href='#' ><span class='label label-info'>Sudah Dikirim</span></a>";
                            } elseif ($i['status_pemesanan'] == 5) {
                                echo "<a href='#' ><span class='label label-success'>Selesai</span></a>";
                            }
                            ?>
                        <div class="mt-4 mb-4">
                            <hr>
                            <b>PEMBAYARAN DI TUJUKAN KEPADA :</b>
                            <p><img src="gambar/bca1.png" alt="" style="width:100px;  margin-top:4px; margin-bottom:4px"> </p>
                            <p>1550276344 - an: mukidi </p>
                            <hr>
                            <p>Jika sudah melakukan pembayaran melalui transfer bank silahkan kirim konfirmasi pembayaran : <a href="konfirpembayaran.php?id=<?php echo $id; ?>&tb=<?= $i['total_bayar'];?>" style="color:blue;" >Klik Di Sini</a></p>
                          <hr>
                          
                          <b>PEMBAYARAN LEWAT PAYMENT GATEWAY :</b>
                          <br>
                          <p><img src="gambar/payment.jpg" alt="" style="width:190px;  margin-top:4px; margin-bottom:4px"> </p>
                            
                             <p> Bayar Lewat Payment Gateaway :

                            <?php 
                            $tb  = $i['total_bayar'];
                            $ong = $i['ongkir']; 
                            $thp = $tb - $ong;
                            $a = "<a href='notifypayment.php?thp=".$thp."&idp=".$id."&ong=".$ong."' target='_blank' class='btn btn-success btn-sm text-white' '>Bayar Sekarang</a>";
                             
                            $b = " <a href='".$lk."' target='_blank' class='btn btn-success btn-sm text-white' '>Bayar Sekarang</a>";
                             
                        
                             if($lk !== ""){
                                 echo $b;
                             } else {
                                echo $a;
                             }
                             ?>
                             
                             </p>
                        </div>
                        <?php
                    }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
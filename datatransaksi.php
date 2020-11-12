<?php
include 'header2.php';
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="bg-light">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Data Transaksi</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<div class="section" style="background-color: #D5B487;">
    <div class="container mb-5 ">

        <div class="row bg-white mb-5 mt-5 " style="border-radius: 1%;">
            <?php
            include 'psidebar.php';
            ?>
            <div class="col-lg-9 mt-4 mb-4">

                <?php
                if (isset($_GET['alert'])) {
                    if ($_GET['alert'] == "gagal") {
                        echo "<div class='alert alert-danger'>Gambar gagal diupload!</div>";
                    } elseif ($_GET['alert'] == "sukses") {
                        echo "<div class='alert alert-success'>Transaksi berhasil dibuat, silahkan melakukan pembayaran!</div>";
                    } elseif ($_GET['alert'] == "terkirim") {
                        echo "<div class='alert alert-success'>Konfirmasi pembayaran berhasil terkirim, silahkan menunggu validasi dari admin!</div>";
                    }
                }
                ?>
                <div class="form-group">
                    <h3 class="title" for="">RIWAYAT DATA TRANSAKSI</h3>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID&nbsp;Pemesanan</th>
                                <th>Detail&nbsp;Pemesanan</th>
                                <th>Tgl&nbsp;Checkout</th>
                                <th>No&nbsp;Resi</th>
                                <th class="text-center">Status&nbsp;Pemesanan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['id_pelanggan'];
                            $invoice = mysqli_query($koneksi, "SELECT * FROM tb_detail_pemesanan a JOIN tb_pemesanan b ON a.id_pemesanan = b.id_pemesanan WHERE id_pelanggan= '$id' GROUP BY  a.id_pemesanan ORDER BY b.id_pemesanan ASC");
                            while ($i = mysqli_fetch_array($invoice)) {
                                $tanggal = date('d-m-Y', strtotime($i['tanggal_checkout']));
                                $idp = $i['id_pemesanan'];
                            ?>
                                <tr>
                                    <td> <?= $idp ?> </td>
                                    <td> <a class='btn btn-sm btn-default btn-xs' href="invoicetransaksi.php?id=<?php echo $i['id_pemesanan']; ?>"><i class="fa fa-file"></i> Lihat detail</a> </td>
                                    <td><?= $tanggal ?></td>

                                    <?php
                                    $ido = $i['id_pemesanan'];
                                    $sql = "SELECT * FROM tb_pengiriman WHERE id_pemesanan= '$ido' ";
                                    $query = mysqli_query($koneksi, $sql);
                                    $data = mysqli_fetch_array($query);
                                    $no_resi = $data['no_resi'];
                                    ?>
                                    <td class="text-left">
                                        <?php
                                        if ($i['status_pemesanan'] == 4) {
                                            echo $no_resi;
                                        } elseif ($i['status_pemesanan'] == 5) {
                                            echo $no_resi;
                                        } elseif ($i['status_pemesanan'] == 3) {
                                            echo "-";
                                        } elseif ($i['status_pemesanan'] == 2) {
                                            echo "-";
                                        } elseif ($i['status_pemesanan'] == 1) {
                                            echo "-";
                                        };
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($i['status_pemesanan'] == 0) {
                                            echo "<a href='#' ><span class='label label-danger'>Gagal</span></a>";
                                        } elseif ($i['status_pemesanan'] == 1) {
                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp'><span class='label label-danger'><i class='fa fa-money'></i> Menunggu pembayaran</span></a>";
                                        } elseif ($i['status_pemesanan'] == 2) {
                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp' ><span class='label label-success'><i class='fa fa-check-square-o'></i> Pembayaran Berhasil</span></a>";
                                        } elseif ($i['status_pemesanan'] == 3) {
                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp' ><span class='label label-info'><i class='fa fa-cube'></i> Sedang Dipacking</span></a>";
                                        } elseif ($i['status_pemesanan'] == 4) {
                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp'><span class='label label-primary'><i class='fa fa-truck'></i> Sudah Dikirim</span></a>";
                                        } elseif ($i['status_pemesanan'] == 5) {
                                            echo "<a href='#myModal' data-toggle='modal' data-id='$idp' ><span class='label label-success'><i class='fa fa-check'></i>  Selesai </span></a>";
                                        }
                                        ?>
                                    </td>

                                    <td class="text-center">
                                        <?php
                                        $idp = $i['id_pemesanan'];
                                        $tb = $i['total_bayar'];
                                        $ong = $i['ongkir'];
                                        $thp = $tb - $ong;
                                        $Status = $i['status_pemesanan'];
                                        $a1 = "<a href='notifypayment.php?thp=".$thp."&idp=".$idp."&ong=".$ong."' target='_blank' class='label label-info' '><i class='fa fa-dollar'></i> Bayar Sekarang</a>";

                                        $a2 = "<a class='btn btn-sm btn-success' href='validasi/selesai_act.php?id=$ido'><i class='fa fa-check'></i> Selesai</a>";

                                        if ($Status  == 1) {
                                            echo $a1;
                                        } else if ($Status  == 2) {
                                            echo '-';
                                        } else if ($Status  == 3) {
                                            echo '-';
                                        } else if ($Status  == 4) {
                                            echo $a2;
                                        } else {
                                            echo '-';
                                        };

                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <!-- modal bukti transfer -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <center>
                            <p><b>STATUS TRANSAKSI PEMESANAN </b> <button type="button" class="label label-danger" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
                        </center>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>


<script src="admin/vendor/jquery/jquery.min.js"></script>
<script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type: 'post',
                url: 'modal/statuspemesanan.php',
                data: 'rowid=' + rowid,
                success: function(data) {
                    $('.fetched-data').html(data); //menampilkan data ke dalam modal
                }
            });
        });
    });
</script>
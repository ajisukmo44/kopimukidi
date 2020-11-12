<?php session_start();
include '../koneksi.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM tb_pemesanan WHERE id_pemesanan = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $status = $data['status_pemesanan'];
    ?>
 <table class="table-stats ">
                            <tr>
                                <?php
                                if ($status == 0) {
                                    echo "<button class='btn btn-danger mb-2 mr-2 ' style='margin-left:15%'> <i class='fa fa-times'></i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 ' style='margin-left:15%'>  <i class='fa fa-times'></i> </button>";
                                }
                                ?>
                                <?php

                                if ($status == 1) {
                                    echo "<button class='btn btn-danger mb-2 mr-2 ' > <i class='fa fa-money'></i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 '> <i class='fa fa-money'></i></button>";
                                }
                                ?>
                                <?php
                                if ($status == 2) {
                                    echo "<button class='btn btn-success mb-2 mr-2 '> <i class='fa  fa-check-square-o'></i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 '>  <i class='fa  fa-check-square-o'></i></button>";
                                }
                                ?>
                                <?php
                                if ($status == 3) {
                                    echo "<button class='btn btn-info mb-2 mr-2 '><i class='fa  fa-cube'></i>  </button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 '> <i class='fa fa-cube'></i></button>";
                                }
                                ?>
                                <?php
                                if ($status == 4) {
                                    echo "<button class='btn btn-primary mb-2 mr-2'>  <i class='fa fa-truck'> </i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2'> <i class='fa fa-truck'> </i></button>";
                                }
                                ?>
                                <?php
                                if ($status == 5) {
                                    echo "<button class='btn btn-success mb-2 mr-2'> <i class='fa fa-check'></i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2'><i class='fa fa-check'></i> </button>";
                                }
                                ?>
                            </tr>
                        </table>
                        <hr>
 <?php
                        $sql = "SELECT * FROM tb_riwayat_status a JOIN tb_pemesanan b ON a.status_code = b.id_pemesanan WHERE b.id_pemesanan= '$id'";
    $result = $conn->query($sql);
    foreach ($result as $baris) {
        $status = $baris['status_pemesanan'];
        $status1 = $baris['status'];
        $waktu = date('d-m-Y h:i', strtotime($baris['waktu']));
?>
        <table class="table-stats">
            <tr>
                <?php if ($status1 == 1) {
                    echo  "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'>" . $waktu . "&nbsp; &nbsp; - &nbsp; Belum Dibayar</button></div>";
                } elseif ($status1 == 2) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Pembayaran Berhasil</button></div>";
                } elseif ($status1 == 3) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Sedang Dipacking </button></div>";
                } elseif ($status1 == 4) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Produk Telah Dikirim </button></div>";
                } elseif ($status1 == 5) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Selesai</button></div>";
                } elseif ($status1 == 0) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; gagal / batal</button></div>";
                } ?>
            </tr>
        </table>
<?php
    }
}
?>
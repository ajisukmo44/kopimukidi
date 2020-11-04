<?php session_start();
include '../koneksi.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    
    $sql = "SELECT * FROM tb_pembelian_bahanbaku WHERE id_pembelian = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $status = $data['status_pembelian'];
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
                                    echo "<button class='btn btn-dark mb-2 mr-2 ' > <i class='fa fa-edit'></i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 '> <i class='fa fa-edit'></i></button>";
                                }
                                ?>
                                <?php
                                if ($status == 2) {
                                    echo "<button class='btn btn-warning mb-2 mr-2 '> <i class='fa fa-money'></i></button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 '>  <i class='fa fa-money'></i></button>";
                                }
                                ?>
                                <?php
                                if ($status == 3) {
                                    echo "<button class='btn btn-info mb-2 mr-2 '><i class='fa  fa-handshake-o'></i>  </button>";
                                } else {
                                    echo "<button class='btn btn-secondary mb-2 mr-2 '> <i class='fa fa-handshake-o'></i></button>";
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
                        $sql = "SELECT * FROM tb_riwayat_status a JOIN tb_pembelian_bahanbaku b ON a.status_code = b.id_pembelian WHERE b.id_pembelian= '$id'";
                        $result = $conn->query($sql);
                        foreach ($result as $baris) {
                            $status = $baris['status_pembelian'];
                            $status1 = $baris['status'];
                            $waktu = date('d-m-Y h:i', strtotime($baris['waktu']));
                    ?>
        <table class="table-stats">
            <tr>
                <?php if ($status1 == 1) {
                    echo  "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'>" . $waktu . "&nbsp; &nbsp; - &nbsp; Permintaan Bahanbaku</button></div>";
                } elseif ($status1 == 2) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Penawaran Harga</button></div>";
                } elseif ($status1 == 3) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Harga Disetujui</button></div>";
                } elseif ($status1 == 4) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Bahanbaku Dikirim</button></div>";
                } elseif ($status1 == 5) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Selesai</button></div>";
                } elseif ($status1 == 0) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Batal / Ditolak</button></div>";
                } ?>
            </tr>
        </table>
<?php
    }
}
?>
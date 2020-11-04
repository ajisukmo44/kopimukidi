<?php session_start();
include '../koneksi.php';              // Panggil koneksi ke databas

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    
    $sql = "SELECT * FROM tb_produksi WHERE id_produksi = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($result);
    $status = $data['status_produksi'];
    ?>

<?php
                        if ($status == 0) {
                            echo "<button class='btn btn-danger mb-2 mr-2 ' style='margin-left:28%'> <i class='fa fa-times'></i></button>";
                        } else {
                            echo "<button class='btn btn-secondary mb-2 mr-2 ' style='margin-left:28%'>  <i class='fa fa-times'></i> </button>";
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
                            echo "<button class='btn btn-info mb-2 mr-2 '> <i class='fa fa-spinner'></i></button>";
                        } else {
                            echo "<button class='btn btn-secondary mb-2 mr-2 '>  <i class='fa fa-spinner'></i></button>";
                        }
                        ?>
                        <?php
                        if ($status == 3) {
                            echo "<button class='btn btn-success mb-2 mr-2'> <i class='fa fa-check'></i></button>";
                        } else {
                            echo "<button class='btn btn-secondary mb-2 mr-2'><i class='fa fa-check'></i> </button>";
                        }
                        ?>
    <hr>
    <?php
    $sql = "SELECT * FROM tb_riwayat_status a JOIN tb_produksi b ON a.status_code = b.id_produksi WHERE b.id_produksi= '$id'";
    $result = $conn->query($sql);
    foreach ($result as $baris) {
        $status = $baris['status_produksi'];
        $status1 = $baris['status'];
        $waktu = date('d-m-Y h:i', strtotime($baris['waktu']));

?>
        <table class="table-stats">
            <tr>
                <?php if ($status1 == 1) {
                    echo  "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'>" . $waktu . "&nbsp; &nbsp; - &nbsp; Permintaan Produksi</button></div>";
                } elseif ($status1 == 2) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; On Proses</button></div>";
                } elseif ($status1 == 3) {
                    echo "<div class='text-left'> <button class='btn btn-light mb-2 btn-block text-left'> " . $waktu . "&nbsp; &nbsp; - &nbsp; Produksi Selesai</button></div>";
                } ?>
            </tr>
        </table>
<?php

    }
}
?>
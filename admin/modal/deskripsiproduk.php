<?php session_start();
include '../koneksi.php';              // Panggil koneksi ke database

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    // mengambil data berdasarkan id
    $sql = "SELECT * FROM tb_produk WHERE id_produk = '$id' ";
    $result = $conn->query($sql);
    foreach ($result as $baris) {
        $des = $baris['deskripsi'];
?>
        <table class="table">
            <p><?= $des ?></p>

        </table>
<?php

    }
}
?>
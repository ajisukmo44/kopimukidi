<?php session_start();
include '../koneksi.php';              // Panggil koneksi ke database
include '../fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    $sql = "SELECT * FROM tb_produk WHERE id_produk = '$id' ";
    $result = $conn->query($sql);
    foreach ($result as $baris) {
        $idp = $baris['id_produk'];
        $np = $baris['nama_produk'];
?>

        <div class="modal-header">
            <center>
                <p><b>DATA PRODUKSI </b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
            </center>
            <hr>
            <div class="modal-body">
                <form action="aksipermintaan/produksi.php" method="POST">
                    <input type="hidden" class="form-control" name="id_produk" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="">Nama Produk</label>
                        <input type="text" class="form-control" name="namaproduk" value="<?= $np   ?>" readonly>
                    </div>
            <?php
        }
    }
            ?>
            <div class="form-group">
                <label for="">Pilih Bahanbaku</label>
                <select name="stok_bahanbaku" id="bahanbaku" class="form-control" onchange="stok()" required>
                    <option value="">-- Pilih Bahanbaku --</option>
                    <?php
                    $query = "SELECT * FROM tb_bahanbaku ORDER BY id_bahanbaku";
                    $sql = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($sql)) {
                        echo '<option value="' . $data['stok_bahanbaku'] . '" name="' . $data['id_bahanbaku'] . '">' . $data['nama_bahanbaku'] . ' - Stok Tersedia : ' . $data['stok_bahanbaku']  . ' Kg </option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Jumlah Bahanbaku Digunakan</label>
                <input type="number" class="form-control" id="stokproduk" min="1" max="*jsvariable*" name="jumlah_bahanbaku" placeholder="jumlah Satuan Kg">
            </div>

            <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Kirim Permintaan</button>
                </form>
            </div>

            <input type="hidden" id="hiddencontainer" name="hiddencontainer" />
            <script type="text/javascript">
                function stok() {
                    var tes = document.getElementById("bahanbaku").value;
                    var a = document.getElementById("stokproduk").value = tes;
                    var input = document.getElementById("stokproduk");
                    input.setAttribute("max", a);

                }
            </script>
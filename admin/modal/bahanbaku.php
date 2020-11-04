<?php session_start();
include '../koneksi.php';              // Panggil koneksi ke database
include '../fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
    $sql = "SELECT * FROM tb_bahanbaku WHERE id_bahanbaku = '$id' ";
    $result = $conn->query($sql);
    foreach ($result as $baris) {
        $nb = $baris['nama_bahanbaku'];
?>


        <div class="card-body">
            <h5 class='box-title'> KIRIM PERMINTAAN BAHANBAKU <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></h5>
            <hr>
            <div class="modal-body">
                <form action="aksipermintaan/bahanbaku.php" method="POST">
                    <h5>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_bahanbaku" value="<?= $id ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Bahanbaku</label>
                            <input type="text" class="form-control" name="namabahanbaku" value="<?= $nb ?>" readonly>
                        </div>
                <?php
            }
        }
                ?>

                <div class="form-group">
                    <label for="">Pilih Petani</label>
                    <select name="id_petani" id="id_petani" class="form-control" required>
                        <option value="">--Pilih Petani--</option>
                        <?php
                        $query = "SELECT * FROM tb_petani ORDER BY id_petani";
                        $sql = mysqli_query($conn, $query);
                        while ($data = mysqli_fetch_array($sql)) {
                            echo '<option value="' . $data['id_petani'] . '">' . $data['nama_petani'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Jumlah Bahanbaku / Kg</label>
                    <input type="text" class="form-control" name="jumlah" placeholder="jumlah bahanbaku ">
                </div>
                <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Kirim Permintaan</button>

                </form>

            </div>
        </div> <!-- /.card -->
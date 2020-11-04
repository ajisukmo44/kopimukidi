
<?php session_start();
include '../koneksi.php';              // Panggil koneksi ke database
include '../fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';
include '../fungsi/imgpreview.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
}
// mengambil data berdasarkan id
?>

<div class="modal-header">
    <center>
        <p>DATA PEMBELIAN BAHANBAKU <b></b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
    </center>
    <hr>
    <form action="komponen/pembelian/tambahpembelian.php" method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
            <label for="">Tanggal Pembelian</label>
            <input type="date" class="form-control" name="tanggal">
        </div>
    <div class="form-group">
        <label class=" form-control-label">Nama Bahanbaku</label>
        <div class="input-group">
                <select name="id_bahanbaku" id="id_bahanbaku" class="form-control" required>
                <option value="">-- Pilih Bahanbaku --</option>
                <?php
                $query = "SELECT * FROM tb_bahanbaku ORDER BY id_bahanbaku";
                $sql = mysqli_query($conn, $query);
                while ($data = mysqli_fetch_array($sql)) {
                    echo '<option value="' . $data['id_bahanbaku'] . '">' . $data['nama_bahanbaku'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
        <div class="form-group">
        <label class=" form-control-label">Nama Petani</label>
        <div class="input-group">
                <select name="id_petani" id="id_petani" class="form-control" required>
                <option value="">-- Pilih Petani --</option>
                <?php
                $query = "SELECT * FROM tb_petani ORDER BY id_petani";
                $sql = mysqli_query($conn, $query);
                while ($data = mysqli_fetch_array($sql)) {
                    echo '<option value="' . $data['id_petani'] . '">' . $data['nama_petani'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
        <div class="form-group">
            <label for="">Jumlah / Kg</label>
            <input type="text" class="form-control" name="jumlah" placeholder="jumlah pembelian">
        </div>
        <div class="form-group">
            <label for="">Total Harga</label>
            <input type="text" class="form-control" name="total_harga" placeholder="total harga">
        </div>
        <div class="form-group">
            <label for="">Nota Pembelian</label>
            <input type="file" class="form-control" id="nota_pemesanan" name="nota_pemesanan" onchange="tampilkanPreview(this,'preview1')" autocomplete="off">
        </div>
        <br><b>Preview Gambar</b><br>
        <img id="preview1" src="" alt="" width="25%" />
        <br>
        <br>    <br>
        <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Simpan</button>
    </form>
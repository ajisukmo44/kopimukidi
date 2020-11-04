
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
    <form action="komponen/pembelian/editpembelian.php" method="POST" enctype="multipart/form-data">
        <?php
    $query_view = mysqli_query($conn, "SELECT * FROM tb_pembelian_bahanbaku a JOIN tb_bahanbaku b ON a.id_bahanbaku = b.id_bahanbaku JOIN  tb_petani c ON a.id_petani = c.id_petani WHERE a.id_pembelian = '$id' ");
    //$result = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_assoc($query_view)) {
         $idp  =  $data['id_pembelian'];
         $tgl  =  $data['tanggal_pembelian'];
         $idb  =  $data['id_bahanbaku'];
         $nb   =  $data['nama_bahanbaku'];
         $idpp =  $data['id_petani'];
         $np   =  $data['nama_petani'];
         $nota =  $data['nota_pembelian'];
         $jml  =  $data['jumlah'];
         $th   =  $data['total_harga'];
     ?>
    
    
      <div class="form-group">
            <input type="hidden" class="form-control" name="id_pembelian" value="<?= $idp; ?>">
        </div>
    <div class="form-group">
            <label for="">Tanggal Pembelian</label>
            <input type="date" class="form-control" name="tanggal" value="<?= $tgl; ?>">
        </div>
    <div class="form-group">
        <label class=" form-control-label">Nama Bahanbaku</label>
        <div class="input-group">
                <select name="id_bahanbaku" id="id_bahanbaku" class="form-control" required>
                <option value="<?= $idb ?>"> <?= $nb; ?> </option>
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
                <option value="<?= $idpp ?>"> <?= $np; ?></option>
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
            <input type="text" class="form-control" name="jumlah" value="<?= $jml; ?>">
        </div>
        <div class="form-group">
            <label for="">Total Harga</label>
            <input type="text" class="form-control" name="total_harga" value="<?= $th; ?>">
        </div>
        <div class="form-group">
                                    <label class="form-control-label">Foto Nota Lama</label>
                                    <div class="input-group">
                                    </div>
                                    <img style="margin-left:0px; margin-right:45px; margin-bottom:15px;" src="images/notapembelian/<?= $nota; ?> " width="75px" height="75px" /><br>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Foto Nota Baru</label>
                                    <div class="input-group">
                                        <input type="file" id="nota" name="nota" multiple="" onchange="tampilkanPreview(this,'preview2')" class="form-control-file">
                                    </div>
                                    <br><b>Preview Gambar</b><br>
                                    <img id="preview2" src="" alt="" width="25%" />
                                </div>
                                <hr>
        <br> <br>
        <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Simpan</button>
        
        <?php }; ?>
    </form>


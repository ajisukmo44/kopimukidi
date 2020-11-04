<?php session_start();
include '../koneksi.php';              // Panggil koneksi ke database
include '../fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include '../fungsi/cek_session.php';

if ($_POST['rowid']) {
    $id = $_POST['rowid'];
}
// mengambil data berdasarkan id
?>

<div class="modal-header">
    <center>
        <p>DATA PENGIRIMAN <b><?= $id; ?></b> <button type="button" class="badge badge-light" data-dismiss="modal"><i class="fa fa-times"> </i></button></p>
    </center>
    <hr>
    <form action="validasi/statusdikirim.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id_pemesanan" value="<?= $id; ?>">
        </div>
        <div class="form-group">
            <label for="">Tanggal Pengiriman</label>
            <input type="date" class="form-control" name="tanggal_kirim">
        </div>
        <div class="form-group">
            <label for="">No Resi Pengiriman</label>
            <input type="text" class="form-control" name="no_resi" placeholder="masukan no resi">
        </div>
        <div class="form-group">
            <label for="">Nama Pengirim</label>
            <input type="text" class="form-control" name="nama_pengirim" autocomplete="off" placeholder="nama pengirim">
        </div>
        <button type="submit" class="btn btn-info btn-sm btn-block" name="submit">Simpan</button>
    </form>
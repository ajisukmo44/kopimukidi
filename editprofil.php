<?php include 'header2.php';

$idp = $_SESSION['id_pelanggan'];

$query  = "SELECT  * FROM tb_pelanggan WHERE id_pelanggan = '$idp' ";
$cari   = mysqli_query($koneksi, $query);
$data   = mysqli_fetch_array($cari);
$id   = $data['id_pelanggan'];
$nama   = $data['nama_pelanggan'];
$email  = $data['email'];
$nohp   = $data['no_hp'];
$alamat = $data['alamat'];
$username = $data['username'];
?>
<div class="section" style="background-color: #D5B487;">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row col-md-6 mt-5 mb-5 mr-5">
            <div class="col-md-11 mt-5 mb-5">
                <div class="order-summary clearfix">
                    <div class="row">
                        <img src="" alt="">
                    </div>
                </div>

            </div>

        </div>

        <div class="row bg-white col-md-6  mt-3 mb-5" style="border-radius: 2%;">
            <div class="col-md-11 mt-5 mb-5 ml-4">
                <div class="order-summary clearfix">
                    <?php
                    if (isset($_GET['alert'])) {
                        if ($_GET['alert'] == "duplikatusername") {
                            echo "<div class='alert alert-danger text-center'>Maaf username ini sudah digunakan, silahkan gunakan email yang lain.</div>";
                        } elseif ($_GET['alert'] == "duplikatemail") {
                            echo "<div class='alert alert-danger text-center'>Maaf email ini sudah digunakan, silahkan gunakan email yang lain.</div>";
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <form action="editprofil_act.php" method="post">

                                <div class="form-group">
                                    <label class="title" for="">EDIT PROFIL</label>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <input type="hidden" class="input" required="required" name="id_pelanggan" value="<?= $id_pelanggan ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="input" required="required" name="nama_pelanggan" value="<?= $nama ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="input" required="required" name="email" value="<?= $email ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Nomor HP</label>
                                    <input type="number" class="input" required="required" name="hp" value="<?= $nohp ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Lengkap</label>
                                    <input type="text" class="input" required="required" name="alamat" value="<?= $alamat ?>">
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" class="primary-btn btn-block mb-4" value="Update">
                                    <center><b><a href="pelanggan.php">
                                                Kembali ke Profil ?</a> </b> </center>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->
</body>

</html>
<?php include 'footer.php' ?>
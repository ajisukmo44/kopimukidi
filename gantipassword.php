<?php include 'header2.php';
// Panggil koneksi ke database
$id = $_SESSION['id_pelanggan'];
?>


<!-- BREADCRUMB -->
<div id="breadcrumb" class="bg-light">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Ganti Password</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<div class="section " style="background-color: #D5B487;">
    <div class="container">
        <div class="row bg-white mt-5 mb-5" style="border-radius:1%;">

            <?php
            include 'psidebar.php';
            ?>

            <div id="main" class="col-md-9 mt-5">
                <h4 class="ml-4">GANTI PASSWORD</h4>
                <hr>
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['alert'])) {
                        if ($_GET['alert'] == "sukses") {
                            echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
                        }
                    }
                    ?>

                    <form action="gantipassword_act.php" method="post">
                        <div class="form-group">
                            <input type="hidden" class="input" required="required" name="id_pelanggan" value="<?= $id ?>">
                        </div>
                        <div class=" form-group">
                            <label for="">Masukan Password Baru</label>
                            <input type="password" class="input" required="required" name="password" placeholder="Masukkan password .." min="5">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="primary-btn" value="Update Password">
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
</div>

<?php include 'footer.php'; ?>
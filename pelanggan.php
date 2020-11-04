<?php
include 'header2.php';
?>
<!-- BREADCRUMB -->
<div id="breadcrumb" class="bg-light">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li class="active">Profil Saya</li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<div class="section" style="background-color: #D5B487;">
    <div class="container">

        <div class="row bg-white mb-5 mt-5" style="border-radius: 1%;">
            <?php
            include 'psidebar.php';
            ?>
            <div id="main" class="col-md-9 mt-4">
                <h4>DATA PROFIL <a href="editprofil.php" class="btn primary-btn pb-1"><i class="fa fa-edit"></i> EDIT </a></h4>
                <table class="table table-bordered">
                    <tbody>
                        <?php
                        $id = $_SESSION['id_pelanggan'];
                        $pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id'");
                        while ($i = mysqli_fetch_array($pelanggan)) {
                        ?>
                            <tr>
                                <th width="20%">Nama</th>
                                <td><?php echo $i['nama_pelanggan'] ?></td>
                            </tr>
                            <tr>
                                <th width="20%">Email</th>
                                <td><?php echo $i['email'] ?></td>
                            </tr>
                            <tr>
                                <th>HP</th>
                                <td><?php echo $i['no_hp'] ?></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td><?php echo $i['alamat'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
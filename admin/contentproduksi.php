<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <?php
                    $sql = "SELECT * FROM tb_produksi WHERE status_produksi = 1";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_num_rows($result);
                    ?>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <a href="permintaanproduksi.php">
                                <div class="stat-text"><span><?= $data
                                                                ?> PERMINTAAN</span></div>
                                <div class="stat-heading">Belum Di Proses</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="fa fa-spinner "></i>
                    </div>
                    <?php
                    $sql = "SELECT * FROM tb_produksi WHERE status_produksi = 2";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_num_rows($result);
                    ?>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <a href="permintaanproduksi.php">
                                <div class="stat-text"><span><?= $data
                                                                ?> ON PROSES</span></div>
                                <div class="stat-heading">Sedang Diproduksi</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="fa fa-check"></i>
                    </div>
                    <?php
                    $sql = "SELECT * FROM tb_produksi WHERE status_produksi = 3";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_num_rows($result);
                    ?>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <a href="permintaanproduksi.php">
                                <div class="stat-text"><span><?= $data
                                                                ?> SELESAI</span></div>
                                <div class="stat-heading">Proses Produksi Selesai</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /Widgets -->


<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
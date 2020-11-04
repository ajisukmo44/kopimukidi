<div class='row'>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-4">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>
                    <?php
                    
                    $sql = "SELECT * FROM tb_produk";
                    $result = mysqli_query($conn, $sql);
                    $dataproduk = mysqli_num_rows($result);

                    $sql = "SELECT * FROM tb_produk WHERE stok < 10";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_num_rows($result);
                    ?>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <a href="datastokproduk.php">
                                <div class="stat-text"><span><?php if ($dataproduk > 0) {
                                                                    echo $dataproduk;
                                                                } else {
                                                                    echo "0";
                                                                }
                                                                ?> Produk</span></div>
                                <div class="stat-heading"><?php if ($data > 0) {
                                                                    echo $data;
                                                                } else {
                                                                    echo "0";
                                                                }
                                                                ?> Produk Stok Di Bawah 10 Pcs</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-3">
                        <i class="fa fa-exclamation-triangle"></i>
                    </div>

                    <?php
                    $sql = "SELECT * FROM tb_bahanbaku WHERE stok_bahanbaku < 10 ";
                    $result = mysqli_query($conn, $sql);
                    $data = mysqli_num_rows($result);

                    $sql = "SELECT * FROM tb_bahanbaku ";
                    $result = mysqli_query($conn, $sql);
                    $databahanbaku = mysqli_num_rows($result);
                    ?>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <a href="datastokbahanbaku.php">
                                <div class="stat-text"><span><?php if ($databahanbaku > 0) {
                                                                    echo $databahanbaku;
                                                                } else {
                                                                    echo "0";
                                                                }
                                                                ?> Bahanbaku</span></div>
                                <div class="stat-heading"><?php if ($data > 0) {
                                                                    echo $data;
                                                                } else {
                                                                    echo "0";
                                                                }
                                                                ?> Bahanbaku Stok Di Bawah 10 Kg</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='col-lg-3 col-md-6'>
        <div class='card'>
            <div class='card-body'>
                <a href="laporanpembelian.php">
                    <div class='stat-content'>
                        <div class='text-left dib'>
                            <div class='stat-icon dib flat-color-1'>
                                <i class='fa fa-file fa-2x'></i>
                                <div class='stat-text'> Laporan</div>
                                <div class='stat-heading'>Pembelian Bahanbaku</div>
                            </div>
                        </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class='col-lg-2 col-md-6'>
    <div class='card'>
        <div class='card-body'>
            <a href="laporanproduksi.php">
                <div class='stat-content'>
                    <div class='text-left dib'>
                        <div class='stat-icon dib flat-color-1'>
                            <i class='fa fa-file fa-2x'></i>
                            <div class='stat-text'> Laporan</div>
                            <div class='stat-heading'>Produksi</div>
                        </div>
                    </div>
            </a>
        </div>
    </div>
</div>
</div>
<div class='col-lg-2 col-md-6'>
    <div class='card'>
        <div class='card-body'>
            <a href="laporanpemesanan.php">
                <div class='stat-content'>
                    <div class='text-left dib'>
                        <div class='stat-icon dib flat-color-1'>
                            <i class='fa fa-file fa-2x'></i>
                            <div class='stat-text'> Laporan</div>
                            <div class='stat-heading'>Pemesanan</div>
                        </div>
                    </div>
            </a>
        </div>
    </div>
</div>
</div>
<div class='col-lg-2 col-md-6'>
    <div class='card'>
        <div class='card-body'>
            <a href="laporanpembayaran.php">
                <div class='stat-content'>
                    <div class='text-left dib'>
                        <div class='stat-icon dib flat-color-1'>
                            <i class='fa fa-file fa-2x'></i>
                            <div class='stat-text'> Laporan</div>
                            <div class='stat-heading'>Pembayaran</div>
                        </div>
                    </div>
            </a>
        </div>
    </div>
</div>
</div>
<div class='col-lg-2 col-md-6'>
    <div class='card'>
        <div class='card-body'>
            <a href="laporanpengiriman.php">
                <div class='stat-content'>
                    <div class='text-left dib'>
                        <div class='stat-icon dib flat-color-1'>
                            <i class='fa fa-file fa-2x'></i>
                            <div class='stat-text'> Laporan</div>
                            <div class='stat-heading'>Pengiriman</div>
                        </div>
                    </div>
            </a>
        </div>
    </div>
</div>
</div>


<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
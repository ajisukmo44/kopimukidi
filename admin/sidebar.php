<?php
include 'koneksi.php';              // Panggil koneksi ke database
include 'fungsi/cek_login.php';    // Panggil fungsi cek sudah login/belum
include 'fungsi/cek_session.php';      // session
?>

<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <!-- jika admin yang login -->
                <?php if ($sesen_jabatan == 'Admin') {
                    echo "
                    <li class='active'>
                    <a href='home.php'><i class='menu-icon fa fa-laptop'></i>$sesen_jabatan</a>
                    </li>
                   
                    <li class='menu-title'>Data Transaksi</li><!-- /.menu-title -->
                    <li class=''>
                        <a href='datapemesanan.php'><i class='menu-icon fa fa-list'></i>Pemesanan</a>
                    </li>
                    <li class=''>
                    <a href='datapembayaran.php'><i class='menu-icon fa fa-list'></i>Pembayaran</a>
                </li>
                <li class=''>
                <a href='datapengiriman.php'><i class='menu-icon fa fa-list'></i>Pengiriman</a>
            </li>
            <li class='menu-title'>Data Utama</li><!-- /.menu-title -->
            <li class=''>
                <a href='datauser.php'><i class='menu-icon fa fa-list'></i>Data User</a>
            </li>
            <li class=''>
            <a href='dataproduk.php'><i class='menu-icon fa fa-list'></i>Data Produk</a>
        </li>
        <li class=''>
            <a href='datakategori.php'><i class='menu-icon fa fa-list'></i>Data Kategori</a>
        </li>

    <li class=''>
        <a href='datapetani.php'><i class='menu-icon fa fa-list'></i>Data Petani</a>
    </li>
            <li class=''>
                <a href='datapelanggan.php'><i class='menu-icon fa fa-list'></i>Data Pelanggan</a>
            </li>
                ";
                }

                // jika bag.produksi yang login 
                else if ($sesen_jabatan == 'Bagian-Produksi') {
                    echo "
                    <li class='active'>
                    <a href='home.php'><i class='menu-icon fa fa-laptop'></i>$sesen_jabatan</a>
                    </li>
                    <li class='menu-title'>Info Data</li><!-- /.menu-title -->
                    <li class=''>
                        <a href='databahanbaku.php'> <i class='menu-icon fa fa-list'></i>Data Bahanbaku</a>
                    </li>
                    <li class=''>
                        <a href='permintaanproduksi.php'> <i class='menu-icon fa fa-list'></i>Permintaan Produksi</a>
                    </li>
                 
                    ";
                }
                // jika pemilik yang login 
                else if ($sesen_jabatan == 'Pemilik') {
                    echo "
                    <li class='active'>
                    <a href='home.php'><i class='menu-icon fa fa-laptop'></i>$sesen_jabatan</a>
                    </li>
                    <li class='menu-title'>Data Utama</li><!-- /.menu-title -->
                    <li class=''>
                        <a href='datapembelian.php'> <i class='menu-icon fa fa-list'></i>Pembelian Bahanbaku</a>
                    </li>
                    <li class=''>
                        <a href='dataproduksi.php'> <i class='menu-icon fa fa-list'></i>Permintaan Produksi</a>
                    </li>
                    <li class='menu-title'>Data Laporan</li><!-- /.menu-title -->
                    <li class=''>
                        <a href='laporanpembelian.php'> <i class='menu-icon fa fa-list'></i>Laporan Pembelian </a>
                    </li>
                    <li class=''>
                        <a href='laporanproduksi.php'> <i class='menu-icon fa fa-list'></i>Laporan Produksi</a>
                    </li>
                    <li class=''>
                        <a href='laporanpemesanan.php'> <i class='menu-icon fa fa-list'></i>Laporan Pemesanan</a>
                    </li>
                    <li class=''>
                        <a href='laporanpembayaran.php'> <i class='menu-icon fa fa-list'></i>Laporan Pembayaran</a>
                    </li>
                    <li class=''>
                        <a href='laporanpengiriman.php'> <i class='menu-icon fa fa-list'></i>Laporan Pengiriman</a>
                    </li>";
                }
                ?>
                <!-- /.navbar-collapse -->
            </ul>
        </div>
    </nav>
</aside>
<!-- /#left-panel -->
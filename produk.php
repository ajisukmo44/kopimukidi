<?php include 'header2.php'; ?>


<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
        </ul>
    </div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <?php

            ?>

            <div id="responsive-nav">
                <!-- category nav -->
                <div class="category-nav show-on-click">
                    <span class="category-header">Kategori Produk <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                        <?php
                        $data = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                            <li><a href="produk_kategori.php?id=<?php echo $d['id_kategori']; ?>"><?php echo $d['nama_kategori']; ?></a></li>
                        <?php
                        }
                        ?>
                        <li style="background: #999;"><a href="index.php" style="color: white">Tampilkan Semua</a></li>
                    </ul>
                </div>

                <!-- MAIN -->
                <div id="main" class="col-md-12">

                    <!-- store top filter -->
                    <form action="" method="get">
                        <div class="store-filter clearfix">
                            <div class="pull-right">
                                <div class="sort-filter">
                                    <span class="text-uppercase">Urutkan :</span>
                                    <select class="input" name="urutan" onchange="this.form.submit()">
                                        <option <?php if (isset($_GET['urutan']) && $_GET['urutan'] == "terbaru") {
                                                    echo "selected='selected'";
                                                } ?> value="terbaru">Terbaru</option>
                                        <option <?php if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") {
                                                    echo "selected='selected'";
                                                } ?> value="harga">Harga</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /store top filter -->

                    <!-- STORE -->
                    <div id="store">
                        <!-- row -->
                        <div class="row">

                            <?php
                            $halaman = 12;
                            $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                            $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                            $result = mysqli_query($koneksi, "SELECT * FROM tb_produk");
                            $total = mysqli_num_rows($result);
                            $pages = ceil($total / $halaman);
                            if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") {
                                if (isset($_GET['cari'])) {
                                    $cari = $_GET['cari'];
                                    $data = mysqli_query($koneksi, "SELECT * FROM a.tb_produk , b.tb_kategori  WHERE a.id_kategori = b.id_kategori and a.nama_produk like '%$cari%' ORDER BY a.harga ASC LIMIT $mulai, $halaman");
                                } else {
                                    $data = mysqli_query($koneksi, "SELECT * FROM tb_produk a, tb_kategori b WHERE a.id_kategori = b. id_kategori ORDER BY a.harga ASC LIMIT $mulai, $halaman");
                                }
                            } else {

                                if (isset($_GET['cari'])) {
                                    $cari = $_GET['cari'];
                                    $data = mysqli_query($koneksi, "SELECT * FROM tb_produk a, tb_kategori b WHERE a.id_kategori = b.id_kategori AND a.ama_produk LIKE '%$cari%' ORDER BY a.id_produk DESC LIMIT $mulai, $halaman");
                                } else {
                                    $data = mysqli_query($koneksi, "SELECT * FROM tb_produk a, tb_kategori b WHERE a.id_kategori = b.id_kategori ORDER BY a.id_produk DESC LIMIT $mulai, $halaman");
                                }
                            }
                            $no = $mulai + 1;

                            while ($d = mysqli_fetch_array($data)) {
                            ?>

                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="product product-single">
                                        <div class="product-thumb">
                                            <div class="product-label">
                                                <span><?php echo "Rp. " . number_format($d['harga']) . ",-"; ?> <?php if ($d['stok'] == 0) { ?> <del class="product-old-price">Kosong</del> <?php } ?></span>
                                            </div>

                                            <a href="produk_detail.php?id=<?php echo $d['id_produk'] ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail </a>

                                            <?php if ($d['foto_produk'] == "") { ?>
                                                <img src="admin/images/produk/produk.png" style="height: 250px">
                                            <?php } else { ?>
                                                <img src="admin/images/produk/<?php echo $d['foto_produk'] ?>" style="height: 250px">
                                            <?php } ?>
                                        </div>
                                        <div class="product-body">

                                            <h2 class="product-name"><a href="produk_detail.php?id=<?php echo $d['id_produk'] ?>"><?php echo $d['nama_produk']; ?></a></h2>
                                            <div class="product-btns" style="margin-top:12px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Product Single -->

                            <?php
                            }
                            ?>

                        </div>
                    </div>
                    <!-- /STORE -->


                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            <ul class="store-pages">
                                <li><span class="text-uppercase">Page:</span></li>
                                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                                    <?php if ($page == $i) { ?>
                                        <li class="active"><?php echo $i; ?></li>
                                    <?php } else { ?>

                                        <?php
                                        if (isset($_GET['cari'])) {
                                            $cari = $_GET['cari'];
                                            $c = "&cari=" . $cari;
                                        }
                                        if (isset($_GET['urutan']) && $_GET['urutan'] == "harga") {
                                        ?>
                                            <li><a href="?halaman=<?php echo $i; ?>&urutan=harga<?php echo $c ?>"><?php echo $i; ?></a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a href="?halaman=<?php echo $i; ?><?php echo $c ?>"><?php echo $i; ?></a></li>
                                        <?php
                                        }
                                        ?>

                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                </div>
                <!-- /MAIN -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->

    <?php include 'footer.php'; ?>
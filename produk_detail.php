<?php include 'header2.php'; ?>

<div id="breadcrumb" class="bg-light">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Detail Produk</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<?php
$id_produk = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM tb_produk a, tb_kategori b WHERE a.id_kategori = b.id_kategori AND id_produk ='$id_produk'");

while ($d = mysqli_fetch_array($data)) {

?>
	<div class="section" style="background-color: #D5B487;">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row bg-white mb-4" style="border-radius:1%;">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div id="product-main-view">
						<div class="product-view mt-5 ml-4">
							<?php if ($d['foto_produk'] == "") { ?>
								<img src="admin/images/produk/produk.png">
							<?php } else { ?>
								<img src="admin/images/produk/<?php echo $d['foto_produk'] ?>" style="width:300px;">
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-md-7 mt-5">
					<div class="product-body">
						<div class="product-label">
							<span style="padding:1px; padding-left:5px; padding-right:5px;background-color: #D5B487; color:#fff "><?php echo $d['nama_kategori']; ?></span>
						</div>
						<br>
						<h3 class="product-name"><?php echo $d['nama_produk']; ?></h3>
						<br>
						<hr>
						<p style="font-size: 15px;">
							<strong>Status :</strong>
							<?php
							if ($d['stok'] == 0) {
								echo "Kosong <i class='fa fa-times' style='color:red'></i>";
							} else {
								echo "Tersedia <i class='fa fa-check' style='color:#41B883'></i>";
							}
							?>
						</p>
						<hr>
						<p style="font-size: 15px;"><strong>Harga : </strong><?php echo "Rp. " . number_format($d['harga']) . ",-"; ?></p>
						<hr>
						<p style="font-size: 15px;">
							<strong>Stok &nbsp;&nbsp;&nbsp;:</strong>
							<?= $d['stok'] ?>
						</p>
						<hr>
						<p style="font-size: 15px;">
							<strong>Berat &nbsp;:</strong>
							<?= $d['berat'] ?> Gram
						</p>
					</div>
					<br>

					<form action="">
						<div class="product-btns">
							<a class="primary-btn add-to-cart" href="<?php
																		$idp = $d['id_produk'];
																		$stok = $d['stok'];
																		if ($stok == 0) {
																			echo " ";
																		} else {
																			echo "keranjang_masukkan.php?id=$idp&redirect=keranjang";
																		}; ?>
									"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</a>
						</div>
					</form>
				</div>
				<div class="col-md-11 mb-5 ml-5 mr-5">
					<div class="product-tab">
						<ul class="tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Deskripsi Produk</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab1" class="tab-pane fade in active">
								<p><?php echo $d['deskripsi']; ?></p>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- /Product Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
	</div>
<?php
}
?>

<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Rekomendasi Produk Lainnya</h3>
				</div>
			</div>
			<!-- section title -->


			<?php
			$data = mysqli_query($koneksi, "SELECT * FROM tb_produk a, tb_kategori b WHERE a.id_kategori = b.id_kategori ORDER BY rand() limit 4");
			while ($d = mysqli_fetch_array($data)) {
			?>

				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span><?php echo $d['nama_kategori'] ?></span>
							</div>

							<a href="produk_detail.php?id=<?php echo $d['id_produk'] ?>" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detail</a>

							<?php if ($d['foto_produk'] == "") { ?>
								<img src="gambar/sistem/produk.png" style="height: 250px">
							<?php } else { ?>
								<img src="admin/images/produk/<?php echo $d['foto_produk'] ?>" style="height: 250px">
							<?php } ?>
						</div>
						<div class="product-body">
							<h3 class="product-price"><?php echo "Rp. " . number_format($d['harga']) . ",-"; ?> <?php if ($d['stok'] == 0) { ?> <del class="product-old-price">Kosong</del> <?php } ?></h3>

							<h2 class="product-name"><a href="produk_detail.php?id=<?php echo $d['id_produk'] ?>"><?php echo $d['nama_produk']; ?></a></h2>
							<div class="product-btns">
								<a class="primary-btn add-to-cart btn-block text-center" href="keranjang_masukkan.php?id=<?php echo $d['id_produk']; ?>&redirect=detail"><i class="fa fa-shopping-cart"></i> Masukkan Keranjang</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->

			<?php
			}
			?>


		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>

<?php include 'footer.php'; ?>
<?php include 'header2.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="bg-light">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Keranjang</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->
<!-- <pre>
	<?php
	print_r($_SESSION);
	?>
</pre> -->
<!-- section -->
<div class="section" style="background-color: #D5B487;">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row mt-5 mb-5" style="background-color: #ffffff; border-radius:1%">
			<div class="col-md-12">
				<form method="post" action="keranjang_update.php">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title"> keranjang belanja</h3>
						</div>
						<?php
						if (isset($_GET['alert'])) {
							if ($_GET['alert'] == "keranjang_kosong") {
								echo "<div class='alert alert-danger text-center'>Tidak bisa checkout, karena keranjang belanja masih kosong. <br/> Silahkan belanja terlebih dulu.</div>";
							}
						}
						?>
						<?php
						if (isset($_SESSION['keranjang'])) {
							$jumlah_isi_keranjang = count($_SESSION['keranjang']);
							if ($jumlah_isi_keranjang != 0) {
						?>

								<table class="table">
									<thead>
										<tr>
											<th>No</th>
											<th>Produk</th>
											<th>Nama Produk</th>
											<th class="text-center">Harga</th>
											<th class="text-center">Stok</th>
											<th class="text-center">Berat</th>
											<th class="text-center">Jumlah</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>

										<?php
										// cek apakah produk sudah ada dalam keranjang

										$no = 1;
										$jumlah_total = 0;
										$total = 0;
										$berat_total = 0;
										$berat = 0;
										for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
											$id_produk = $_SESSION['keranjang'][$a]['produk'];
											$jml = $_SESSION['keranjang'][$a]['jumlah'];

											$isi = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
											$i = mysqli_fetch_assoc($isi);

											$stok = $i['stok'];
											$total += $i['harga'] * $jml;
											$jumlah_total += $total;
											$berat += $i['berat'] * $jml;
											$berat_total += $berat;
										?>
											<tr>
												<td><?= $no++; ?></td>
												<td class="thumb">
													<?php if ($i['foto_produk'] == "") { ?>
														<img src="admin/images/produk/produk.png">
													<?php } else { ?>
														<img src="admin/images/produk/<?php echo $i['foto_produk']; ?>" style="width: 40px; height:30px">
													<?php } ?>
												</td>
												<td class="details">
													<a href="produk_detail.php?id=<?php echo $i['id_produk'] ?>"><?php echo $i['nama_produk'] ?></a>
												</td>
												<td class="text-center"><?php echo "Rp. " . number_format($i['harga']) . " ,-"; ?></td>
												<td class="text-center"><?php echo $i['stok']; ?> </td>
												<td class="text-center"><?php echo $i['berat']; ?> Gram</td>
												<td class="qty text-center">
													<input class="harga" id="harga_<?php echo $i['id_produk'] ?>" type="hidden" value="<?php echo $i['harga']; ?>">
													<input name="produk[]" value="<?php echo $i['id_produk'] ?>" type="hidden">

								<input style="text-align:center" max="<?= $stok ?>" min="1" name="jumlah[]" id="jumlah_<?php echo $i['id_produk'] ?>" nomor="<?php echo $i['id_produk'] ?>" type="number" value="<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>" required>
												
												
												</td>
												<!-- <td class="total text-center"><?php echo "Rp. " . number_format($total) . " ,-"; ?></td> -->
												<td class="text-center"><a href="keranjang_hapus.php?id=<?php echo $i['id_produk']; ?>&redirect=keranjang"><i class="fa fa-2x fa-close"></i></a></td>
											</tr>

										<?php
											$total = 0;
										}
										?>

									</tbody>
									<!-- <tfoot>
										<tr>
											<th class="empty" colspan="5"></th>
											<th class="text-center">TOTAL HARGA</th>
											<th colspan="2" class="text-center"><?php echo "Rp. " . number_format($jumlah_total) . " ,-"; ?></th>
										</tr>
									</tfoot> -->
								</table>

								<div class="pull-right mb-5">
									<a href="index.php"><input type="button" class="main-btn" value="Kembali"></a>
									<input type="submit" class="primary-btn" value="Checkout">
									<!-- <a href="checkout.php"><input type="button" class="primary-btn" value="Checkout">
									</a> -->
								</div>

						<?php
							} else {
								echo "<br><br><br><h3><center>Silahkan Pilih Produk Terlebih<a href='index.php'> Dahulu</a> !</center></h3><br><br><br>";
							}
						} else {
							echo "<br><br><br><h3><center>Silahkan Pilih Produk Terlebih <a href='index.php'> Dahulu</a> !</center></h3><br><br><br>";
						}
						?>

					</div>
				</form>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<?php include 'footer.php'; ?>
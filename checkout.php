<?php include 'header2.php';

$nm = $_SESSION['nama_pelanggan'];
$hp = $_SESSION['no_hp'];
$alt = $_SESSION['alamat'];
?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="bg-light">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Checkout Pemesanan</li>
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
	<div class="container bg-white mt-2 mb-2" style="border-radius:1%">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="order-summary clearfix">
					<div class="section-title">
						<h3 class="title">DATA CHECKOUT PEMESANAN</h3>
					</div>
					<form method="post" action="checkout_act.php">
						<div class="col-lg-5 ">
							<div class="row ">
								<div class="col-lg-12">
									<br>
									<h5 class="text-center">INFORMASI PELANGGAN</h5>
									<hr>
									<div class="form-group">
										<p><label>Nama :</label> <?= $nm ?></p>
									</div>
									<div class="form-group">
										<div class="form-group">
											<p><label>No Hp :</label> <?= $hp ?></p>
										</div>
									</div>
									<div class="form-group">
										<div class="form-group">
											<p><label>Alamat :</label> <?= $alt ?></p>
										</div>
									</div>
									<hr>
									<?php
									$curl = curl_init();
									curl_setopt_array($curl, array(
										CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
										CURLOPT_RETURNTRANSFER => true,
										CURLOPT_ENCODING => "",
										CURLOPT_MAXREDIRS => 10,
										CURLOPT_TIMEOUT => 30,
										CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
										CURLOPT_CUSTOMREQUEST => "GET",
										CURLOPT_HTTPHEADER => array(
											"key: 8f22875183c8c65879ef1ed0615d3371"
										),
									));
									$response = curl_exec($curl);
									$err = curl_error($curl);
									$data_provinsi = json_decode($response, true);
									?>
									<div class="form-group">
										<label>Provinsi Tujuan</label>
										<select name='provinsi' id='provinsi' class="input" required>
											<option>Pilih Provinsi Tujuan</option>
											<?php
											for ($i = 0; $i < count($data_provinsi['rajaongkir']['results']); $i++) {
												echo "<option value='" . $data_provinsi['rajaongkir']['results'][$i]['province_id'] . "'>" . $data_provinsi['rajaongkir']['results'][$i]['province'] . "</option>";
											}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Kabupaten</label>
										<select id="kabupaten" name="kabupaten" class="input" required></select>
									</div>
									<input name="kurir" id="kurir" value="" required="required" type="hidden">
									<input name="ongkir2" id="ongkir2" value="" required="required" type="hidden">
									<input name="service" id="service" value="" required="required" type="hidden">

									<input name="provinsi2" id="provinsi2" value="" required="required" type="hidden">
									<input name="kabupaten2" id="kabupaten2" value="" required="required" type="hidden">
									<div id="ongkir"></div>

									<br>

								</div>
							</div>



						</div>
						<div class="col-lg-7">

							<?php
							if (isset($_SESSION['keranjang'])) {

								$jumlah_isi_keranjang = count($_SESSION['keranjang']);

								if ($jumlah_isi_keranjang != 0) {

							?>


									<table class="shopping-cart-table table">
										<thead>
											<tr>
												<th>Nama&nbsp;Produk</th>
												<th class="text-center">Harga</th>
												<th class="text-center">Jumlah</th>
												<th class="text-center">Total Berat</th>
												<th class="text-center">Total Harga</th>
											</tr>
										</thead>
										<tbody>

											<?php
											// cek apakah produk sudah ada dalam keranjang
											$jumlah_total = 0;
											$total = 0;
											$berat_total = 0;
											$berat = 0;
											for ($a = 0; $a < $jumlah_isi_keranjang; $a++) {
												$id_produk = $_SESSION['keranjang'][$a]['produk'];
												$jml = $_SESSION['keranjang'][$a]['jumlah'];

												$isi = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
												$i = mysqli_fetch_assoc($isi);

												$total += $i['harga'] * $jml;
												$jumlah_total += $total;

												$berat += $i['berat'] * $jml;
												$berat_total += $berat;
											?>

												<tr>
													<td>
														<a href="produk_detail.php?id=<?php echo $i['produk_id'] ?>"><?php echo $i['nama_produk'] ?></a>
													</td>

													<td class="text-center">
														<?php echo number_format($i['harga']); ?>
													</td>
													<td class="qty text-center">
														<?php echo $_SESSION['keranjang'][$a]['jumlah']; ?>
													</td>
													<td class="text-center">
														<?php echo $berat; ?> Gram
													</td>
													<td class="text-center">
														<p class=" total_harga" id="total_<?php echo $i['produk_id'] ?>"><?php echo "Rp. " . number_format($total) . " ,-"; ?></p>
													</td>
												</tr>

											<?php

												$berat = 0;
												$total = 0;
											}

											?>

										</tbody>
										<tfoot>
											<tr>
												<th class="empty" colspan="3"></th>
												<th class="bg-white">ONGKIR ( <?php echo $berat_total; ?> Gram)</th>
												<td class="text-center bg-white"><span id="tampil_ongkir"><?php echo "Rp. 0 ,-"; ?></span></td>
											</tr>
											<tr>
												<th class="empty" colspan="3"></th>
												<th class="bg-white">TOTAL BAYAR</th>
												<th class="text-center bg-white"><span id="tampil_total"><?php echo "Rp. " . number_format($jumlah_total) . " ,-"; ?></span></th>
											</tr>
										</tfoot>
									</table>

									<input name="berat" id="berat2" value="<?php echo $berat_total ?>" type="hidden">

									<input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $jumlah_total; ?>">

							<?php
								} else {

									echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
								}
							} else {
								echo "<br><br><br><h3><center>Keranjang Masih Kosong. Yuk <a href='index.php'>belanja</a> !</center></h3><br><br><br>";
							}
							?>
							<div class="row mb-5">
								<div class="col-lg-12">

									<div class="pull-right" style="margin-right:4px">
										<input type="submit" class="primary-btn" value="SELESAIKAN & BAYAR">
									</div>
									<div class="pull-right " style="margin-right:7px">
										<a class="main-btn" href="keranjang.php"> KEMBALI KE KERANJANG</a>
									</div>

								</div>
							</div>

						</div>
					</form>


				</div>






			</div>

		</div>

	</div>
	<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /section -->



<?php include 'footer.php'; ?>
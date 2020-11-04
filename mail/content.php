<?php
$nama = $_SESSION['nama_pelanggan'];
$alamat = $_SESSION['alamat'];
$no_hp = $_SESSION['no_hp'];
?>

<?php
$idp = $_SESSION['id_pelanggan'];
$id = $_GET['id'];
$invoice = mysqli_query($koneksi, "SELECT * FROM tb_pemesanan WHERE id_pelanggan='$idp' AND id_pemesanan='$id' ORDER BY id_pemesanan DESC");
while ($i = mysqli_fetch_array($invoice)) {
	$tgl = date('d-m-Y', strtotime($i['tanggal_checkout']));
?>

	<html>

	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
	</head>

	<body>
		<div style="float: left;margin-right: 10px;">
			<img src="cid:logo_mynotescode3=" alt="Logo" style="height: 50px">
		</div>

		<div style="clear: both"></div>
		<hr />

		<!-- /BREADCRUMB -->

		<div class="container">
			<div class="row">

				<div class="col-lg-12">

					<h4>INVOICE PEMESANAN | ORDER ID : <?php echo $i['id_pemesanan'] ?></h4>
					<HR>
					<div class="container">
						<strong>Nama &nbsp;&nbsp;&nbsp;</strong>: <?= $nama ?><br />
						<strong>Alamat </strong>: <?= $alamat ?><br />
						<strong>No Hp &nbsp;&nbsp;:</strong> <?= $no_hp ?><br />
						<br />

						<table border="1" cellpadding="4" cellspacing="0">
							<tr>
								<th class="text-center">NO</th>
								<th colspan="2">Produk</th>
								<th class="text-center">Harga</th>
								<th class="text-center">Jumlah</th>
								<th class="text-center">Total Harga</th>
							</tr>
							<tbody>
								<?php
								$no = 1;
								$total = 0;
								$transaksi = mysqli_query($koneksi, "SELECT * FROM tb_detail_pemesanan, tb_produk WHERE tb_detail_pemesanan.id_produk = tb_produk.id_produk AND tb_detail_pemesanan.id_pemesanan='$id' ");

								while ($d = mysqli_fetch_array($transaksi)) {
									$total += $d['harga'];
								?>
									<tr>
										<td class="text-center"><?php echo $no++; ?></td>
										<td colspan="2"><?php echo $d['nama_produk']; ?></td>
										<td class="text-center"><?php echo "Rp. " . number_format($d['harga']) . ",-"; ?></td>
										<td style="text-align:center"><?php echo number_format($d['jumlah_produk']); ?></td>
										<td class="text-center"><?php echo "Rp. " . number_format($d['jumlah_produk'] * $d['harga']) . " ,-"; ?></td>
									</tr>
								<?php
								}
								?>
							</tbody>
							<tfoot>

								<td colspan="4" style="border: none"></td>
								<th>Ongkir (<?php echo $i['kurir'] ?>)</th>
								<td class="text-center"><?php echo "Rp. " . number_format($i['ongkir']) . " ,-"; ?></td>
								</tr>
								<tr>
									<td colspan="4" style="border: none"></td>
									<th>Total Bayar</th>
									<td class="text-center"><?php echo "Rp. " . number_format($i['total_bayar']) . " ,-"; ?></td>
								</tr>
							</tfoot>
						</table>
						</table>


					</div>
				</div>
			<?php
		}
			?>
			</div>
		</div>
		<hr>
		<div style="margin-left:15px">
			<b>PEMBAYARAN DI TUJUKAN KEPADA :</b>
			<p> <img src="cid:logo_mynotescode2" alt="Logo" style="width:130px;  margin-top:4px; margin-bottom:4px"> </p>
			<p>1550276344 - an: mukidi </p>
		</div>
		<hr>
		<div style="margin-left:15px">
			<p>Rumah Kopi Mukidi. Dusun Jambon, Kecamatan Gandurejo Bulu, Kabupaten Temanggung, Jawa Tengah. CP : 081227973978 </p>
		</div>
		<hr>
		</div>
		</div>
		</div>
	</body>

	</html>
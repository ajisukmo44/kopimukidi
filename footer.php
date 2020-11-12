  <footer class="site-footer bg-light" style="border:1px;" id="footer-section">
  	<div class="container">
  		<div class="row">
  			<div class="col-md-4 mr-5">
  				<h2 class="footer-heading mb-3 ">Tentang Kami</h2>
  				<p style="text-align: justify;">Kopi Mukidi merupakan salah satu merk produk kopi lokal yang cukup dikenal di Indonesia. Kopi Mukidi lahir dari gagasan konsep kemandirian petani di lereng gunung sumbing. </p>
  				<p style="text-align: justify;">
  					Alamat: Dusun Jambon, Kecamatan Gandurejo Bulu, Kabupaten Temanggung, Jawa Tengah (Wa &nbsp;:&nbsp;087719052174 )</p>
  				<br><br>
  			</div>

  			<div class="col-md-2 ">
  				<h2 class="footer-heading mb-4">Pengiriman</h2>
  				<img src="gambar/jne.png" alt="Image" class="img-fluid rounded w-95 mb-3" style="width: 50%;">
  				<img src="gambar/tiki.png" alt="Image" class="img-fluid rounded w-80 mb-3" style="width: 50%;">
  				<img src="gambar/pos.png" alt="Image" class="img-fluid rounded w-80 mb-3" style="width: 50%;">
  			</div>
  			<div class=" col-md-3">
  				<h2 class="footer-heading mb-4">Pembayaran </h2>
  				<img src="gambar/pgwy.png" alt="Image" class="img-fluid rounded w-95 mb-3" style="width: 100%;">
  			</div>
  			<div class="col-md-2 ml-auto">
  				<h2 class="footer-heading mb-4">Social Media</h2>
  				<p><a href="https://www.instagram.com/kopimukidi/"> <img src="gambar/ig.png" alt="Image" class="img-fluid rounded mb-2" style="width: 70%;"></a>
  					<a href="https://wa.me/6287719052174?text=Saya%20Admin%20saya%20mau%20beli%20produk%20kopi"> <img src="gambar/waaa.png" alt="Image" class="img-fluid rounded mb-2" style="width: 70%;"></a>
  					<a href="https://goo.gl/maps/zaNYzJ97bGnu4G5T6"> <img src="gambar/maps.png" alt="Image" class="img-fluid rounded mb-2" style="width: 70%;"></a>
  				</p>
  			</div>
  		</div>
  		<div class="row pt-3 mt-0 text-center">
  			<div class="col-md-12">
  				<div class="border-top pt-0">
  					<p>
  						<p>
  							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  							&copy;<script>
  								document.write(new Date().getFullYear());
  							</script> <a href="https://colorlib.com" target="_blank"> </a>Rumah Kopi Mukidi
  							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  						</p>
  					</p>
  				</div>
  			</div>

  		</div>
  	</div>

  	</div>
  </footer>
  <!-- /FOOTER -->

  <!-- jQuery Plugins -->


  <script src="frontend/js/jquery.min.js"></script>
  <script src="frontend/js/bootstrap.min.js"></script>
  <script src="frontend/js/slick.min.js"></script>
  <script src="frontend/js/nouislider.min.js"></script>
  <script src="frontend/js/main.js"></script>
  <script src="kopi/js/jquery-3.3.1.min.js"></script>
  <script src="kopi/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="kopi/js/jquery-ui.js"></script>
  <script src="kopi/js/popper.min.js"></script>
  <script src="kopi/js/bootstrap.min.js"></script>
  <script src="kopi/js/owl.carousel.min.js"></script>
  <script src="kopi/js/jquery.stellar.min.js"></script>
  <script src="kopi/js/jquery.countdown.min.js"></script>
  <script src="kopi/js/bootstrap-datepicker.min.js"></script>
  <script src="kopi/js/jquery.easing.1.3.js"></script>
  <script src="kopi/js/aos.js"></script>
  <script src="kopi/js/jquery.fancybox.min.js"></script>
  <script src="kopi/js/jquery.sticky.js"></script>
  <script src="kopi/js/main.js"></script>

  </body>

  <script>
  	//password
  	function myFunction() {
  		var x = document.getElementById("password");
  		if (x.type === "password") {
  			x.type = "text";
  		} else {
  			x.type = "password";
  		}
  	};

  	//keranjang
  	$(document).ready(function() {
  		function numberWithCommas(x) {
  			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  		}
  		$('.jumlah').on("keyup", function() {
  			var nomor = $(this).attr('nomor');
  			var jumlah = $(this).val();
  			var harga = $("#harga_" + nomor).val();
  			var total = jumlah * harga;
  			var t = numberWithCommas(total);
  			$("#total_" + nomor).text("Rp. " + t + " ,-");
  		});
  	});

  	//kabupaten
  	$(document).ready(function() {
  		$('#provinsi').change(function() {
  			var prov = $('#provinsi').val();
  			var provinsi = $("#provinsi :selected").text();
  			$.ajax({
  				type: 'GET',
  				url: 'rajaongkir/cek_kabupaten.php',
  				data: 'prov_id=' + prov,
  				success: function(data) {
  					$("#kabupaten").html(data);
  					$("#provinsi2").val(provinsi);
  				}
  			});
  		});

  		//kabupaten
  		$(document).on("change", "#kabupaten", function() {
  			var asal = 152;
  			var kab = $('#kabupaten').val();
  			var kurir = "a";
  			var berat = $('#berat2').val();
  			var kabupaten = $("#kabupaten :selected").text();
  			$.ajax({
  				type: 'POST',
  				url: 'rajaongkir/cek_ongkir.php',
  				data: {
  					'kab_id': kab,
  					'kurir': kurir,
  					'asal': asal,
  					'berat': berat
  				},
  				success: function(data) {
  					$("#ongkir").html(data);
  					// alert(data);

  					// $("#provinsi").val(prov);
  					$("#kabupaten2").val(kabupaten);

  				}
  			});
  		});

  		function format_angka(x) {
  			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  		}
  		$(document).on("change", '.pilih-kurir', function(event) {
  			// alert("new link clicked!");
  			var kurir = $(this).attr("kurir");
  			var service = $(this).attr("service");
  			var ongkir = $(this).attr("harga");
  			var total_bayar = $("#total_bayar").val();
  			$("#kurir").val(kurir);
  			$("#service").val(service);
  			$("#ongkir2").val(ongkir);
  			var total = parseInt(total_bayar) + parseInt(ongkir);
  			$("#tampil_ongkir").text("Rp. " + format_angka(ongkir) + " ,-");
  			$("#tampil_total").text("Rp. " + format_angka(total) + " ,-");
  		});

  		function handleSelect(elm) {
  			window.location = elm.value + ".php";
  		}
  	});
  </script>

  </html>
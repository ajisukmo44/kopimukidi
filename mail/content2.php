<?php
$email = $_POST['email'];
?>

<html>

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="content-type">
</head>

<body>

	<div style="clear: both"></div>

	<!-- /BREADCRUMB -->

	<div class="container">
		<div class="row">

			<div class="col-lg-12">
				<HR>
				<form action="http://localhost/kopimukidi/mail/prosesubah.php" method="post">
					<p>Masukan password Baru anda!</p>
					<div class="container">
						Password Baru : <input type="password" name="password">
						<input type="hidden" name="email" value="<?= $email ?>">
						<button type="submit" name="submit" style="background-color:#41B883; color:#fff">simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
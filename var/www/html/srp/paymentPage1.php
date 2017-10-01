<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = 1;
			$today = date('Y-m-d');

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title>Stoneridge Place At Pleasanton</title>

		<!-- Web Fonts-->
		<link href='https://fonts.googleapis.com/css?family=Poppins:500,600,700' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Hind:400,600,700' rel='stylesheet'>
		<link href='https://fonts.googleapis.com/css?family=Lora:400i' rel='stylesheet'>
		<!-- Bootstrap core CSS-->
		<link href='assets/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<!-- Icon Fonts-->
		<link href='assets/css/font-awesome.min.css' rel='stylesheet'>
		<link href='assets/css/linea-arrows.css' rel='stylesheet'>
		<link href='assets/css/linea-icons.css' rel='stylesheet'>
		<!-- Plugins-->
		<link href='assets/css/magnific-popup.css' rel='stylesheet'>
		<link href='assets/css/vertical.min.css' rel='stylesheet'>
		<link href='assets/css/pace-theme-minimal.css' rel='stylesheet'>
		<link href='assets/css/animate.css' rel='stylesheet'>
		<!-- Template core CSS-->
		<link href='assets/css/template.min.css' rel='stylesheet'>

	</head>

	<body>

		<!-- Layout-->
		<div class='layout'>

			<!-- Wrapper-->
			<div class='wrapper'>

				1

				<?php

					echo "

						<section class='module module-gray p-b-0'>

							<div class='container'>
								
								<form method='POST' action='https://hoaboardtime.com/paymentPageSRP.php'>

									<select class='form-control' name='id' id='id' required>

										<option selected disabled value=''>Select User</option>

										";

										$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_until>='$today'");

												while($row = pg_fetch_assoc($result))
												{

													$hoa_id = $row['hoa_id'];
													$name = $row['firstname'];
													$name .= " ";
													$name .= $row['lastname'];

													echo "<option value='$hoa_id'>$name</option>";

												}

										echo "

									</select>

									<button name='submit' id='submit' type='submit'>Make Payment</button>

								</form>

							</div>

						</section>

					";

				?>

				2

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>
			<!-- Wrapper end-->

		</div>
		<!-- Layout end-->

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<!--<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>-->
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
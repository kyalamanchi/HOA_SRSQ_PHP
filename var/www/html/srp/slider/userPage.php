<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$email = $_SESSION['hoa_alchemy_email'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$username = $_SESSION['hoa_alchemy_username'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$community_code = $_SESSION['hoa_alchemy_community_code'];
	$community_name = $_SESSION['hoa_alchemy_community_name'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $community_code; ?> - Confirm User Identity</title>

		<!-- Web Fonts-->
		<link href="https://fonts.googleapis.com/css?family=Poppins:500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Hind:400,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lora:400i" rel="stylesheet">
		<!-- Bootstrap core CSS-->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Icon Fonts-->
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/linea-arrows.css" rel="stylesheet">
		<link href="assets/css/linea-icons.css" rel="stylesheet">
		<!-- Plugins-->
		<link href="assets/css/owl.carousel.css" rel="stylesheet">
		<link href="assets/css/flexslider.css" rel="stylesheet">
		<link href="assets/css/magnific-popup.css" rel="stylesheet">
		<link href="assets/css/vertical.min.css" rel="stylesheet">
		<link href="assets/css/pace-theme-minimal.css" rel="stylesheet">
		<link href="assets/css/animate.css" rel="stylesheet">
		<!-- Template core CSS-->
		<link href="assets/css/template.min.css" rel="stylesheet">

	</head>

	<body>

		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-center'>

						<a class='inner-brand'><h3 style='color: green;'><?php echo $community_code; ?></h3></a>

					</div>

					<!-- Navigation-->
					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>
				
							<div class='inner-nav'>
						
								<ul>

									<li><a><span>Hello <?php echo $username; ?></span></a></li>

									<li><a href='logout.php'><span><i class='fa fa-sign-out'></i> Log Out</span></a></li>

								</ul>

							</div>

						</div>

					</div>
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 id='page_title1' class='h5'>User Details</h1>
								<h1 id='page_title2' class='h5'>Home Details</h1>
								<h1 id='page_title3' class='h5'>Disclosures</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>
							
						<div id='user_details_div' class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12' style='color: black;'>
										
							<form method='POST' action='updateHOAID.php' class='ajax1'>

								<?php

									$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

									$user_firstname = $row['firstname'];
									$user_lastname = $row['lastname'];
									$user_email = $row['email'];
									$user_cell_no = $row['cell_no'];

								?>

								<div class='row'>
								
									<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

										<label><strong>First Name</strong></label>

										<br>

										<input type='text' name='first_name' id='first_name' value='<?php echo $user_firstname; ?>' readonly>

									</div>

									<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

										<label><strong>Last Name</strong></label>

										<br>

										<input type='text' name='last_name' id='last_name' value='<?php echo $user_lastname; ?>' readonly>

									</div>

								</div>

								<br>

								<div class='row'>

									<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

										<label><strong>Email</strong></label>

										<br>

										<input type='email' name='email' id='email' value='<?php echo $user_email; ?>' readonly>

									</div>

									<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

										<label><strong>Last Name</strong></label>

										<br>

										<input type='number' name='cell_no' id='cell_no' value='<?php echo $user_cell_no; ?>'>

									</div>

								</div>

								<div class='row'>

									<hr>

									<button class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

								</div>

							</form>

						</div>

						<div id='home_details_div' class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

							<div class='special-heading m-b-40'>

								<h2 class='h2'>Welcome <?php echo $first_name." ".$last_name; ?></h2>

							</div>

							<div class='container' style='color: black;'>
										
								<form method='POST' action='verifyOTP.php' class='ajax2'>

									<div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

										<center>Please enter the OTP sent to your mobile number (<?php echo $cell_no; ?>).</center>

									</div>

									<br>

									<div class='col-xl-4 col-lg-4 col-md-4 col-sm-8 col-xs-10 offset-xl-4 offset-lg-4 offset-md-4 offset-sm-2 offset-xs-1'>

										<input class='form-control' type='number' name='enter_otp' id='enter_otp' placeholder='Enter OTP'>

										<input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

									</div>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

										<hr><br>

										<button class='btn btn-success btn-sm'>Continue <i class='fa fa-arrow-right'></i></button>

									</div>

								</form>

							</div>

						</div>

					</div>

				</section>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/userPage.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
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
							
						<div id='user_details_div' class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

							<?php

								$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

								$user_firstname = $row['firstname'];
								$user_lastname = $row['lastname'];
								$user_email = $row['email'];
								$user_cell_no = $row['cell_no'];

							?>

							<div class='modal fade' id='modal_edit_user_details'>

								<div class='modal-dialog modal-lg'>

									<div class='modal-content'>

										<div class='modal-header'>

											<h4 class='h4'>User Details</h4>
											<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

										</div>

										<div class='modal-body'>

											<div class='container' style='color: black;'>

												<form method='POST' action='updateHOAID.php' class='ajax1'>
																				
													<div class='row'>

														<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

															<label><strong>First Name</strong></label>

															<br>

															<input class='form-control' type='text' name='edit_firstname' id='edit_firstname' value='<?php echo $user_firstname; ?>' readonly>

														</div>

														<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

															<label><strong>Last Name</strong></label>

															<br>

															<input class='form-control' type='text' name='edit_lastname' id='edit_lastname' value='<?php echo $user_lastname; ?>' readonly>

														</div>

													</div>

													<br>

													<div class='row'>

														<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

															<label><strong>Email</strong></label><br>
															<input class='form-control' type='email' name='edit_email' id='edit_email' value='<?php echo $user_email; ?>' readonly>

														</div>

														<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

															<label><strong>Phone</strong></label><br>
															<input class='form-control' type='number' name='edit_cell_no' id='edit_cell_no' value='<?php echo $user_cell_no; ?>' required>

														</div>

													</div>

													<br>

													<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

														<center>

															<button class='btn btn-info btn-xs' type='submit'>Update</button>

														</center>

													</div>

												</form>

						                    </div>

										</div>

									</div>

								</div>

							</div>

							<div class='row'>
								
									<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

										<label><strong>First Name</strong></label>

										<br>

										<h3 class='h3' style='color: black;'><?php echo $user_firstname; ?></h3>

									</div>

									<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

										<label><strong>Last Name</strong></label>

										<br>

										<h3 class='h3' style='color: black;'><?php echo $user_lastname; ?></h3>

									</div>

							</div>

							<br><br>

							<div class='row'>

								<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

									<label><strong>Email</strong></label>

									<br>

									<h3 class='h3' style='color: black;'><?php echo $user_email; ?></h3>

								</div>

								<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

									<label><strong>Cell Number</strong></label>

									<br>

									<h3 class='h3' id='user_cell_no' style='color: black;'><?php echo $user_cell_no; ?></h3>

								</div>

							</div>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

									<hr class='small'>

									<button class='btn btn-info btn-xs' data-toggle='modal' data-target='#modal_edit_user_details'><i class='fa fa-edit'></i> Edit</button> <button id='user_details_continue' name='user_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

								</div>

							</div>

						</div>

						<div id='home_details_div' class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

							<?php

								$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

								$property_address = $row['address1'];
								$living_status = $row['living_status'];

								if($living_status == 't')
								{

									$mailing_address = $property_address;
									$mailing_city = $row['city_id'];
									$mailing_state = $row['state_id'];
									$mailing_zip = $row['zip_id'];

								}
								else
								{

									$row = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

									$mailing_address = $row['address1'];
									$mailing_city = $row['city_id'];
									$mailing_state = $row['state_id'];
									$mailing_zip = $row['zip_id'];

								}

								$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
								$mailing_city = $row['city_name'];

								$row = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
								$mailing_state = $row['state_code'];

								$row = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
								$mailing_zip = $row['zip_code'];

							?>

							<div class='modal fade' id='modal_edit_home_details'>

								<div class='modal-dialog modal-lg'>

									<div class='modal-content'>

										<div class='modal-header'>

											<h4 class='h4'>Home Details</h4>
											<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

										</div>

										<div class='modal-body'>

											<div class='container' style='color: black;'>

												<form method='POST' action='updateHomeID.php' class='ajax2'>
																				
													<div class='row'>

														<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

															<label><strong>Property Address</strong></label>

															<br>

															<input class='form-control' type='text' name='property_address' id='property_address' value='<?php echo $property_address; ?>' readonly>

														</div>

													</div>

													<br>

													<div class='row'>

														<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

															<label><strong>Living Status</strong></label>

														</div>

														<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

															<input type='radio' name='edit_living_status' id='edit_living_status' value='t' <?php if($living_status == 't') echo 'checked'; ?> > Living

														</div>

														<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

															<input type='radio' name='edit_living_status' id='edit_living_status' value='f' <?php if($living_status == 'f') echo 'checked'; ?> > Rented

														</div>

													</div>

													<div id='mailing_address_div' class='row'>

														<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

															<label><strong>Maling Address</strong></label>

															<br>

															<input type='text' name='edit_mailing_address' id='edit_mailing_address' value='<?php echo $mailing_address; ?>' required>

														</div>

													</div>

													<br>

													<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

														<center>

															<button class='btn btn-info btn-xs' type='submit'>Update</button>

														</center>

													</div>

												</form>

						                    </div>

										</div>

									</div>

								</div>

							</div>

							<div class='row'>
								
									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<label><strong>Property Address</strong></label>

										<br>

										<h3 class='h3' style='color: black;'><?php echo $property_address; ?></h3>

									</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

									<label><strong>Living Status</strong></label>

									<br>

									<h3 class='h3' style='color: black;'><?php if($living_status == 't') echo "Living"; else echo "Rented"; ?></h3>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

									<label><strong>Mailing Address</strong></label>

									<br>

									<h3 class='h3' style='color: black;'><?php echo $mailing_address.", ".$mailing_city.", ".$mailing_state." ".$mailing_zip; ?></h3>

								</div>

							</div>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

									<hr class='small'>

									<button id='home_details_back' name='user_details_continue' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-info btn-xs' data-toggle='modal' data-target='#modal_edit_home_details'><i class='fa fa-edit'></i> Edit</button> <button id='home_details_continue' name='user_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

								</div>

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
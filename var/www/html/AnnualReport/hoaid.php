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
		<meta name='description' content='HOA Alchemy User Features'>
		<meta name='author' content='Geeth'>

		<title><?php echo $community_code; ?> - Annual Report</title>

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
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

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

									<li><a style="color: green;"><span>Hello <?php echo $username; ?></span></a></li>

									<li><a style="color: orange;" href='logout.php'><span><i class='fa fa-sign-out'></i> Log Out</span></a></li>

								</ul>

							</div>

						</div>

					</div>

					<!-- Mobile menu-->
					<div class='nav-toggle'>
						
						<a href='#' data-toggle='collapse' data-target='.inner-navigation'>
							
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>

						</a>

					</div>
				
				</div>

			</header>

            <!-- Page Header -->
            <section class='module-page-title'>
                                
                <div class='container'>
                                        
                    <div class='row-page-title'>
                                        
                        <div class='page-title-captions'>
                                            
                            <ol class="breadcrumb">
                                    
                                <li class="breadcrumb-item"><strong style='color: black;'>User Details</strong></li>
                                <li class="breadcrumb-item">Home Details</li>
                                <li class="breadcrumb-item">Persons</li>
                                <li class='breadcrumb-item'>Primary Email</li>
                                <li class='breadcrumb-item'>SMS Notifications</li>
                                <li class="breadcrumb-item">Agreements</li>
                                <li class='breadcrumb-item'>Documents</li>
                                <li class="breadcrumb-item">Payments</li>
                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                <li class="breadcrumb-item">Disclosures</li>

                            </ol>
                                        
                        </div>
                                    
                    </div>
                                    
                </div>
                            
            </section>

			<div class='wrapper'>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='user_details_div'>

							<div class='row container-fluid'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

										$user_firstname = $row['firstname'];
										$user_lastname = $row['lastname'];
										$user_email = $row['email'];
										$user_cell_no = $row['cell_no'];

                                        $_SESSION['hoa_alchemy_cell_no'] = $user_cell_no;

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Is this information correct?</h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, this information is correct.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, this information is incorrect.

										</div>

									</div>

									<br>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>First Name</u></strong></label>

											<br>

											<h3 class='h3' style='color: black;'><?php echo $user_firstname; ?></h3>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Last Name</u></strong></label>

											<br>

											<h3 class='h3' style='color: black;'><?php echo $user_lastname; ?></h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Email</u></strong></label>

											<br>

											<h3 class='h3' id='user_email' style='color: black;'><?php echo $user_email; ?></h3>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Cell Number</u></strong></label>

											<br>

											<h3 class='h3' id='user_cell_no' style='color: black;'><?php echo $user_cell_no; ?></h3>

										</div>

									</div>

                                    <hr class='small'>

                                    <div class='row'>

                                        <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

                                            <button id='user_details_continue' name='user_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

                                        </div>

                                    </div>

								</div>

							</div>

						</div>

						<div id='edit_user_details_div'>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3 class='h3'>Update User Details</h3>

									</div>

									<br>

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
												<input class='form-control' type='email' name='edit_email' id='edit_email' value='<?php echo $user_email; ?>' required>

											</div>

											<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

												<label><strong>Phone</strong></label><br>
												<input class='form-control' type='number' name='edit_cell_no' id='edit_cell_no' value='<?php echo $user_cell_no; ?>' required>

											</div>

										</div>

										<br>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<button class='btn btn-warning btn-xs' name='user_edit_back' type='button' id='user_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

											</center>

										</div>

									</form>

								</div>

							</div>

							<br>

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

		<script src='assets/js/hoaid.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>
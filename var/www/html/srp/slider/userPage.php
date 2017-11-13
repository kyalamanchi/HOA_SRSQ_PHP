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

		<title><?php echo $community_code; ?> - User Page</title>

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
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Page Header -->
				<!--section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 id='page_title1' class='h5'>User Details</h1>
								<h1 id='page_title2' class='h5'>Home Details</h1>
								<h1 id='page_title3' class='h5'>Disclosures</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section-->

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='user_details_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item"><strong style='color: black;'>User Details</strong></li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

										$user_firstname = $row['firstname'];
										$user_lastname = $row['lastname'];
										$user_email = $row['email'];
										$user_cell_no = $row['cell_no'];

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Is this information correct?</h3>

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

											<h3 class='h3' style='color: black;'><?php echo $user_email; ?></h3>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<label><strong><u>Cell Number</u></strong></label>

											<br>

											<h3 class='h3' id='user_cell_no' style='color: black;'><?php echo $user_cell_no; ?></h3>

										</div>

									</div>

									<br><br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, this information is correct.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='user_information_radio' id='user_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, this information is incorrect.

										</div>

									</div>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<button id='user_details_continue' name='user_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='edit_user_details_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item"><strong style='color: black;'>User Details</strong></li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3 class='h3'>Update User Details</h3>

									</div>

									<br><br>

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

												<button class='btn btn-warning btn-xs' name='user_edit_back' type='button' id='user_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

											</center>

										</div>

									</form>

								</div>

							</div>

							<br>

						</div>

						<div id='home_details_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Home Details</strong></li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

										$property_address = $row['address1'];
										$living_status = $row['living_status'];

										if($living_status == 't')
										{

											$mailing_address = $property_address;
											$mailing_country = $row['country_id'];
											$mailing_district = $row['district_id'];
											$mailing_city = $row['city_id'];
											$mailing_state = $row['state_id'];
											$mailing_zip = $row['zip_id'];

										}
										else
										{

											$row = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

											$mailing_address = $row['address1'];
											$mailing_country = $row['country_id'];
											$mailing_district = $row['district_id'];
											$mailing_city = $row['city_id'];
											$mailing_state = $row['state_id'];
											$mailing_zip = $row['zip_id'];

										}

										$mailing_country_id = $mailing_country;
										$mailing_state_id = $mailing_state;
										$mailing_district_id = $mailing_district;
										$mailing_city_id = $mailing_city;
										$mailing_zip_id = $mailing_zip;

										$row = pg_fetch_assoc(pg_query("SELECT * FROM country WHERE country_id=$mailing_country"));
										$mailing_country = $row['country_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
										$mailing_state = $row['state_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM district WHERE district_id=$mailing_district"));
										$mailing_district = $row['district_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
										$mailing_city = $row['city_name'];

										$row = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
										$mailing_zip = $row['zip_code'];

										$_SESSION['mailing_address'] = $mailing_address;
										$_SESSION['mailing_country'] = $mailing_country_id;
										$_SESSION['mailing_state'] = $mailing_state_id;
										$_SESSION['mailing_district'] = $mailing_district_id;
										$_SESSION['mailing_city'] = $mailing_city_id;
										$_SESSION['mailing_zip'] = $mailing_zip_id;

									?>

									<div class='container module-gray' style="color: black;">

										<?php

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosures WHERE community_id=$community_id AND type_id=14"));

											$notes = $row['notes'];
											$document_id = $row['document_id'];
											$changed_this_year = $row['changed_this_year'];

											$row = pg_fetch_assoc(pg_query("SELECT * FROM community_disclosure_type WHERE id=14"));
											$disclosure_name = $row['name'];
											$desc = $row['desc'];
											$civilcode_section = $row['civilcode_section'];
											$legal_url = $row['legal_url'];

											if($civilcode_section != "")
												$disclosure_name = $disclosure_name." (".$civilcode_section.")";

											if($legal_url != '')
												$disclosure_name = "<a target='_blank' href='$legal_url'>$disclosure_name</a>";

											if($desc == "")
												$desc = " - ";

											if($notes == "")
												$notes = " - ";

											if($changed_this_year == 't') 
												$changed_this_year = "Yes"; 
											else if($changed_this_year == 'f') 
												$changed_this_year = "No"; 
											else 
												$changed_this_year = " - ";

											if($document_id == "")
												$document = " - ";
											else
												$document = "<a target='_blank' href='$document_id'>$document_id</a>";

										?>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Disclosure Name :</strong> <?php echo $disclosure_name; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Description :</strong> <?php echo $desc; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Changed this year :</strong> <?php echo $changed_this_year; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Notes :</strong> <?php echo $notes; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Document :</strong> <?php echo $document; ?>

											</div>

										</div>

										<br>

									</div>

									<br>

									<div class='row'>
										
										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

											<h3 class='h3'>Do you still live in <u id='user_mailing_address'><?php echo $mailing_address; ?></u>?</h3>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='home_information_radio' id='home_information_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, I'm living in the above address.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='home_information_radio' id='home_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, I'm living in the above address.

										</div>

									</div>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='home_details_back' name='home_details_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<button id='home_details_continue' name='home_details_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='edit_home_details_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Home Details</strong></li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'>

										<h3>Update Home Details</h3>

									</div>

									<br><br>

									<form method='POST' action='updateHomeID.php' class='ajax2'>
																						
										<div class='row'>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>

												<label><strong>Address</strong></label>

												<br>

												<input class='form-control' type='text' name='edit_mailing_address' id='edit_mailing_address' value='<?php echo $mailing_address; ?>' required>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>Country</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_country' id='edit_mailing_country' required>

													<option value='' selected disabled>Select Country</option>

													<?php

														$result = pg_query("SELECT * FROM country");

														while($row = pg_fetch_assoc($result))
														{

															$country_id = $row['country_id'];
															$country_name = $row['country_name'];

															echo "<option value='$country_id'";

															if($country_id == $mailing_country_id)
																echo " selected";

															echo ">$country_name</option>";

														}

													?>
													
												</select>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>State</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_state' id='edit_mailing_state' required>

													<option value='' selected disabled>Select State</option>

													<?php

														$result = pg_query("SELECT * FROM state WHERE country_id=$mailing_country_id");

														while($row = pg_fetch_assoc($result))
														{

															$state_id = $row['state_id'];
															$state_name = $row['state_name'];

															echo "<option value='$state_id'";

															if($state_id == $mailing_state_id)
																echo " selected";

															echo ">$state_name</option>";

														}

													?>
													
												</select>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>District</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_district' id='edit_mailing_district' required>

													<option value='' selected disabled>Select District</option>

													<?php

														$result = pg_query("SELECT * FROM district WHERE state_id=$mailing_state_id");

														while($row = pg_fetch_assoc($result))
														{

															$district_id = $row['district_id'];
															$district_name = $row['district_name'];

															echo "<option value='$district_id'";

															if($district_id == $mailing_district_id)
																echo " selected";

															echo ">$district_name</option>";

														}

													?>
													
												</select>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>City</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_city' id='edit_mailing_city' required>

													<option value='' selected disabled>Select City</option>

													<?php

														$result = pg_query("SELECT * FROM city WHERE district_id=$mailing_district_id");

														while($row = pg_fetch_assoc($result))
														{

															$city_id = $row['city_id'];
															$city_name = $row['city_name'];

															echo "<option value='$city_id'";

															if($city_id == $mailing_city_id)
																echo " selected";

															echo ">$city_name</option>";

														}

													?>
													
												</select>

											</div>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6'>

												<label><strong>Zip</strong></label>

												<br>

												<select class='form-control' name='edit_mailing_zip' id='edit_mailing_zip' required>

													<option value='' selected disabled>Select Zip</option>

													<?php

														$result = pg_query("SELECT * FROM zip WHERE city_id=$mailing_city_id");

														while($row = pg_fetch_assoc($result))
														{

															$zip_id = $row['zip_id'];
															$zip_code = $row['zip_code'];

															echo "<option value='$zip_id'";

															if($zip_id == $mailing_zip_id)
																echo " selected";

															echo ">$zip_code</option>";

														}

													?>
													
												</select>

											</div>

										</div>

										<br>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<button class='btn btn-warning btn-xs' type='button' name='home_edit_back' id='home_edit_back'><i class='fa fa-arrow-left'></i> Back</button> <button class='btn btn-success btn-xs' type='submit'><i class='fa fa-check'></i> Save</button>

											</center>

										</div>

									</form>

								</div>

							</div>

							<br>

						</div>

						<div id='email_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Primary Email</strong></li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 offset-xl-1 offset-lg-1 offset-md-1'>

									<?php

										$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND role_type_id=1 AND is_active='t' AND relationship_id=1"));

										$primary_email = $row['email'];

									?>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center><h3 class='h3'>Is <u><?php echo $primary_email; ?></u> your primary email?</h3></center>

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='email_radio' id='email_radio_yes' value='yes'> <strong style='color: black;'>Yes</strong>, <?php echo $primary_email; ?> is my primary email.

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center'>

											<input type='radio' name='email_radio' id='email_radio_no' value='no'> <strong style='color: black;'>No</strong>, <?php echo $primary_email; ?> is not my primary email.

										</div>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

									<hr class='small'>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

											<button id='email_back' name='email_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button id='email_continue' name='email_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='agreements_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item"><strong style='color: black;'>Agreements</strong></li>
											<li class="breadcrumb-item">HOA Fact Sheet</li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3>Pending Agreements</h3></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 table-responsive'>

									<table id='pendingAgreements' class='table table-striped' style='color: black;'>

										<thead>
											
											<th>Agreement</th>
											<th>Email</th>
											<th>Sign Agreement</th>

										</thead>

										<tbody>

											<?php

												$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

												while($row = pg_fetch_assoc($result))
												{
													
													$id = $row['id'];
			                          				$document_to = $row['document_to'];
			                          				$agreement_name = $row['agreement_name'];
			                          				$esign_url = $row['esign_url'];
		                          				
		                          					echo "<tr><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>$agreement_name</a></td><td>$document_to</td><td><a title='Click to sign agreement' target='_blank' href='$esign_url'>Click Here</a></td></tr>";
		                          				}

											?>
											
										</tbody>

									</table>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3>Signed Agreements</h3></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<table id='signedAgreements' class='table table-striped' style='color: black;'>

										<thead>
											
											<th>Agreement</th>
											<th>Email</th>
											<th>Document Preview</th>

										</thead>

										<tbody>

											<?php

												$result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)");

												while($row = pg_fetch_assoc($result))
												{
													
			                          				$agreement_id = $row['agreement_id'];
			                          				$document_to = $row['document_to'];
			                          				$agreement_name = $row['agreement_name'];
			                          				$esign_url = $row['esign_url'];
		                          				
		                          					echo "<tr><td><a target='_blank' href='esignPreview.php?id=$agreement_id'>$agreement_name</a></td><td>$document_to</td><td><a target='_blank' href='esignPreview.php?id=$agreement_id'><i class='fa fa-file-pdf-o'></i></a></td></tr>";

		                          				}

											?>
											
										</tbody>

									</table>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<hr class='small'>

									<div class='row'>
										
										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

											<button class='btn btn-warning btn-xs' type='button' id='agreements_back' name='agreements_back'><i class='fa fa-arrow-left'></i> Back</button>

										</div>

										<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

											<button class='btn btn-xs btn-success' name='agreements_continue' id='agreements_continue'>Continue <i class='fa fa-arrow-right'></i></button>

										</div>

									</div>

								</div>

							</div>

							<br>

						</div>

						<div id='hoa_fact_sheet_div'>

							<br>

							<div class='row container'>
								
								<div class='col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1 offset-sm-1 offset-xs-1'>

									<div class='alert alert-warning'>

										<ol class="breadcrumb">
									
											<li class="breadcrumb-item">User Details</li>
											<li class="breadcrumb-item">Home Details</li>
											<li class="breadcrumb-item">Primary Email</li>
											<li class="breadcrumb-item">Agreements</li>
											<li class="breadcrumb-item"><strong style='color: black;'>HOA Fact Sheet</strong></li>
											<li class="breadcrumb-item">Disclosures</li>

										</ol>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='col=xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h3 class='h3'>HOA Fact Sheet</h3></center>

								</div>

							</div>

							<div class='row'>

								<div class="container">

									<div class="row">

										<div class="table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
										<!-- Tabs-->
										<ul class="nav nav-tabs">
									
											<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab">Board</a></li>
											<li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab">Comms</a></li>
											<li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab">Reserves</a></li>
											<li class="nav-item"><a class="nav-link" href="#tab-4" data-toggle="tab">Finance</a></li>

										</ul>

										<div class="tab-content">
									
											<div class="tab-pane in active" id="tab-1">
										
												<div class="special-heading m-b-40">
									
													<h4><i class="fa fa-dashboard"></i> Board Dashboard</h4>
								
												</div>
								
												<div class='container'>

													<div class='row module-gray'>

														<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

															<br><center><h3 class='h3'>PAYMENT INFORMATION</h3></center>

														</div>

													</div>
		
													<div class='row module-gray'>

														<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>
															
																	<?php echo round($amount_received, 0); ?>
																
																</div>

																<div class='counter-title'>Amount Received (%)</div>

															</div>

														</div>

														<div class='col-xl-2 col-lg-2 col-md-6 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>

																	<?php echo round($members_paid, 0); ?>

																</div>

																<div class='counter-title'>Members Paid (%)</div>

															</div>

														</div>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>
															
																	<?php 
																	
																		$ach = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1")); 

																		echo $ach;

																	?>
																
																</div>

																<div class='counter-title'>ACH</div>

															</div>

														</div>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>

																	<?php 
																	
																		$bill_pay = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2")); 

																		echo $bill_pay;

																	?>

																</div>

																<div class='counter-title'>Bill Pay</div>

															</div>

														</div>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>
															
																	<?php 
																	
																		$check = pg_num_rows(pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3")); 

																		echo $check;

																	?>

																</div>

																<div class='counter-title'>Check</div>

															</div>

														</div>

														<div class='col-xl-2 col-lg-2 col-md-3 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>

																	<?php 
																		
																		echo ($total_homes - ( $ach + $bill_pay + $check ) ); 

																	?>

																</div>

																<div class='counter-title'>Others</div>

															</div>

														</div>

													</div>

													<br /><br />

													<div class='row'>

														<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                         									<div class='counter h6'>

                            									<div class='counter-number'>

                              										<?php 
                                
                                										$board_documents = pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='t'")); 

                                										echo $board_documents;

                              										?>

                            									</div>

                            									<div class='counter-title'>Board Documents</div>

                          									</div>

                        								</div>

                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          									<div class='counter h6'>

                            									<?php 

                                									$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='t'"));

                                									if($pending_agreements == 0)
                                  										echo "<div class='counter-number' >$pending_agreements</div>";
                                									else
                                  										echo "<div class='counter-number' style='color: orange;' >$pending_agreements</div>";

                              									?>

                            

                            									<div class='counter-title'>Board Pending Agreements</div>

                          									</div>

                        								</div>

                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          									<div class='counter h6'>

                            									<div class='counter-number'>

                              										<?php

                                										$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='t'"));

                                										echo $signed_agreements;

                              										?>

                            									</div>

                            									<div class='counter-title'>Board Signed Agreements</div>

                          									</div>

                        								</div>

                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>
															
																	<?php 
																	
																		echo pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id")); 

																	?>
																
																</div>

																<div class='counter-title'>Community Deposits</div>

															</div>

														</div>

														<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

															<div class='counter h6'>

																<div class='counter-number'>

																	<?php 
																
																		echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND active='t' AND is_board_document='f'")); 

																	?>

																</div>

																<div class='counter-title'>Community Documents</div>

															</div>

														</div>

                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

	                          								<div class='counter h6'>

	                              								<?php 

	                                								$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND board_cancel_requested='f' AND is_board_document='f'"));

	                                								if($pending_agreements == 0)
	                                  									echo "<div class='counter-number'>$pending_agreements</div>";
	                                								else
	                                  									echo "<div class='counter-number' style='color: orange;'>$pending_agreements</div>";

	                              								?>

	                            								<div class='counter-title'>Community Pending Agreements</div>

	                          								</div>

                        								</div>

                        								<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          									<div class='counter h6'>

                            									<div class='counter-number'>

                              										<?php

                                										$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND board_cancel_requested='f' AND is_board_document='f'"));

                                										echo $signed_agreements;

                              										?>

                            									</div>

                            									<div class='counter-title'>Community Signed Agreements</div>

                          									</div>

                       									</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php

																if($del_acc > 0)
																	echo "<a href='delinquentAccounts.php' style='color: orange;'>$del_acc</a>";
																else
																	echo "$del_acc";

															?>

														</div>

														<div class='counter-title'>Delinquent Accounts</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																$inspection_notices = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id"));

																$closed = pg_num_rows(pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id AND (inspection_status_id=2 OR inspection_status_id=6 OR inspection_status_id=9 OR inspection_status_id=13 OR inspection_status_id=14)"));

																$inspection_notices = $inspection_notices - $closed;

																if ($inspection_notices == 0) 
																	echo $inspection_notices;
																else
																	echo "<a href='inspectionNotices.php' style='color: orange;'>$inspection_notices</a>";

															?>

														</div>

														<div class='counter-title'>Inspection Notices</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																$late_payments = pg_num_rows(pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-16' AND process_date<='$year-$month-$last'"));

																if ($late_payments == 0) 
																	echo $late_payments;
																else
																	echo "<a href='latePayments.php' style='color: orange;'>$late_payments</a>";

															?>

														</div>

														<div class='counter-title'>Late Payments</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																$parking_tags = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1"));

																if ($parking_tags > 0) 
																	echo "<a href='parkingTags.php' style='color: green;'>$parking_tags</a>";
																else
																	echo $parking_tags;

															?>

														</div>

														<div class='counter-title'>Parking Tags</div>

													</div>

												</div>

											</div>

											<br /><br />

											<?php

												if($community_id == 1)
													echo "

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

														</div>

														<div class='row module-gray'>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		".round($srp_savings_balance, 0)."
																			
																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		".round($srp_current_balance, 0)."

																	</div>

																	<div class='counter-title'>Checkings ($)</div>

																</div>

															</div>

														</div>

													";
												else if($community_id == 2)
													echo "

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

														</div>

														<div class='row module-gray'>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		".round($srp_primary_Savings_CurrentBalance, 0)."
																			
																	</div>

																	<div class='counter-title'>Checkings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		".round($srp_savings, 0)."

																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		".round($srsq_third_Account_Balance, 0)."

																	</div>

																	<div class='counter-title'>Investments ($)</div>

																</div>

															</div>

														</div>

													";

											?>

										</div>

									</div>

									<div class="tab-pane" id="tab-2">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-envelope"></i> Communications Dashboard</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<?php

															$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));

															if($email_homes > 0)
																echo "<div class='counter-number' style='color: green;'>".$email_homes."</div>";
															else
																echo "<div class='counter-number'>".$email_homes."</div>";

														?>

														<div class='counter-title'>Email Signup</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='campaigns.php'>

																<?php

																	$campaigns = 0;

																	if($community_id == 1)
																	{

																		$ch = curl_init('https://us14.api.mailchimp.com/3.0/campaigns/');
																		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey eecf4b5c299f0cc2124463fb10a6da2d-us14'));

																	}
																	else if($community_id == 2)
																	{

																		$ch = curl_init('https://us12.api.mailchimp.com/3.0/campaigns/');
																		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey af5b50b9f714f9c2cb81b91281b84218-us12'));

																	}
										            				
										            				curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
										            				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
										            
										            				$result = curl_exec($ch);
										            				$json_decode = json_decode($result,TRUE);

										            				foreach ($json_decode['campaigns'] as $key ) 
										            					$campaigns++;

										            				echo $campaigns;

																?>

															</a>
																
														</div>

														<div class='counter-title'>Community Notifications</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php if($community_id == 2) echo "<a href='adobeSendAgreement.php'>"; ?>

																<!--i class='fa fa-file'></i-->
																<img src='send_agreements.png' alt='Send Agreements'>

															<?php if($community_id == 2) echo "</a>"; ?>
																
														</div>

														<div class='counter-title'>Send Agreements</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php 

																$statements_mailed = pg_num_rows(pg_query("SELECT * FROM community_statements_mailed WHERE community_id=$community_id"));

																if($statements_mailed == 0)
																	echo $statements_mailed;
																else
																	echo "<a style='color: green;' href='statementsMailed.php'>$statements_mailed</a>";

															?>
																
														</div>

														<div class='counter-title'>Statements Mailed</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div class="tab-pane" id="tab-3">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-support"></i> Reserves Dashboard</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>
                              
                              <?php 

                                $assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id"));

                                if($assets != '')
                                  echo "<a style='color: green;' href='communityAssets.php'>$assets</a>";
                                else
                                  echo $assets;

                              ?>
                                
                            </div>

                            <div class='counter-title'>Assets</div>

                          </div>

                        </div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <?php 

                              $row = pg_fetch_assoc(pg_query("SELECT sum(invoice_amount) FROM community_invoices WHERE reserve_expense='t' AND community_id=$community_id"));

                              $repairs = $row['sum'];

                              $repairs = round($repairs, 0);

                              if($repairs > 0)
                                echo "<div class='counter-number' style='color: green;'><a href='reserveRepairs.php'>".$repairs."</a></div>";
                              else
                                echo "<div class='counter-number'>".$repairs."</div>";

                            ?>

                            <div class='counter-title'>Completed Repairs ($)</div>

                          </div>

                        </div>

												<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<?php 

																$row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id"));

																$reserves = $row['cur_bal_vs_ideal_bal'];

																echo $reserves;

															?>
																
														</div>

														<div class='counter-title'>Reserves Funded (%)</div>

													</div>

												</div>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <?php 

                              $row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND fisc_yr_end<='$year-12-31'"));

                              $recommended_monthly_allocation_units = $row['rec_mthly_alloc_unit'];
                              $cur_bal_vs_ideal_bal = $row['cur_bal_vs_ideal_bal'];

                              $reserve_allocation = $recommended_monthly_allocation_units * $month;

                              $reserve_allocation = round($reserve_allocation, 0);

                              if($cur_bal_vs_ideal_bal >= 70)
                                echo "<div class='counter-number' style='color: green;'>".$reserve_allocation."</div>";
                              else
                                echo "<div class='counter-number' style='color: orange;'>".$reserve_allocation."</div>";

                            ?>

                            <div class='counter-title'>YTD Allocation ($)</div>

                          </div>

                        </div>

											</div>

										</div>

									</div>

									<div class="tab-pane" id="tab-4">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-dollar"></i> Finance Dashboard</h4>
						
										</div>

										<div class='container'>

											<?php

												if($community_id == 1)
													echo "

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

														</div>

														<div class='row module-gray'>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		".round($srp_savings_balance, 0)."
																			
																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		".round($srp_current_balance, 0)."

																	</div>

																	<div class='counter-title'>Checkings ($)</div>

																</div>

															</div>

														</div>

                            <br><br>

													";
												else if($community_id == 2)
													echo "

														<div class='row module-gray'>

															<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'><br><center><h3 class='h3'>BANK ACCOUNT BALANCE</h3></center></div>

														</div>

														<div class='row module-gray'>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>
																		
																		".round($srp_primary_Savings_CurrentBalance, 0)."
																			
																	</div>

																	<div class='counter-title'>Checkings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		".round($srp_savings, 0)."

																	</div>

																	<div class='counter-title'>Savings ($)</div>

																</div>

															</div>

															<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>

																<div class='counter h6'>

																	<div class='counter-number'>

																		".round($srsq_third_Account_Balance, 0)."

																	</div>

																	<div class='counter-title'>Investments ($)</div>

																</div>

															</div>

														</div>

                            <br><br>

													";

											?>

                      <div class='row'>

                        <div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

                          <div class='counter h6'>

                            <div class='counter-number'>
                              
                              <?php 

                                if($community_id == 1)
                                {

                                  $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/reports/VendorExpenses?minorversion=8');
                                  // curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
                                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="doJ2s3%2F2B6LEarru2JKFfy9%2B8V0%3D"'));
                                  // curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from vendor");
                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                  
                                  $result = curl_exec($ch);
                                  $result  = json_decode($result);
                                  $vendorsArray = array();

                                  foreach ($result->Rows->Row as $ColumnData) 
                                  {
                                      
                                    $values = array();
                                    $id = -10;
                                    $vendors = array();
                                    $amounts = array();
                                      
                                    foreach ($ColumnData as $row) 
                                    {
                                        
                                      $name = "";
                                      $id = "";
                                      $amount = "";
                                          
                                      if ( $row->ColData )
                                        $finalAmount = $row->ColData[1]->value;

                                    }

                                  }

                                  echo round($finalAmount, 0);

                                }
                                else if($community_id == 2)
                                {

                                  $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/VendorExpenses?minorversion=8');
                                  // curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
                                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                                  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="0pBXJJqrgWzGbU51XadGu%2FuKtyc%3D"'));
                                  // curl_setopt($ch, CURLOPT_POSTFIELDS, "select * from vendor");
                                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                  
                                  $result = curl_exec($ch);
                                  $result  = json_decode($result);
                                  $vendorsArray = array();

                                  foreach ($result->Rows->Row as $ColumnData) 
                                  {
                                      
                                    $values = array();
                                    $id = -10;
                                    $vendors = array();
                                    $amounts = array();
                                      
                                    foreach ($ColumnData as $row) 
                                    {
                                        
                                      $name = "";
                                      $id = "";
                                      $amount = "";
                                          
                                      if ( $row->ColData )
                                        $finalAmount = $row->ColData[1]->value;

                                    }

                                  }

                                  echo round($finalAmount, 0);

                                }

                              ?>
                                
                            </div>

                            <div class='counter-title'>Expenditure By Vendors ($)</div>

                          </div>

                        </div>

                      </div>

                      <br><br>

                      <!--div class='row module-gray'>

                        <br>

                        <div class='col-xl-4 col-lg-6 col-md-6 col-sm-8 col-xs-10 offset-xl-4 offset-lg-3 offset-md-3 offset-sm-2 offset-xs-1'>
                          
                          <canvas id="myChart"></canvas>

                        </div>

                        <br>

                      </div-->

										</div>

                    <div class="special-heading m-b-40">
                  
                      <h4><i class="fa fa-area-chart"></i> Yearly Report - <?php echo $year; ?></h4>
            
                    </div>

                    <div class='container'>

                      <div class='row'>

                        <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
                          
                          <canvas id="myChart1"></canvas>

                        </div>

                        <div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
                          
                          <canvas id="myChart2"></canvas>

                        </div>

                      </div>

                    </div>

                    <br>

                    <div class='container'>

                      									<div class='row'>

                        									<div class='col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12'>
                          
                          										<canvas id="myChart3"></canvas>

                        									</div>

                     									</div>

                    								</div>

												</div>

											</div>

										</div>

									</div>

								</div>

							</div>

							<br>

							<div class='row'>

								<div class='table-responsive col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-10 offset-xl-1 offset-lg-1 offset-md-1'>

									<br>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

											<hr class='small'>

											<div class='row'>
										
												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left'>

													<button id='hoa_fact_sheet_back' name='hoa_fact_sheet_back' class='btn btn-warning btn-xs'><i class='fa fa-arrow-left'></i> Back</button>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right'>

													<button id='hoa_fact_sheet_continue' name='hoa_fact_sheet_continue' class='btn btn-success btn-xs'>Continue <i class='fa fa-arrow-right'></i></button>

												</div>

											</div>

										</div>

									</div>

									<br>

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

		<script src='assets/js/userPage.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#pendingAgreements").DataTable({ "pageLength": 100, "order": [[0, 'desc']] });

	      	});

    	</script>

    	<script>
      	
	      	$(function () {
	        	
	        	$("#signedAgreements").DataTable({ "pageLength": 100, "order": [[0, 'desc']] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
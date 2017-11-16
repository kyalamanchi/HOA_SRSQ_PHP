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

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='home_details_div'>

							<!-- Page Header -->
                            <section class='module-page-title'>
                                
                                <div class='container'>
                                        
                                    <div class='row-page-title'>
                                        
                                        <div class='page-title-captions'>
                                            
                                            <ol class="breadcrumb">
                                    
                                                <li class="breadcrumb-item">User Details</li>
                                                <li class="breadcrumb-item"><strong style='color: black;'>Home Details</strong></li>
                                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                                <li class='breadcrumb-item'>SMS Notifications</li>
                                                <li class="breadcrumb-item">Agreements</li>
                                                <li class='breadcrumb-item'>Documents</li>
                                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                                <li class="breadcrumb-item">Disclosures</li>

                                            </ol>
                                        
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </section>

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

												<strong>Changed this year :</strong> <?php echo $changed_this_year; ?>

											</div>

										</div>

										<br>

										<div class='row'>

											<div class='col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

												<strong>Board Comments </strong> <?php echo $notes; ?>

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

											<input type='radio' name='home_information_radio' id='home_information_radio_no' value='no'> <strong style='color: black;'>No</strong>, I rented my home out.

										</div>

									</div>

									<br>

									<div class='row'>

										<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

											<center>

												<script>(function(t,e,s,n){var o,a,c;t.SMCX=t.SMCX||[],e.getElementById(n)||(o=e.getElementsByTagName(s),a=o[o.length-1],c=e.createElement(s),c.type="text/javascript",c.async=!0,c.id=n,c.src=["https:"===location.protocol?"https://":"http://","widget.surveymonkey.com/collect/website/js/tRaiETqnLgj758hTBazgd_2BfaWOjaemomJA_2FAfa23Vy49wNbXrrSPU8mJda5XW6x7.js"].join(""),a.parentNode.insertBefore(c,a))})(window,document,"script","smcx-sdk");</script>

											</center>

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

							<!-- Page Header -->
                            <section class='module-page-title'>
                                
                                <div class='container'>
                                        
                                    <div class='row-page-title'>
                                        
                                        <div class='page-title-captions'>
                                            
                                            <ol class="breadcrumb">
                                    
                                                <li class="breadcrumb-item">User Details</li>
                                                <li class="breadcrumb-item"><strong style='color: black;'>Home Details</strong></li>
                                                <li class="breadcrumb-item">Email &amp; Persons</li>
                                                <li class='breadcrumb-item'>SMS Notifications</li>
                                                <li class="breadcrumb-item">Agreements</li>
                                                <li class='breadcrumb-item'>Documents</li>
                                                <li class="breadcrumb-item">HOA Fact Sheet</li>
                                                <li class="breadcrumb-item">Disclosures</li>

                                            </ol>
                                        
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </section>

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

		<script src='assets/js/userPage2.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>
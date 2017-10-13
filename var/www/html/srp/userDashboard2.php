<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	session_start();

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = $_SESSION['hoa_community_id'];
			$mode = $_SESSION['hoa_mode'];

			$today = date('Y-m-d');

			if($mode == 2)
				header('Location: residentDashboard.php');

			$hoa_id = $_GET['hoa_id'];
			$home_id = $_GET['home_id'];
			$name = $_GET['name'];

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; ?> | Board Dashboard</title>

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
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

	</head>

	<body>

		<div class='layout'>

			<!-- Header-->
			<?php include "boardHeader.php"; ?>

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 class='h5'>User Dashboard - <?php echo $name; ?></h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container-fluid'>
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<div class='col-md-12'>
								
								<!-- Tabs-->
								<ul class='nav nav-tabs'>
									
									<li class='nav-item'><a class='nav-link active' href='#tab-1' data-toggle='tab'>Owner &amp; Home</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-2' data-toggle='tab'>Account Statement</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-3' data-toggle='tab'>Agreements</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-4' data-toggle='tab'>Communication</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-5' data-toggle='tab'>Documents</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-6' data-toggle='tab'>Inspections</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-7' data-toggle='tab'>Payments</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-8' data-toggle='tab'>Statements Mailed</a></li>

								</ul>

								<div class='tab-content'>
									
									<div class='tab-pane in active' id='tab-1'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Owner Details</h4>
								
										</div>
								
										<div class='container'>

											<div class='row'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>
														
														<th>Name</th>
														<th>HOA ID</th>
														<th>Resident Since</th>
														<th>Role</th>
														<th>Email</th>
														<th>Phone</th>
														<th></th>

													</thead>

													<tbody>

														<?php 

															$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id AND home_id=$home_id"));

															$firstname = $row['firstname'];
															$lastname .= $row['lastname'];
															$name = $firstname;
															$name .= " ";
															$name .= $lastname;
															$resident_since = $row['valid_from'];
															$role = $row['role_type_id'];
															$email = $row['email'];
															$cell_no = $row['cell_no'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role"));
															$role = $row['name'];

															echo "
											
											<div class='modal fade' id='modal_edit_hoaid'>

												<div class='modal-dialog modal-lg'>

													<div class='modal-content'>

														<div class='modal-header'>

															<h4>Owner Details</h4>
															<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>

														</div>

														<div class='modal-body'>

															<div class='container' style='color: black;'>

																<form method='POST'>
																
																	<div class='row'>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																			<label>First Name</label><br>
																			<input class='form-control' type='text' name='edit_firstname' id='edit_firstname' value='$firstname' required>

																		</div>

																		<div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

																			<label>Last Name</label><br>
																			<input class='form-control' type='text' name='edit_lastname' id='edit_lastname' value='$lastname' required>

																		</div>

																	</div>

																	<div class='row text-center'>

																		<center><button class='btn btn-info btn-xs' type='submit'>Update</button></center>

																	</div>

																</form>

		                                          			</div>

														</div>

													</div>

												</div>

											</div>

											";

															echo "<tr><td>$name</td><td>$hoa_id</td><td>$resident_since</td><td>$role</td><td>$email</td><td>$cell_no</td><td><button class='btn btn-link btn-lg' type='button' data-toggle='modal' data-target='#modal_edit_hoaid'>Edit</button></td></tr>";

														?>
														
													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Home Details</h4>
								
										</div>
								
										<div class='container'>

											<div class='row'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>
														
														<th>Living In</th>
														<th>Home ID</th>
														<th>Living Status</th>
														<th>Lot</th>
														<th>Mailing Address</th>

													</thead>

													<tbody>

														<?php 

															$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

															$living_in = $row['address1'];
															$living_status = $row['living_status'];
															$lot = $row['lot'];

															if($living_status == 't')
															{

																$mailing_address = $row['address1'];
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

															$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role"));
															$role = $row['name'];

															if($living_status == 't')
																$living_status = "TRUE";
															else
																$living_status = "FALSE";

															echo "<tr><td>$living_in</td><td>$home_id</td><td>$living_status</td><td>$lot</td><td>$mailing_address, $mailing_city, $mailing_state $mailing_zip</td></tr>";

														?>
														
													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Persons</h4>
								
										</div>
								
										<div class='container'>

											<div class='row'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>
														
														<th>Name</th>
														<th>Home</th>
														<th>Role</th>
														<th>Relationship</th>
														<th>Email</th>
														<th>Phone</th>

													</thead>

													<tbody>

														<?php 

															$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id"));

															$name = $row['fname'];
															$name .= " ";
															$name .= $row['lname'];
															$role_type = $row['role_type_id'];
															$relationship = $row['relationship_id'];
															$email = $row['email'];
															$cell_no = $row['cell_no'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role_type"));
															$role_type = $row['name'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM relationship WHERE id=$relationship"));
															$relationship = $row['name'];

															$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
															$home = $row['address1'];

															echo "<tr><td>$name</td><td>$home</td><td>$role_type</td><td>$relationship</td><td>$email</td><td>$cell_no</td></tr>";

														?>
														
													</tbody>

												</table>

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-2'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Account Statement</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-3'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Pending Agreements</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												<table class='table table-striped' style='color: black;'>
													
													<thead>

														<th>Agreement</th>
														<th>Email</th>
														<th>Create Date</th>
														<th>Send Date</th>
														<th>Last Updated</th>
														
													</thead>

													<tbody>

														<?php

															$result = pg_query("SELECT * FROM community_sign_agreements WHERE (hoa_id=$hoa_id AND home_id=$home_id) OR ");

														?>
														
													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Signed Agreements</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-4'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Communication Info</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-5'>
										
										<div class='special-heading m-b-40'>
									
											<h4>User Documents</h4>
						
										</div>

										<div class='container'>

											<div class='row'>



											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-6'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Inspection Notices</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-7'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Payments</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-8'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Statements Mailed</h4>
						
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include 'footer.php'; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>
		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#example1").DataTable({ "pageLength": 50 });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
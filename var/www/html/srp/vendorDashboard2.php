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

			$vendor_name = $_GET['vendor_name'];
			$vendor_id = $_GET['vendor_id'];

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

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Vendor Dashboard <small>- <?php echo $vendor_name; ?></small></h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<div class='col-md-12'>
								
								<!-- Tabs-->
								<ul class='nav nav-tabs'>
									
									<li class='nav-item'><a class='nav-link active' href='#tab-1' data-toggle='tab'>Vendor Details</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-2' data-toggle='tab'>Accounts Payable</a></li>
									<li class='nav-item'><a class='nav-link' href='#tab-3' data-toggle='tab'>Documents</a></li>

								</ul>

								<div class='tab-content'>
									
									<div class='tab-pane in active' id='tab-1'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Vendor Details</h4>
								
										</div>
								
										<div class='container'>

											<div class='row'>

												<table class='table table-bordered' style='color: black;'>
													
													<thead>

														<th>Vendor Name</th>
														<th>Active From</th>
														<th>Approved</th>
														<th>Vendor Type</th>
														<th>Payment Method</th>
														<th>Tax ID</th>
														<th>Email</th>
														<th>Phone</th>
														<th>Address</th>

													</thead>

													<tbody>
														
														<?php

															$row = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_id"));

															$vendor_name = $row['vendor_name'];
															$active_from = $row['active_from'];
															$address = $row['address'];
															$approved = $row['approved'];
															$email = $row['email'];
															$phone_no = $row['phone_no'];
															$vendor_id = $row['vendor_id'];


															if($approved == 't')
																$approved = 'TRUE';
															else
																$approved = 'FALSE';

														?>

													</tbody>

												</table>

											</div>

										</div>

										<div class='special-heading m-b-40'>
									
											<h4><br><br>Current Year Payments Processed</h4>
								
										</div>
								
										<div class='container'>

											<div class='row'>

												<table class='table table-bordered' style='color: black;'>
													
													

												</table>

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-2'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Accounts Payable</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												

											</div>

										</div>

									</div>

									<div class='tab-pane' id='tab-3'>
										
										<div class='special-heading m-b-40'>
									
											<h4>Vendor Documents</h4>
								
										</div>

										<div class='container'>

											<div class='row'>

												<table class='table table-striped' style='color: black;'>
													
													

												</table>

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
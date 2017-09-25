<!DOCTYPE html>
<html lang="en">
	<head>
		

		<?php

			session_start();

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$user_id = $_SESSION['hoa_user_id'];
			$board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id"));

			if($board == 0)
				header("Location: residentDashboard.php");

			if($_SESSION['hoa_mode'] == 2)
				$_SESSION['hoa_mode'] = 1;

			$community_id = $_SESSION['hoa_community_id'];
			$days90 = date('Y-m-d', strtotime("-90 days"));

			$res_dir = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id"));
			$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));
			$total_homes = pg_num_rows(pg_query("SELECT * FROM homeid WHERE community_id=$community_id"));
			$tenants = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE community_id=$community_id"));
			$newly_moved_in = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>='".$days90."' AND valid_from<='".date('Y-m-d')."'"));

		?>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Core - Template</title>
		<!-- Favicons-->
		<link rel="shortcut icon" href="assets/images/favicon.png">
		<link rel="apple-touch-icon" href="assets/images/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114.png">
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

		<!-- Layout-->
		<div class="layout">

			<!-- Header-->
			<?php include "boardHeader.php"; ?>
			<!-- Header end-->

			<!-- Wrapper-->
			<div class="wrapper">

				<!-- Tabs-->
				<section class="module">

					<div class="container">

						<div class="row">

							<div class="col-md-8 offset-md-2">
								
								<!-- Tabs-->
								<ul class="nav nav-tabs">
									
									<li class="nav-item"><a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="fa fa-dashboard"></i> Board Dashboard</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-2" data-toggle="tab"><i class="fa fa-envelope"></i> Communications Dashboard</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-3" data-toggle="tab"><i class="fa fa-support"></i> Reserves Dashboard</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-4" data-toggle="tab"><i class="fa fa-dollar"></i> Quickbooks Reports</a></li>
									<li class="nav-item"><a class="nav-link" href="#tab-5" data-toggle="tab"><i class="fa fa-area-chart"></i> Yearly Reports - <?php echo date('Y'); ?></a></li>

								</ul>

								<div class="tab-content">
									
									<div class="tab-pane in active" id="tab-1">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-dashboard"></i> Board Dashboard</h4>
								
										</div>
								
										<div class='container'>

											<div class='row'>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
													
													<div class="progress-item">
										
														<div class="progress-title">Amount Received</div>
														
														<div class="progress">
															
															<div class="progress-bar progress-bar-success progress-bar-striped progress-bar-animated" aria-valuenow="60" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span class="pb-number-box"><span class="pb-number"></span>%</span></div>
														
														</div>

													</div>

												</div>

												<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
													
													<div class="progress-item">
										
														<div class="progress-title">Members Paid</div>
														
														<div class="progress">
															
															<div class="progress-bar progress-bar-brand progress-bar-striped progress-bar-animated" aria-valuenow="45" role="progressbar" aria-valuemin="0" aria-valuemax="100"><span class="pb-number-box"><span class="pb-number"></span>%</span></div>
														
														</div>

													</div>
													
												</div>

											</div>

											<br /><br />

											<div class='row'>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>
															
															<a href='communityDeposits.php'>

																<?php 
																	
																	echo pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id")); 

																?>

															</a>
																
														</div>

														<div class='counter-title'>Community Deposits</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='communityDocuments.php'>

																<?php 
																
																	echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id")); 

																?>

															</a>

														</div>

														<div class='counter-title'>Community Documents</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															1

														</div>

														<div class='counter-title'>Delinquent Accounts</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<?php 
																
																echo pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1")); 

															?>

														</div>

														<div class='counter-title'>Parking Tags</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='pendingAgreements.php'>

																<?php

																	echo pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE'"));

																?>

															</a>

														</div>

														<div class='counter-title'>Pending Agreements</div>

													</div>

												</div>

												<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

													<div class='counter h6'>

														<div class='counter-number'>

															<a href='signedAgreements.php'>
															
																<?php

																	echo pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED'"));

																?>

															</a>

														</div>

														<div class='counter-title'>Signed Agreements</div>

													</div>

												</div>

											</div>

										</div>

									</div>

									<div class="tab-pane" id="tab-2">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-envelope"></i> Communications Dashboard</h4>
								
										</div>

									</div>

									<div class="tab-pane" id="tab-3">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-support"></i> Reserves Dashboard</h4>
								
										</div>

									</div>

									<div class="tab-pane" id="tab-4">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-dollar"></i> Quickbooks Reports</h4>
						
										</div>

									</div>

									<div class="tab-pane" id="tab-5">
										
										<div class="special-heading m-b-40">
									
											<h4><i class="fa fa-area-chart"></i> Yearly Reports - <?php echo date('Y'); ?></h4>
						
										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include "footer.php"; ?>

				<a class="scroll-top" href="#top"><i class="fa fa-angle-up"></i></a>

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

		<!-- Color Switcher (Remove these lines)-->
		<!--script src="assets/js/style-switcher.min.js"></script-->

	</body>

</html>
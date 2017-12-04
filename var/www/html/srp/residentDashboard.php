<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	session_start();

?>
<!DOCTYPE html>

<html lang='en'>

	<head>
		
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102881886-3"></script>
		<script>
			
			var dimensionValue = '<?php echo $_SESSION['hoa_hoa_id'] ?>';
			  	window.dataLayer = window.dataLayer || [];
			  	function gtag(){dataLayer.push(arguments);}
			  	gtag('js', new Date());
			  
			  	gtag('config', 'UA-102881886-3', {
			  	'custom_map': {'dimension1': 'hoaid'}
				
				// Sends an event that passes 'age' as a parameter.
				gtag('event', 'hoaid_dimension', {'hoaid': dimensionValue});
			});
		  
		</script>

		<?php

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			if($_SESSION['hoa_mode'] == 1)
				$_SESSION['hoa_mode'] = 2;

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = $_SESSION['hoa_community_id'];
			$hoa_id = $_SESSION['hoa_hoa_id'];
			$home_id = $_SESSION['hoa_home_id'];
			$user_id = $_SESSION['hoa_user_id'];
			$username = $_SESSION['hoa_username'];
			$today = date('Y-m-d');

			$row = pg_fetch_assoc(pg_query("SELECT amount FROM assessment_amounts WHERE community_id=$community_id"));
            $assessment_amount = $row['amount'];

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; ?> | Resident Dashboard</title>

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

			<!-- Header-->
			<?php include "residentHeader.php"; ?>

			<!-- Wrapper-->
			<div class='wrapper'>

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Home</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<div class='modal fade' id='login_modal'>
					
					<div class='modal-dialog'>
						
						<div class='modal-content'>
							
							<form method='POST' action='login.php' role='form'>

							<div class='modal-header'>
								
								<h5 class='modal-title' style='color: green;'>Log In</h5>
								<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>
							
							</div>
												
							<div class='modal-body'>
								
								<p>

									<input class='form-control' type='email' name='srp_login_email' id='srp_login_email' placeholder='Email' required>

								</p>
								
								<p>

									<input class='form-control' type='password' name='srp_login_password' id='srp_login_password' placeholder='Password' required>

								</p>
							
							</div>
							
							<div class='modal-footer'>
													
								<button class='btn btn-round btn-success btn-sm' type='submit'>Log In</button>
							
							</div>

							</form>
						
						</div>
					
					</div>
				
				</div>

				<!-- Counters -->
				<section class='module p-b-0'>

					<div class='container'>

						<div class='row'>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>
													
									<?php 

										$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));
										$charges = $row['sum'];
															
										$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id AND payment_status_id=1"));
										$payments = $row['sum'];

										$balance = $charges - $payments;
															
										if($balance <= 0)
											echo "<div class='counter-number' style='color: green;'>".$balance."</div>";
										else if($balance > 0 && $balance <= $assessment_amount)
											echo "<div class='counter-number' style='color: orange;'>".$balance."</div>";
										else if($balance > $assessment_amount)
											echo "<div class='counter-number' style='color: red;'>".$balance."</div>";

									?>

									<div class='counter-title'>Account Balance ($)</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 

											echo "<a target='_blank' href='viewAccountStatement.php?hoa_id=$hoa_id'><img src='account_statement.png' alt='Account Statement Icon'></a>";

										?>
														
									</div>

									<div class='counter-title'>Account Statement</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<a href='boardOfDirectors.php'>

											<?php 
															
												echo pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE community_id=$community_id")); 

											?>

										</a>
														
									</div>

									<div class='counter-title'>Board of Directors</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

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

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php

											$documents = 0;
											$result = pg_query("SELECT * FROM document_management WHERE community_id=$community_id AND is_board_document='f' AND active='t'");

											while($row = pg_fetch_assoc($result))
											{

												$document_id = $row['document_id'];

												$result1 = pg_num_rows(pg_query("SELECT * FROM document_visibility WHERE document_id=$document_id AND (user_id=$user_id OR hoa_id=$hoa_id)"));

												if($result1)
													$documents++;

											}

											if($documents > 0)
												echo "<a href='myDocuments.php'>$documents</a>";
											else
												echo $documents;


										?>
														
									</div>

									<div class='counter-title'>My Documents</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 
															
											$inspection_notices = 0;

											$result = pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id"); 

											while($row = pg_fetch_assoc($result))
											{

												$status = $row['inspection_status_id'];

												if($status != 2 && $status != 6 && $status != 9 && $status != 13 && $status != 14)
													$inspection_notices++;

											}

											if($inspection_notices > 0)
												echo "<a style='color: orange;' href='inspectionNotices.php'>$inspection_notices</a>";
											else
												echo $inspection_notices;

										?>
														
									</div>

									<div class='counter-title'>Inspection Notices</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 
															
											$parking_tags = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND hoa_id=$hoa_id AND type=1")); 

											if($parking_tags > 0)
												echo "<a style='color: green;' href='parkingTags.php'>$parking_tags</a>";
											else
												echo $parking_tags;

										?>
														
									</div>

									<div class='counter-title'>Parking Tags</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 
															
											$pending_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='OUT_FOR_SIGNATURE' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)"));

											if($pending_agreements == 0)
												echo $pending_agreements;
											else
												echo "<a style='color: orange;' href='communityPendingAgreements.php'>$pending_agreements</a>";

										?>
														
									</div>

									<div class='counter-title'>Pending Agreements</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 
															
											$reminders = pg_num_rows(pg_query("SELECT * FROM reminders WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id AND due_date>='$today'")); 

											if($reminders > 0)
												echo "<a style='color: orange;' href='viewReminders.php'>$reminders</a>";
											else
												echo $reminders;

										?>
														
									</div>

									<div class='counter-title'>Reminders</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 
															
											$resident_directory = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id")); 

											if($resident_directory > 0)
												echo "<a href='residentDirectory.php'>$resident_directory</a>";
											else
												echo $resident_directory;

										?>
														
									</div>

									<div class='counter-title'>Resident Directory</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>
													
										<?php 
															
											$signed_agreements = pg_num_rows(pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND agreement_status='SIGNED' AND document_to IN (SELECT email FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id)"));

											if($signed_agreements > 0)
												echo "<a style='color: green;' href='communitySignedAgreements.php'>$signed_agreements</a>";
											else
												echo $signed_agreements;

										?>
														
									</div>

									<div class='counter-title'>Signed Agreements</div>

								</div>

							</div>

						</div>

						<br><br>

					</div>

				</section>

				<!-- Footer-->
				<?php include "footer.php"; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>
			<!-- Wrapper end-->

		</div>
		<!-- Layout end-->

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
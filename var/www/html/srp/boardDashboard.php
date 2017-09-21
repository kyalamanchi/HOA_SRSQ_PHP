<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			session_start();

			ini_set("session.gc_maxlifetime", 1000000000);
			ini_set("session.cache_expire", 1000000000);

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$user_id = $_SESSION['hoa_user_id'];
			$board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id"));

			if($board == 0)
				header("Location: residentDashboard.php");

			$community_id = $_SESSION['hoa_community_id'];
			$days90 = date('Y-m-d', strtotime("-90 days"));

			$res_dir = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id"));
			$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));
			$total_homes = pg_num_rows(pg_query("SELECT * FROM homeid WHERE community_id=$community_id"));
			$tenants = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE community_id=$community_id"));
			$newly_moved_in = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>='".$days90."' AND valid_from<='".date('Y-m-d')."'"));

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

	</head>

	<body>

		<!-- Layout-->
		<div class='layout' style='background-color: blue;'>

			<!-- Header-->
			<?php include "boardHeader.php"; ?>

			<!-- Wrapper-->
			<div class='wrapper'>

				<!-- Counters -->
				<section class='module module-gray p-b-0'>

					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
													
													<?php 
														
														echo pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id")); 

													?>
														
												</div>

												<div class='counter-title'>Community Deposits</div>

											</div>

										</div>

										<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

											<div class='counter h6'>

												<div class='counter-number'>

													<?php 
														
														echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id")); 

													?>

												</div>

												<div class='counter-title'>Community Documents</div>

											</div>

										</div>

										<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

											<div class='counter h6'>

												<div class='counter-number'>

													<?php 
														
														echo pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id")); 

													?>

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

													<div class='counter-timer' data-from='0' data-to='<?php echo $newly_moved_in; ?>'><?php echo $newly_moved_in; ?></div>

												</div>

												<div class='counter-title'>Pending Agreements</div>

											</div>

										</div>

										<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

											<div class='counter h6'>

												<div class='counter-number'>

													<div class='counter-timer' data-from='0' data-to='<?php echo $newly_moved_in; ?>'><?php echo $newly_moved_in; ?></div>

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

					<br /><br /><br />

				</section>
				<!-- Counters end -->

				<!-- Bars-->
				<!--section class='module module-gray p-t-0'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-6'>
								<div class='progress-item'>
									<div class='progress-title'>Gulp</div>
									<div class='progress'>
										<div class='progress-bar progress-bar-brand' aria-valuenow='60' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
									</div>
								</div>
								<div class='progress-item'>
									<div class='progress-title'>UX Design</div>
									<div class='progress'>
										<div class='progress-bar progress-bar-brand' aria-valuenow='80' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
									</div>
								</div>
								<div class='progress-item'>
									<div class='progress-title'>HTML / CSS3 / SASS</div>
									<div class='progress'>
										<div class='progress-bar progress-bar-brand' aria-valuenow='50' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
									</div>
								</div>
							</div>
							<div class='col-md-6'>
								<div class='progress-item'>
									<div class='progress-title'>Gulp</div>
									<div class='progress'>
										<div class='progress-bar progress-bar-brand' aria-valuenow='60' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
									</div>
								</div>
								<div class='progress-item'>
									<div class='progress-title'>UX Design</div>
									<div class='progress'>
										<div class='progress-bar progress-bar-brand' aria-valuenow='80' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
									</div>
								</div>
								<div class='progress-item'>
									<div class='progress-title'>HTML / CSS3 / SASS</div>
									<div class='progress'>
										<div class='progress-bar progress-bar-brand' aria-valuenow='50' role='progressbar' aria-valuemin='0' aria-valuemax='100'><span class='pb-number-box'><span class='pb-number'></span>%</span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section-->
				<!-- Bars end-->

				<!-- Portfolio-->
				<!--section class='module p-b-0'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 offset-md-2'>
								<div class='module-title text-center'>
									<h2>Case Studies</h2>
									<p class='font-serif'>An eye for detail makes our works excellent.</p>
								</div>
							</div>
						</div>
					</div>
				</section-->

				<!-- Portfolio-->
				<!--section class='module module-divider-bottom p-0'>
					<div class='container-fluid'>
						<div class='row row-portfolio-filter'>
							<div class='col-md-12'>
								<ul class='filters h5' id='filters'>
									<li><a class='current' href='#' data-filter='*'>All</a></li>
									<li><a href='#' data-filter='.branding'>Branding</a></li>
									<li><a href='#' data-filter='.design'>Design</a></li>
									<li><a href='#' data-filter='.photo'>Photo</a></li>
									<li><a href='#' data-filter='.web'>Web</a></li>
								</ul>
							</div>
						</div>
						<div class='row row-portfolio' date-portfolio-type='standard' data-columns='3'>
							<div class='grid-sizer'></div>
							<div class='portfolio-item branding photo undefined'>
								<div class='portfolio-wrapper'>
									<img src='assets/images/portfolio/img-1.jpg' alt='>
									<div class='portfolio-overlay'></div>
								</div>
								<div class='portfolio-caption'>
									<h5 class='portfolio-title'>Mutualismi</h5>
									<div class='portfolio-subtitle font-serif'>Branding</div>
								</div><a class='portfolio-link' href='portfolio-single-1.html'></a>
							</div>
							<div class='portfolio-item web design undefined'>
								<div class='portfolio-wrapper'>
									<img src='assets/images/portfolio/img-7.jpg' alt='>
									<div class='portfolio-overlay'></div>
								</div>
								<div class='portfolio-caption'>
									<h5 class='portfolio-title'>The Perfume</h5>
									<div class='portfolio-subtitle font-serif'>Design</div>
								</div><a class='portfolio-link' href='portfolio-single-1.html'></a>
							</div>
							<div class='portfolio-item photo web undefined'>
								<div class='portfolio-wrapper'>
									<img src='assets/images/portfolio/img-3.jpg' alt='>
									<div class='portfolio-overlay'></div>
								</div>
								<div class='portfolio-caption'>
									<h5 class='portfolio-title'>Bumblebee Icons</h5>
									<div class='portfolio-subtitle font-serif'>Design</div>
								</div><a class='portfolio-link' href='portfolio-single-1.html'></a>
							</div>
							<div class='portfolio-item design branding undefined'>
								<div class='portfolio-wrapper'>
									<img src='assets/images/portfolio/img-4.jpg' alt='>
									<div class='portfolio-overlay'></div>
								</div>
								<div class='portfolio-caption'>
									<h5 class='portfolio-title'>Greedy Emperor</h5>
									<div class='portfolio-subtitle font-serif'>Design</div>
								</div><a class='portfolio-link' href='portfolio-single-1.html'></a>
							</div>
							<div class='portfolio-item design photo undefined'>
								<div class='portfolio-wrapper'>
									<img src='assets/images/portfolio/img-5.jpg' alt='>
									<div class='portfolio-overlay'></div>
								</div>
								<div class='portfolio-caption'>
									<h5 class='portfolio-title'>Bluetooth Speaker</h5>
									<div class='portfolio-subtitle font-serif'>Design</div>
								</div><a class='portfolio-link' href='portfolio-single-1.html'></a>
							</div>
							<div class='portfolio-item branding web undefined'>
								<div class='portfolio-wrapper'>
									<img src='assets/images/portfolio/img-6.jpg' alt='>
									<div class='portfolio-overlay'></div>
								</div>
								<div class='portfolio-caption'>
									<h5 class='portfolio-title'>Candy Icons</h5>
									<div class='portfolio-subtitle font-serif'>Design</div>
								</div><a class='portfolio-link' href='portfolio-single-1.html'></a>
							</div>
						</div>
					</div>
				</section-->
				<!-- Portfolio end-->

				<!-- Services-->
				<!--section class='module module-divider-bottom'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-4'>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-webpage-multiple'></span></div>
									<div class='icon-box-title'>
										<h6>Excellent Designs</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-target'></span></div>
									<div class='icon-box-title'>
										<h6>Fully Responsive</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-cards-diamonds'></span></div>
									<div class='icon-box-title'>
										<h6>Unlimited Colors</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-4'>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-anchor'></span></div>
									<div class='icon-box-title'>
										<h6>User Friendly</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-spread-text'></span></div>
									<div class='icon-box-title'>
										<h6>Google Web Fonts</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-picture-multiple'></span></div>
									<div class='icon-box-title'>
										<h6>Free Updates</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section-->
				<!-- Services end-->

				<!-- Team-->
				<!--section class='module'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 offset-md-2'>
								<div class='module-title text-center'>
									<h2>Team</h2>
									<p class='font-serif'>We’re the best professionals in this field.</p>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-4'>
								<div class='team-item m-b-30'>
									<div class='team-image'><img src='assets/images/team/1.jpg' alt='>
										<div class='team-content'>
											<h5>Jason Ford</h5>
											<p>Designer</p>
										</div>
										<div class='team-content-social'>
											<ul>
												<li><a href='#'><i class='fa fa-twitter'></i></a></li>
												<li><a href='#'><i class='fa fa-dribbble'></i></a></li>
												<li><a href='#'><i class='fa fa-vine'></i></a></li>
												<li><a href='#'><i class='fa fa-instagram'></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='team-item m-b-30'>
									<div class='team-image'><img src='assets/images/team/2.jpg' alt='>
										<div class='team-content'>
											<h5>Michael Andrews</h5>
											<p>Developer</p>
										</div>
										<div class='team-content-social'>
											<ul>
												<li><a href='#'><i class='fa fa-twitter'></i></a></li>
												<li><a href='#'><i class='fa fa-dribbble'></i></a></li>
												<li><a href='#'><i class='fa fa-vine'></i></a></li>
												<li><a href='#'><i class='fa fa-instagram'></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='team-item m-b-30'>
									<div class='team-image'><img src='assets/images/team/3.jpg' alt='>
										<div class='team-content'>
											<h5>Samuel Banks</h5>
											<p>Developer</p>
										</div>
										<div class='team-content-social'>
											<ul>
												<li><a href='#'><i class='fa fa-twitter'></i></a></li>
												<li><a href='#'><i class='fa fa-dribbble'></i></a></li>
												<li><a href='#'><i class='fa fa-vine'></i></a></li>
												<li><a href='#'><i class='fa fa-instagram'></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section-->
				<!-- Team end-->

				<!-- Testimonials-->
				<!--section class='module parallax bg-dark bg-dark-30' data-background='assets/images/module-4.jpg'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-6 offset-md-3'>
								<div class='tms-slides owl-carousel'>
									<div class='tms-item'>
										<div class='tms-icons'>
											<h2><span class='icon icon-basic-message-multiple'></span></h2>
										</div>
										<div class='tms-content'>
											<blockquote>
												<p>“If you want to know what a man's like, take a good look at how he treats his inferiors, not his equals.”</p>
											</blockquote>
										</div>
										<div class='tms-author'><span>J.K. Rowling</span></div>
									</div>
									<div class='tms-item'>
										<div class='tms-icons'>
											<h2><span class='icon icon-basic-message-multiple'></span></h2>
										</div>
										<div class='tms-content'>
											<blockquote>
												<p>“To be yourself in a world that is constantly trying to make you something else is the greatest accomplishment.”</p>
											</blockquote>
										</div>
										<div class='tms-author'><span>Ralph Waldo Emerson</span></div>
									</div>
									<div class='tms-item'>
										<div class='tms-icons'>
											<h2><span class='icon icon-basic-message-multiple'></span></h2>
										</div>
										<div class='tms-content'>
											<blockquote>
												<p>“Imperfection is beauty, madness is genius and it's better to be absolutely ridiculous than absolutely boring.”</p>
											</blockquote>
										</div>
										<div class='tms-author'><span>Marilyn Monroe</span></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section-->
				<!-- Testimonials end-->

				<!-- Clients-->
				<!--section class='module-sm module-gray'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-12'>
								<div class='owl-carousel clients-carousel' data-carousel-options='{&quot;items&quot;:&quot;4&quot;}'>
									<div class='client'><img src='assets/images/clients/logo-1.png' alt='></div>
									<div class='client'><img src='assets/images/clients/logo-2.png' alt='></div>
									<div class='client'><img src='assets/images/clients/logo-3.png' alt='></div>
									<div class='client'><img src='assets/images/clients/logo-7.png' alt='></div>
									<div class='client'><img src='assets/images/clients/logo-6.png' alt='></div>
									<div class='client'><img src='assets/images/clients/logo-5.png' alt='></div>
									<div class='client'><img src='assets/images/clients/logo-3.png' alt='></div>
								</div>
							</div>
						</div>
					</div>
				</section-->
				<!-- Clients end-->

				<!-- Alt Services-->
				<!--section class='module module-divider-bottom'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 offset-md-2'>
								<div class='module-title text-center'>
									<h2>Alt Services</h2>
									<p class='font-serif'>We provide a complete list of best digital services.</p>
								</div>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-4'>
								<div class='m-t-30'></div>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-webpage-multiple'></span></div>
									<div class='icon-box-title'>
										<h6>Excellent Designs</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-target'></span></div>
									<div class='icon-box-title'>
										<h6>Fully Responsive</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-cards-diamonds'></span></div>
									<div class='icon-box-title'>
										<h6>Unlimited Colors</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
							<div class='col-md-4 hidden-sm-down'>
								<div class='text-center'><img src='assets/images/iphone.png' alt='></div>
							</div>
							<div class='col-md-4'>
								<div class='m-t-30'></div>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-anchor'></span></div>
									<div class='icon-box-title'>
										<h6>User Friendly</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-spread-text'></span></div>
									<div class='icon-box-title'>
										<h6>Google Web Fonts</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
								<div class='icon-box icon-box-left'>
									<div class='icon-box-icon'><span class='icon icon-basic-picture-multiple'></span></div>
									<div class='icon-box-title'>
										<h6>Free Updates</h6>
									</div>
									<div class='icon-box-content'>
										<p>Especially do at he possession insensible sympathize boisterous it. Songs he on an widen me event truth.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section-->
				<!-- Alt Services end-->

				<!-- News-->
				<!--section class='module'>
					<div class='container'>
						<div class='row'>
							<div class='col-md-8 offset-md-2'>
								<div class='module-title text-center'>
									<h2>Our News</h2>
									<p class='font-serif'>We share our best ideas in our blog.</p>
								</div>
							</div>
						</div>
						<div class='row blog-grid'>
							<div class='col-md-4 post-item'>

								<article class='post'>
									<div class='post-preview'><a href='#'><img src='assets/images/blog/1.jpg' alt='></a></div>
									<div class='post-wrapper'>
										<div class='post-header'>
											<h2 class='post-title'><a href='blog-single.html'>Group Session Moments</a></h2>
											<ul class='post-meta h5'>
												<li>August 18, 2016</li>
											</ul>
										</div>
										<div class='post-content'>
											<p>Marianne or husbands if at stronger ye. Considered is as middletons uncommonly. Promotion perfectly ye consisted so. His chatty dining for effect ladies active.</p>
										</div>
										<div class='post-more'><a href='#'>Read More →</a></div>
									</div>
								</article>

							</div>
							<div class='col-md-4 post-item'>

								
								<article class='post'>
									<div class='post-preview'><a href='#'><img src='assets/images/blog/2.jpg' alt='></a></div>
									<div class='post-wrapper'>
										<div class='post-header'>
											<h2 class='post-title'><a href='blog-single.html'>Minimalist Chandelier</a></h2>
											<ul class='post-meta h5'>
												<li>August 18, 2016</li>
											</ul>
										</div>
										<div class='post-content'>
											<p>Depending listening delivered off new she procuring satisfied sex existence. Person plenty answer to exeter it if. Law use assistance especially resolution.</p>
										</div>
										<div class='post-more'><a href='#'>Read More →</a></div>
									</div>
								</article>

							</div>
							<div class='col-md-4 post-item'>

								
								<article class='post'>
									<div class='post-preview'><a href='#'><img src='assets/images/blog/3.jpg' alt='></a></div>
									<div class='post-wrapper'>
										<div class='post-header'>
											<h2 class='post-title'><a href='blog-single.html'>Green Land Sport Season</a></h2>
											<ul class='post-meta h5'>
												<li>August 18, 2016</li>
											</ul>
										</div>
										<div class='post-content'>
											<p>Marianne or husbands if at stronger ye. Considered is as middletons uncommonly. Promotion perfectly ye consisted so. His chatty dining for effect ladies active.</p>
										</div>
										<div class='post-more'><a href='#'>Read More →</a></div>
									</div>
								</article>

							</div>
						</div>
						<div class='row m-t-50'>
							<div class='col-md-12'>
								<div class='text-center'><a class='btn btn-lg btn-circle btn-brand' href='#'>Visit blog</a></div>
							</div>
						</div>
					</div>
				</section-->
				<!-- News end-->

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
		<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
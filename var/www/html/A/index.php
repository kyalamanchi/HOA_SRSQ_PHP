<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			session_start();

			if($_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = 2;
			$days90 = date('Y-m-d', strtotime("-90 days"));
			$today = date('Y-m-d');

			$res_dir = pg_num_rows(pg_query("SELECT * FROM member_info WHERE community_id=$community_id"));
			$email_homes = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id"));
			$total_homes = pg_num_rows(pg_query("SELECT * FROM homeid WHERE community_id=$community_id"));
			$tenants = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE community_id=$community_id"));
			$newly_moved_in = pg_num_rows(pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>='".$days90."' AND valid_from<='".date('Y-m-d')."'"));

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Square Association'>
		<meta name='author' content='Geeth'>

		<title>Stoneridge Square Association</title>

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

			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-left'>

						<a><h5 style='color: green;'>Stoneridge Square Association</h5></a>

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

			<!-- Header-->
			<header class='header header-right undefined'>

				<div class='container-fluid'>

					<div class='inner-header'>
						
						<a class='inner-brand' href='index.php'><h5 style='color: green;'>Stoneridge Square Association</h5></a>

					</div>

					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>

							<div class='inner-nav'>

								<ul>

									<li><a href='index.php'><i class='fa fa-home'></i> Home</a></li>
									<li><a class='smoothscroll' href='#pay_online'><i class='fa fa-dollar'></i> Pay Online</a></li>
									<li><a class='smoothscroll' href='#budget'><i class='fa fa-calendar-o'></i> 2017 Budget</a></li>
									<li><a class='smoothscroll' href='#r_p'><i class='fa fa-gavel'></i> Rule &amp; Policies</a></li>
									<li><a class='smoothscroll' href='#contact'><i class='fa fa-phone'></i> Contact Us</a></li>
									<li><a href='login_page.php' style='color: green;'><i class='fa fa-sign-in'></i> Log In</a></li>
									<!--data-toggle='modal' data-target='#login_modal'-->
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

			<!-- Wrapper-->
			<div class='wrapper'>

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

				<div class='modal fade' id='payment_modal'>
					
					<div class='modal-dialog'>
						
						<div class='modal-content'>
							
							<form method='POST' action='paymentPage1.php' role='form'>

							<div class='modal-header'>
								
								<h5 class='modal-title' style='color: green;'>Select User / HOA Account Number</h5>
								<button class='close' type='button' data-dismiss='modal' aria-label='Close'><span>&times;</span></button>
							
							</div>
												
							<div class='modal-body'>
								
								<p>

									<select required name='payment_hoa_id' id='payment_hoa_id' class='form-control'>

										<option value='' selected disabled>Select User</option>

										<?php

											$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND valid_until>='$today'");

											while($row = pg_fetch_assoc($result))
											{

												$hoa_id = $row['hoa_id'];
												$name = $row['firstname'];
												$name .= " ";
												$name .= $row['lastname'];

												echo "<option value='$hoa_id'>$name</option>";

											}

										?>

									</select>

								</p>
							
							</div>
							
							<div class='modal-footer'>
													
								<button class='btn btn-round btn-success btn-sm' type='submit'>Make Payment</button>
							
							</div>

							</form>
						
						</div>
					
					</div>
				
				</div>

				<!-- Counters -->
				<section class='module module-gray p-b-0'>

					<div class='container'>

						<div class='row'>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $res_dir; ?></div>

									</div>

									<div class='counter-title'>Resident Directory</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $email_homes; ?></div>

									</div>

									<div class='counter-title'>Homes with emails</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo ($total_homes - $tenants); ?></div>

									</div>

									<div class='counter-title'>Owners</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $tenants; ?></div>

									</div>

									<div class='counter-title'>Tenants</div>

								</div>

							</div>

							<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6'>

								<div class='counter h6'>

									<div class='counter-number'>

										<div><?php echo $newly_moved_in; ?></div>

									</div>

									<div class='counter-title'>Newly moved in</div>

								</div>

							</div>

						</div>

						<br>

					</div>

				</section>
				<!-- Counters end -->

				<!-- Row 1 -->
				<section class='module p-t-0 p-b-0'>

					<div class='container'>

						<div class='row'>

							<div id='budget' class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
								
								<div class='icon-box'>
									
									<div class='icon-box-title text-center'><h3>2017 Budget</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<p>Here are the key changes</p>

										<ul>
											
											<li> <strong>></strong> Increased Insurance coverage of common areas from 372,000 to 950,000 to ensure we are adequately covered.</li>
											<li> <strong>></strong> Reduced Administrative charges by 21% or roughly $15,000.</li>
											<li> <strong>></strong> Increased repair spending by $16,000 to pay for Special Projects like Security, Locked Mailboxes, Solar, Internet at Pool etc. without increasing monthly dues or special assessments.</li>
											<li> <strong>></strong> Landscaping charges go down by 15%.</li>
											<li> <strong>></strong> Contributions to Savings account increased by 12% or $42/month vs. 37.5/month in 2016.</li>
											<li> <strong>></strong> Legal Fees go up by $10,000 more than last year to re-write our <a href='https://www.dropbox.com/s/pt3pcf2cq6pa8f7/SRP_CCR.pdf?dl=0' target='_blank'>CCR</a> which are 20 years old.</li>

										</ul>

									</div>

									<div class='icon-box-link text-center'><a target='_blank' href='https://www.dropbox.com/s/tu8lg7u8ha5ue0g/SRP-2017-Budget.pdf?dl=0'>Click here for 2017 Approved Budget</a></div>

								</div>

							</div>

							<div id='r_p' class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12'>
								
								<div class='icon-box'>
									
									<div class='icon-box-title text-center'><h3>Rules &amp; Policies</h3></div>

									<hr class='small'>

									<div class='icon-box-content'>
										
										<p>These documents define the procedures and operating standards that the BHHOA will follow as a business entity, outlining what the organization can and cannot do.</p>

										<ul>
											
											<li> <strong>></strong> <a href='https://www.dropbox.com/s/l0labmzxng9svay/SRP_ByLaws.pdf?dl=0' target='_blank'>SRP Bylaws.</a></li>
											<li> <strong>></strong> <a href='https://www.dropbox.com/s/jvyazuph8aawqb0/SRP_Articles.pdf?dl=0' target='_blank'>Articles of Incorporation.</a></li>
											<li> <strong>></strong> SRP Mission Statement (Coming Soon).</li>
											<li> <strong>></strong> Proposed <a href='https://www.dropbox.com/s/qxs87krtuzmk9o4/SRP_Voting_Rules_2016.pdf?dl=0' target='_blank'>Voting &amp; Elections Procedure.</a></li>

										</ul>

										<p>These documents more directly affect Stoneridgeplace at Pleasanton residents.</p>

										<ul>
											
											<li> <strong>></strong> Proposed <a href='https://www.dropbox.com/s/z2h2ftloelhls4y/SRP_Pool_Rules_package.pdf?dl=0' target='_blank'>Swimming Pool Rules.</a></li>
											<li> <strong>></strong> <a href='https://www.dropbox.com/s/d6yy4dqfuxx8ot7/SRP_Enforcement_Rules.pdf?dl=0' target='_blank'>CC&amp;R Enforcement Policy.</a></li>
											<li> <strong>></strong> <a href='https://www.dropbox.com/s/itkykruoja3gcw3/SRP_Architectural_Guidelines.pdf?dl=0' target='_blank'>Architectural Rules.</a></li>
											<li> <strong>></strong> <a href='https://www.dropbox.com/s/b1lokm15snl97zy/SRP_Collection-Policy.pdf?dl=0' target='_blank'>Delinquent Assessment Collection Policy.</a></li>
											<li> <strong>></strong> Adjoining Fence Policy – Coming Soon.</li>
											<li> <strong>></strong> <a href='https://www.dropbox.com/s/pt3pcf2cq6pa8f7/SRP_CCR.pdf?dl=0' target='_blank'>Covenants, Conditions &amp; Restrictions</a> – Will be updated in 2017.</li>

										</ul>

										<p>Update to Governing Documents, Mission Statement, CCR and Architectural Rules and Delinquency policy are coming in 2017 to</p>

										<ul>
											
											<li> <strong>></strong> Simplify Governance</li>
											<li> <strong>></strong> Effective collection policy to reduce Bad Debts with changing industry needs.</li>

										</ul>

									</div>

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- Pay Online -->
				<section id='pay_online' class='module module-gray'>

					<div class='container'>

						<div>
							
							<center>Click the <strong>Pay Now</strong> button below to enter your payment details with the Payment gateway directly to make a One time Payment.</center>

						</div>

						<br>

						<div>
							
							<center><a class='btn btn-success btn-circle btn-xs' href='paymentPage1.php' target='_blank'>Pay Now</a></center>

						</div>

					</div>

				</section>
				<!-- Bars end-->

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

				<!-- Contact -->
				<section id='contact' class='module'>

					<div class='container'>

						<div class='row'>

							<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
								
								<p><strong>How not to contact us</strong></p>

								<ul>
									
									<li> <strong>></strong> Do not leave anonymous correspondence, by any method. Always leave your name and address. We can not act upon or respond to any anonymous correspondence, unless it is a CC&amp;R complaint that we can verify ourselves. All correspondence is kept confidential.</li>
									<li> <strong>></strong> Do not leave or mail correspondence in a Board or Committee member’s personal home mailboxes.  Individuals may be out of town, thereby delaying the routing of your correspondence to the Association.  SRP PO Box is regularly checked.</li>

								</ul>

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<footer class='footer'>

					<div class='container'>

						<div class='row'>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>

								<aside class='widget widget_text'>
									
									<div class='textwidget'>
										
										<p><h3>Stoneridge Square Association</h3></p>

									</div>

								</aside>

							</div>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
								
								<aside class='widget widget_tag_cloud'>

									<div class='textwidget'>
										
										PO BOX 101901, Pleasanton, CA 94588<br />
										E-mail: <a href='mailto:billing@stoneridgesquare.org'>billing@stoneridgesquare.org</a> <br/>
										Phone: 925 399 6642

									</div>

								</aside>

							</div>

						</div>

					</div>

					<div class='footer-copyright'>

						<div class='container'>

							<div class='row'>

								<div class='col-md-12'>

									<div class='text-center'>

										<span class='copyright'>© <?php echo date('Y'); ?> Stoneridge Square Association, All Rights Reserved.</span>

									</div>

								</div>

							</div>

						</div>

					</div>

				</footer>

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

	</body>

</html>
<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			session_start();

			if($_SESSION['hoa_username'])
				header('Location: logout.php');

			pg_connect('host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy');

			$community_id = 1;
			$days90 = date('Y-m-d', strtotime('-90 days'));

			$res_dir = pg_num_rows(pg_query('SELECT * FROM member_info WHERE community_id=$community_id'));
			$email_homes = pg_num_rows(pg_query('SELECT * FROM hoaid WHERE email!='' AND community_id=$community_id'));
			$total_homes = pg_num_rows(pg_query('SELECT * FROM homeid WHERE community_id=$community_id'));
			$tenants = pg_num_rows(pg_query('SELECT * FROM home_mailing_address WHERE community_id=$community_id'));
			$newly_moved_in = pg_num_rows(pg_query('SELECT * FROM hoaid WHERE community_id=$community_id AND valid_from>=''.$days90.'' AND valid_from<=''.date('Y-m-d').'''));

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title>Stoneridge Place At Pleasanton</title>

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
			<header class='header header-right undefined'>

				<div class='container-fluid'>

					<div class='inner-header'>
						
						<a class='inner-brand' href='index.php'><h5 style='color: green;'>Stoneridge Place<br>At Pleasanton HOA</h5></a>

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
									<li><a data-toggle='modal' data-target='#login_modal' style='color: green;'><i class='fa fa-sign-in'></i> Log In</a></li>

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

				<section class='module'>

					<div class='container'>

						<div class='row'>

							<div class='col-md-4 offset-md-4'>

								<div class='up-logo'>

									<p><center><h3>Stoneridge Place</h3><h4>At Pleasanton HOA</h4></center></p>

								</div>

								<div class='up-form'>

									<form method='post'>

										<div class='form-group'>

											<input class='form-control form-control-lg' name='srp_login_email' id='srp_login_email' type='email' placeholder='Email' required>

										</div>

										<div class='form-group'>

											<input class='form-control form-control-lg' name='srp_login_password' id='srp_login_password' type='password' placeholder='Password' required>

										</div>

										<div class='form-group'>

											<button class='btn btn-block btn-lg btn-round btn-brand' type='submit'>Log in</button>

										</div>

									</form>

								</div>

								<div class='up-help'>

									<p><a href='#'>Forgot your password?</a></p>
									<p>Don't have an account yet? <a href='#'>Sign in</a></p>

								</div>

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
										
										<p><h3>Stoneridge Place</h3><h4>At Pleasanton HOA</h4></p>

									</div>

								</aside>

							</div>

							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6'>
								
								<aside class='widget widget_tag_cloud'>

									<div class='textwidget'>
										
										PO Box 5272 , Pleasanton, CA 94566<br />
										E-mail: <a href='mailto:info@stoneridgeplace.org'>info@stoneridgeplace.org</a> <br/>
										Phone: 925 201 3902

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

										<span class='copyright'>© <?php echo date('Y'); ?> Stoneridge Place At Pleasanton HOA, All Rights Reserved.</span>

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
		<!--<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>-->
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
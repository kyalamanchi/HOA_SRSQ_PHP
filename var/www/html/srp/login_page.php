<?php
		ini_set("session.save_path","/var/www/html/session/");
			session_start();
?>
<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			if($_SESSION['hoa_username'])
				header('Location: logout.php');

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
									<li><a href='login_page.php' style='color: green;'><i class='fa fa-sign-in'></i> Log In</a></li>

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

							<div class='col-xl-4 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-4 offset-lg-3 offset-md-2 offset-sm-1'>

								<div class='up-logo'>

									<center><h3>Stoneridge Place<br>At Pleasanton HOA</h3></center>

								</div>

								<div class='up-form'>

									<form method='POST' action='login.php'>

										<div class='form-group'>

											<input class='form-control form-control-lg' name='srp_login_email' id='srp_login_email' type='email' placeholder='Email' required>

										</div>

										<div class='form-group'>

											<input class='form-control form-control-lg' name='srp_login_password' id='srp_login_password' type='password' placeholder='Password' required>

										</div>

										<div class='form-group'>

											<button class='btn btn-block btn-lg btn-round btn-success' type='submit'><i class='fa fa-sign-in'></i> Log In</button>

										</div>

									</form>

								</div>

								<div class='up-help'>

									<p><a href='#'>Forgot your password ?</a></p>

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
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
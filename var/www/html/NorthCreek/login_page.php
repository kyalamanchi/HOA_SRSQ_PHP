<!DOCTYPE html>
<html lang='en'>
	<head>
		
		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content=''>
		<meta name='author' content=''>
		
		<title>The Reserve at North Creek</title>
		
		<!-- Bootstrap core CSS-->
		<link href='assets/bootstrap/css/bootstrap.min.css' rel='stylesheet'>
		<!-- Icon Fonts-->
		<link href='assets/css/font-awesome.min.css' rel='stylesheet'>
		<link href='assets/css/linea-arrows.css' rel='stylesheet'>
		<link href='assets/css/linea-icons.css' rel='stylesheet'>
		<!-- Template core CSS-->
		<link href='assets/css/template.min.css' rel='stylesheet'>

	</head>

	<body>

		<!-- Layout-->
		<div class='layout'>

			<!-- Header-->
			<?php include "home_header.php"; ?>

			<!-- Wrapper-->
			<div class='wrapper'>

				<section class='module'>

					<div class='container'>

						<div class='row'>

							<div class='col-md-4 offset-md-4'>

								<div class='up-logo'>

									<p class='text-center m-b-50'><img src='assets/images/logo.png' width='100' alt='Logo'></p>

								</div>

								<div class='up-form'>

									<form method='post' action='testing.php'>

										<div class='form-group'>

											<input class='form-control form-control-lg' id='login_email' name='login_email' type='email' placeholder='Email' required>

										</div>

										<div class='form-group'>

											<input class='form-control form-control-lg' id='login_password' name='login_password' type='password' placeholder='Password' required>

										</div>

										<div class='form-group'>

											<button class='btn btn-block btn-lg btn-round btn-brand' type='submit'>Log in</button>

										</div>

									</form>

								</div>

								<div class='up-help'>

									<p><a href='forgot_password.php'>Forgot your password?</a></p>
									<p>Don't have an account yet? <a href='#'>Register Now</a></p>

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- Footer -->
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
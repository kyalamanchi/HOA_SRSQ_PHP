<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name='description' content='Stoneridge Square Association'>
		<meta name='author' content='Geeth'>

		<title>Stoneridge Square Association</title>

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
		<link href="assets/css/vertical.min.css" rel="stylesheet">
		<link href="assets/css/pace-theme-minimal.css" rel="stylesheet">
		<link href="assets/css/animate.css" rel="stylesheet">
		<!-- Template core CSS-->
		<link href="assets/css/template.min.css" rel="stylesheet">

	</head>

	<body>

		<style type="text/css">
			
			body {
  				background: #ecf0f1;
			}

			.loader {
  				width: 50px;
  				height: 30px;
  				position: absolute;
  				left: 50%;
  				top: 50%;
  				transform: translate(-50%, -50%);
			}
			.loader:after {
  				position: absolute;
  				content: "Loading";
  				bottom: -40px;
  				left: -2px;
  				text-transform: uppercase;
  				font-family: "Arial";
  				font-weight: bold;
  				font-size: 12px;
			}

			.loader > .line {
  				background-color: #333;
  				width: 6px;
  				height: 100%;
  				text-align: center;
  				display: inline-block;
  
  				animation: stretch 1.2s infinite ease-in-out;
			}

			.line.one {
			  	background-color: #2ecc71; 
			}

			.line.two {
			  	animation-delay:  -1.1s;
			  	background-color:#3498db;
			}
			.line.three {
			  	animation-delay:  -1.0s;
			  	background-color:#9b59b6;
			}
			.line.four {
			  	animation-delay:  -0.9s;
			   	background-color: #e67e22;
			}
			.line.five {
			  	animation-delay:  -0.8s;
			  	background-color: #e74c3c;
			}

			@keyframes stretch {
			  	0%, 40%, 100% { transform: scaleY(0.4); }
			  	20% {transform: scaleY(1.0);}
			}

		</style>

		<div class="loader">
  			
  			<div class="line one"></div>
  			<div class="line two"></div>
  			<div class="line three"></div>
  			<div class="line four"></div>
  			<div class="line five"></div>
		
		</div>

		<!-- Layout-->
		<div class="layout">

			<!-- Header-->
			<header class='header header-right undefined'>

				<div class='container-fluid'>

					<div class='inner-header'>
						
						<a><h4 class='h4' style='color: green;'>STONERIDGE SQUARE ASSOCIATION</h4></a>

					</div>

					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>

							<div class='inner-nav'>

								<ul>

									<li><a href='index.php'><i class='fa fa-home'></i> Home</a></li>
									<li><a class='smoothscroll' href='index.php#get_involved'><i class='fa fa-comment'></i> Get Involved</a></li>
									<li><a target='_blank' href='http://stoneridgesquare.us12.list-manage.com/subscribe?u=12a11bf64aa26b44b5b667427&id=09692e90bd'><i class='fa fa-envelope'></i> Mailing List</a></li>
									<li><a target='_blank' href='https://hoaboardtime.com/paymentPage1.php'><i class='fa fa-dollar'></i> Pay Online</a></li>
									<li><a class='smoothscroll' href='#contact'><i class='fa fa-phone'></i> Contact</a></li>
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
			<div class="wrapper">

				<section class="module">

					<div class="container">

						<div class="row">

							<div class="col-md-4 offset-md-4">

								<div class="up-logo">

									<h1 class="h2 m-b-20" style='color: green;'><i><span class="rotate">Stoneridge Square Association | Pleasanton Home Owner Community</span></i></h1>

								</div>

								<div class="up-form">

									<form method="post">

										<div class="form-group">

											<input class="form-control form-control-lg" type="email" name='srsq_login_email' id='srsq_login_email' placeholder="Email">

										</div>

										<div class="form-group">

											<input class="form-control form-control-lg" type="password" name='srsq_login_password' id='srsq_login_password' placeholder="Pasword">

										</div>

										<div class="form-group">

											<button class="btn btn-block btn-xs btn-round btn-brand" type="submit"><i class='fa fa-sign-in'></i> Log In</button>

										</div>

									</form>

								</div>

								<!--div class="up-help">

									<p><a>Forgot your password?</a></p>

								</div-->

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<footer id='contact' class='footer' style="background: green;">

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
										
										PO BOX 5272, Pleasanton, CA 94566<br />
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

										<span class='copyright'>Copyright © <?php echo date('Y'); ?> - <a target='_blank' href='https://www.stoneridgesquare.org/'>Stoneridge Square Association</a> - All Rights Reserved.</span>

									</div>

								</div>

							</div>

						</div>

					</div>

				</footer>

			</div>
			<!-- Wrapper end-->

		</div>
		<!-- Layout end-->

		<!-- Scripts-->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/custom.min.js"></script>
	</body>
</html>
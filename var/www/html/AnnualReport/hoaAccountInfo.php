<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header('Location: logout.php');

	$email = $_SESSION['hoa_alchemy_email'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$username = $_SESSION['hoa_alchemy_username'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$community_code = $_SESSION['hoa_alchemy_community_code'];
	$community_name = $_SESSION['hoa_alchemy_community_name'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

		<title><?php echo $community_code; ?> - HOA Account Info</title>

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
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

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

		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-left'>

						<a><h5 style='color: green;'><?php echo $community_name; ?></h5></a>

					</div>

					<!-- Navigation-->
					<div class='inner-navigation collapse'>

						<div class='inner-navigation-inline'>
				
							<div class='inner-nav'>
						
								<ul>

									<li><a style="color: green;"><span>Hello <?php echo $username; ?></span></a></li>

								</ul>

							</div>

						</div>

					</div>
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>

						<div id='hoa_account_info'>

							<div class='row'>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h2>HOA Account Info</h2></center>

								</div>

								<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

									<center><h4>Set your HOA Account Password</h4></center>

								</div>

							</div>

							<div class='row'><div id='bcrypt_div' class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center'></div></div>

                            <div class='row'>

                                <div class='col-xl-4 col-lg-4 col-md-6 col-sm-8 col-xs-10 offset-xl-4 offset-lg-4 offset-md-3 offset-sm-2 offset-xs-1 module-gray'>

                                    <br>

                                    <form method='POST' action='resetHOAAccountPassword.php'>

                                        <div class='row'>

                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                <label><strong>Username</strong></label>
                                                <br>
                                                <input class='form-control' type="email" name="username" id='username' placeholder='Enter Password' value='<?php echo $email; ?>' readonly>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='row'>

                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                <label><strong>Enter Password</strong></label>
                                                <br>
                                                <input class='form-control' type="password" name="set_password" id='set_password' placeholder='Enter Password' required>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='row'>

                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                <label><strong>Confirm Password</strong></label>
                                                <br>
                                                <input class='form-control' type="password" name="confirm_password" id='confirm_password' placeholder='Confirm Password' required>

                                            </div>

                                        </div>

                                        <br>

                                        <div class='row'>

                                            <div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

                                                <center>
                                                    
                                                    <button type='submit' class='btn btn-xs btn-success'><i class='fa fa-lock'></i> Set Password</button>

                                                    <a href='logout.php' class='btn btn-xs btn-warning'><i class='fa fa-sign-out'></i> Exit</a>

                                                </center>

                                            </div>

                                        </div>

                                    </form>

                                    <br>

                                    <center><strong>Note : </strong> Above email id will be the username for your HOA Account.</center>

                                </div>

                            </div>

						</div>

					</div>

				</section>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js"></script>
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/charts.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/hoaAccountInfo.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	</body>

</html>
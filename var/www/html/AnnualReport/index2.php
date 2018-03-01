<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!isset($_REQUEST['hoa_id']))
		header('Location: logout.php');

	$hoa_id = $_REQUEST['hoa_id'];

	$result = pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id");

	if(!pg_num_rows($result))
	{	
		
		echo "<script type='text/javascript'> alert('Invalid HOA Account Number.'); </script><script>setTimeout(function(){window.location.href='index.php'},2000);</script>";

		die();

	}

	$_SESSION['hoa_alchemy_hoa_id'] = $hoa_id;

	$row = pg_fetch_assoc($result);

	$first_name = $row['firstname'];
	$last_name = $row['lastname'];
	$cell_no = $row['cell_no'];
	$community_id = $row['community_id'];

	$cell_no = base64_decode($cell_no);

	$row = pg_fetch_assoc(pg_query("SELECT * FROM community_info WHERE community_id=$community_id"));

	$community_name = $row['legal_name'];
	$community_code = $row['community_code'];

	$ocell_no = $cell_no;

	$c = $cell_no % 100;

	if($c >= 0 && $c <= 9)
		$c = sprintf('%02d', $c);

	$i = 0;

	while($cell_no > 0)
	{

		$i++;
		$cell_no = $cell_no / 10;
		$cell_no = floor($cell_no);

	}

	$cell_no = $c;
								
	$i = $i - 2;

	for($j = 0; $j < $i; $j++)
		$cell_no = "x".$cell_no;

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>

		<title><?php echo $community_code; ?> - Confirm User Identity</title>

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
		<link href="assets/css/magnific-popup.css" rel="stylesheet">
		<link href="assets/css/vertical.min.css" rel="stylesheet">
		<link href="assets/css/pace-theme-minimal.css" rel="stylesheet">
		<link href="assets/css/animate.css" rel="stylesheet">
		<link href='assets/css/wizard.min.css' rel='stylesheet'>
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

		<div class='layout'>

			<!-- Header-->
			<header class='header header-left undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header text-left'>

						<a><h5 style='color: green;'><?php echo $community_name; ?></h3></5>

					</div>
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 id='page_title1' class='h5'>Confirm User Identity</h1>
								<h1 id='page_title2' class='h5'>Verify User</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>
							
						<div id='confirm_phone_div' class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

							<div class='special-heading m-b-40'>

								<h2 class='h2'>Welcome <?php echo $first_name; ?></h2>

							</div>

							<div class='container' style='color: black;'>
										
								<form method='POST' action='sendOTP.php' class='ajax1'>

									<div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

										<center>Enter your 10 digit mobile number.</center>

									</div>

									<br>

									<div class='col-xl-4 col-lg-4 col-md-6 col-sm-8 col-xs-10 offset-xl-4 offset-lg-4 offset-md-3 offset-sm-2 offset-xs-1'>

										<input class='form-control' type='number' name='confirm_cell_no' id='confirm_cell_no' placeholder='<?php echo $cell_no; ?>'>

										<input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>
										<input type='hidden' name='community_id' id='community_id' value='<?php echo $community_id; ?>'>
										<input type='hidden' name='name' id='name' value='<?php echo $first_name." ".$last_name; ?>'>
										<input type='hidden' name='ocell_no' id='ocell_no' value='<?php echo $ocell_no; ?>'>

									</div>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

										<hr><br>

										<button class='btn btn-success btn-sm'>Continue <i class='fa fa-arrow-right'></i></button>

									</div>

								</form>

							</div>

						</div>

						<div id='verify_user_div' class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>

							<div class='special-heading m-b-40'>

								<h2 class='h2'>Welcome <?php echo $first_name; ?></h2>

							</div>

							<div class='container' style='color: black;'>
										
								<form method='POST' action='verifyOTP.php' class='ajax2'>

									<div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

										<center>Enter the OTP sent to your phone via SMS<br>( <i class='fa fa-mobile'></i> : <?php echo $cell_no; ?> ).</center>

									</div>

									<br>

									<div class='col-xl-4 col-lg-4 col-md-4 col-sm-8 col-xs-10 offset-xl-4 offset-lg-4 offset-md-4 offset-sm-2 offset-xs-1'>

										<input class='form-control' type='number' name='enter_otp' id='enter_otp' placeholder='Enter OTP'>

										<input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

									</div>

									<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

										<hr><br>

										<button class='btn btn-success btn-sm'>Continue <i class='fa fa-arrow-right'></i></button>

									</div>

								</form>

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
		<script src="assets/js/plugins.min.js"></script>
		<script src="assets/js/custom.min.js"></script>

		<script src='assets/js/index.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
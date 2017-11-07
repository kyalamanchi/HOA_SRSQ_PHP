<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$hoa_id = $_REQUEST['hoa_id'];
	$community_id = $_REQUEST['community_id'];
	$community_code = $_REQUEST['community_code'];
	$community_name = $_REQUEST['community_name'];

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

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

		<div class='layout'>

			<!-- Header-->
			<header class='header header-right undefined'>
	
				<div class='container-fluid'>
								
					<!-- Logos-->
					<div class='inner-header'>

						<a class='inner-brand'><h3 style='color: green;'><?php echo $community_name; ?></h3></a>

					</div>
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 class='h5'>Confirm User Identity</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>
							
						<div class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>
						
							<?php

								$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

								$first_name = $row['firstname'];
								$last_name = $row['lastname'];
								$cell_no = $row['cell_no'];

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

							<ul class='nav nav-tabs'>
									
								<li class='nav-item'><a class='nav-link active' href='#tab-1' data-toggle='tab'>Confirm Phone Number</a></li>
								<li class='nav-item'><a class='nav-link disabled' href='#tab-2' data-toggle='tab'>Verify User</a></li>

							</ul>

							<div class='tab-content'>

								<div class='tab-pane in active' id='tab-1'>

									<div class='special-heading m-b-40'>

										<h2 class='h2'>Welcome <?php echo $first_name." ".$last_name; ?></h2>

									</div>

									<div class='container' style='color: black;'>

										<?php

											function($cell_number)
											{
												echo $cell_number;
											}

										?>

										<script type='text/javascript'>
   											
   											function sendOTP(){
      
      											var model=$('#confirm_cell_no').val();

      											if (model == '') {model = "Please enter your phone number."}

      											$.ajax({
   												
   													url: "index.php",
   												
   													success: function(data){
     												
     													model = data;

   													}

 												});

      											alert(model);
	
											}

										</script>

										<form>

											<div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-12 offset-xl-3 offset-lg-3 offset-md-2 offset-sm-1'>

												<center>Please enter your mobile number.</center>

											</div>

											<br>

											<div class='col-xl-4 col-lg-4 col-md-4 col-sm-8 col-xs-10 offset-xl-4 offset-lg-4 offset-md-4 offset-sm-2 offset-xs-1'>

												<input class='form-control' type='number' name='confirm_cell_no' id='confirm_cell_no' placeholder='<?php echo $cell_no; ?>' required>

												<input type='hidden' name='hoa_id' id='hoa_id' value='<?php echo $hoa_id; ?>'>

											</div>

											<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right'>

												<hr><br>

												<button onclick='sendOTP(this)' class='btn btn-success btn-sm'>Continue <i class='fa fa-arrow-right'></i></button>

											</div>

										</form>

									</div>

								</div>

							</div>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include 'footer.php'; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

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
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
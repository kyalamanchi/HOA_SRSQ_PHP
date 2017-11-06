<?php
	
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

?>

<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title>First Page</title>

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

						<a class='inner-brand'><h3 style='color: green;'>HOA</h3></a>

					</div>
				
				</div>

			</header>

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 class='h5'>Select Community &amp; User</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container'>
							
						<div class='col-xl-6 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-3 offset-lg-2 offset-md-1'>
						
							<ul class='nav nav-tabs'>

									<?php

										$result = pg_query("SELECT * FROM community_info ORDER BY community_id");
										$i = 0;
										$community_id = array();
										$community_name = array();
										$community_code = array();

										while($row = pg_fetch_assoc($result))
										{

											$community_id[$i] = $row['community_id'];
											$community_name[$i] = $row['legal_name'];
											$community_code[$i] = $row['community_code'];

											if($i == 0)
												echo "<li class='nav-item'><a class='nav-link active' href='#tab-$i' data-toggle='tab'>$community_code[$i]</a></li>";
											else
												echo "<li class='nav-item'><a class='nav-link' href='#tab-$i' data-toggle='tab'>$community_code[$i]</a></li>";

											$i++;

										}

										$total_communities = $i;

									?>

								</ul>

								<div class='tab-content'>

									<?php

										for($i = 0; $i < $total_communities; $i++) 
										{

											echo "

											<div class='tab-pane";

											if($i == 0)
												echo " in active";

											echo "' id='tab-$i'>
										
												<div class='special-heading m-b-40'>
											
													<h4>$community_name[$i]</h4>
										
												</div>
										
												<div class='container'>

													<br><br><br>

													<form method='POST' action=''>

														<select name='hoa_id' id='hoa_id' required>

															<option value='' selected disabled>Select HOA ID</option>

															";

															$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id[$i] ORDER BY hoa_id");

															while($row = pg_fetch_assoc($result))
															{

																$hoa_id = $row['hoa_id'];

																echo "<option value='$hoa_id'>$hoa_id</option>";
																
															}

														echo "

														</select>

														<input type='hidden' name='community_id' id='community_id' value='$community_id[$i]'>
														<input type='hidden' name='community_code' id='community_code' value='$community_code[$i]'>
														<input type='hidden' name='community_name' id='community_name' value='$community_name[$i]'>

													</form>

													<br><br><br>

												</div>

											</div>

											";

										}

									?>

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
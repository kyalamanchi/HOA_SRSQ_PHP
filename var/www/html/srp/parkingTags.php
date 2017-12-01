<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	
	session_start();

	if(!$_SESSION['hoa_username'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = $_SESSION['hoa_community_id'];
	$mode = $_SESSION['hoa_mode'];

	if($mode == 2)
		$hoa_id = $_SESSION['hoa_hoa_id'];

?>
<!DOCTYPE html>

<html lang='en'>

	<head>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; if($mode == 1) echo " | Board Dashboard"; else if($mode == 2) echo " | Resident Dashboard"; ?></title>

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
		<!-- Datatable -->
		<link rel='stylesheet' href='https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css'>

	</head>

	<body>

		<div class='layout'>

			<!-- Header-->
			<?php if($mode == 1) include "boardHeader.php"; else if($mode == 2) include "residentHeader.php"; ?>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Parking Tags</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped' style="color: black;">
										
								<thead>
											
									<?php 

										if($mode == 1)
											echo "<th>Name</th>";

									?>

			                        <th>Make</th>
			                        <th>Model</th>
			                        <th>Color</th>
			                        <th>Year</th>
			                        <th>Plate</th>
			                        <th>Status</th>

			                        <?php

			                        	if($mode == 2)
			                        		echo "<th></th>";

			                        ?>

								</thead>

								<tbody>
											
									<?php 

										function decrypt_string($input)
	                      				{
	                          
	                        				$input_count = strlen($input);
	                                                                                             
	                        				$dec = explode(".", $input);// splits up the string to any array
	                        				$x = count($dec);
	                        				$y = $x-1;// To get the key of the last bit in the array 
	                                                                                             
	                        				$calc = $dec[$y]-50;
	                        				$randkey = chr($calc);// works out the randkey number
	                                                                                             
	                        				$i = 0;
	                                                                                             
	                        				while ($i < $y)
	                        				{
	                                                                                             
	                          					$array[$i] = $dec[$i]+$randkey; // Works out the ascii characters actual numbers
	                          					@$real .= chr($array[$i]); //The actual decryption
	                                                                                             
	                          					$i++;

	                        				};
	                                                                                             
	                        				@$input = $real;
	                        				return $input;

	                      				}

	                      				if($mode == 1)
	                      				{

		                      				$result = pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$tag_id = $row['id'];
			                          			$detail = $row['detail'];
			                          			$status = $row['status'];
			                          			$hoa_id = $row['hoa_id'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_detail WHERE car_detail_id=$detail"));

			                          			$car_make = $row1['car_make_id'];
			                          			$car_model = $row1['car_model_id'];
			                          			$car_color = $row1['car_color_id'];
			                          			$year = $row1['year'];
			                          			$plate = $row1['notes'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_make WHERE car_make_id=$car_make"));
			                          			$car_make = $row1['name'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_model WHERE car_model_id=$car_model"));
			                          			$car_model = $row1['name'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_color WHERE car_color_id=$car_color"));
			                          			$car_color = $row1['name'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
			                          			$name = $row1['firstname'];
			                          			$name .= " ";
			                          			$name .= $row1['lastname'];

			                          			if($plate != "")
						                        {

						                          	$plate = base64_decode($plate);
						                          	$plate = decrypt_string($plate);

						                        }

						                        echo "<tr><td>$name<br>($hoa_id)</td><td>$car_make</td><td>$car_model</td><td>$car_color</td><td>$year</td><td>$plate</td><td>$status</td></tr>";

			                        		}

		                        		}
		                        		else if($mode == 2)
		                        		{

		                      				$result = pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1 AND hoa_id=$hoa_id");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$tag_id = $row['id'];
			                          			$detail = $row['detail'];
			                          			$status = $row['status'];
			                          			$hoa_id = $row['hoa_id'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_detail WHERE car_detail_id=$detail"));

			                          			$car_make = $row1['car_make_id'];
			                          			$car_model = $row1['car_model_id'];
			                          			$car_color = $row1['car_color_id'];
			                          			$year = $row1['year'];
			                          			$plate = $row1['notes'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_make WHERE car_make_id=$car_make"));
			                          			$car_make = $row1['name'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_model WHERE car_model_id=$car_model"));
			                          			$car_model = $row1['name'];

			                          			$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_color WHERE car_color_id=$car_color"));
			                          			$car_color = $row1['name'];

			                          			if($plate != "")
						                        {

						                          	$plate = base64_decode($plate);
						                          	$plate = decrypt_string($plate);

						                        }

						                        echo "<tr><td>$car_make</td><td>$car_model</td><td>$car_color</td><td>$year</td><td>$plate</td><td>$status</td><td><a href='' class='btn btn-link' title='Edit Tag'>Edit Tag</a><br><a href='' class='btn btn-link' title='Remove Tag'>Remove Tag</a></td></tr>";

			                        		}

		                        		}

		                      		?>

								</tbody>
										
							</table>

						</div>

					</div>

				</section>

				<!-- Footer-->
				<?php include 'footer.php'; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</div>

		</div>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>
		<!-- Datatable -->
		<script src='//code.jquery.com/jquery-1.12.4.js'></script>
		<script src='https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>

		<script>
      	
	      	$(function () {
	        	
	        	$("#example1").DataTable({ "pageLength": 50 });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
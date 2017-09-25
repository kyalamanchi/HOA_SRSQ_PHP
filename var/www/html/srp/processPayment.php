<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			session_start();

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = $_SESSION['hoa_community_id'];
			$mode = $_SESSION['hoa_mode'];

			$today = date('Y-m-d');

		?>

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

		<div class="wrapper">

			<!-- Header-->
			<?php if($mode == 1) include "boardHeader.php"; else if($mode == 2) include "residentHeader.php"; ?>

			<!-- Page Header -->
			<section class="module-page-title">
				
				<div class="container">
						
					<div class="row-page-title">
						
						<div class="page-title-captions">
							
							<h1 class="h5">Process Payments</h1>
						
						</div>
					
					</div>
					
				</div>
			
			</section>

			<!-- Content -->
			<section class="module">
					
				<div class="container">
						
					<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					
						<table id='example1' class='table table-striped'>

							<thead>
								
								<th>Name (HOA ID)</th>
								<th>Address (Home ID)</th>
								<th>January</th>
								<th>February</th>
								<th>March</th>
								<th>April</th>
								<th>May</th>
								<th>June</th>
								<th>July</th>
								<th>August</th>
								<th>September</th>
								<th>October</th>
								<th>November</th>
								<th>December</th>

							</thead>

							<tbody>
								
								<?php

									$result = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

									while($row = pg_fetch_assoc($result))
									{

										$year = date('Y');
										$home_id = $row['home_id'];
										$address = $row['address1'];
										$living_status = $row['living_status'];

										$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id AND valid_until>='$today'"));

										$name = $row1['firstname'];
										$name .= " ";
										$name .= $row1['lastname'];
										$hoa_id = $row1['hoa_id'];

										$row1 = pg_fetch_assoc(pg_query("SELECT * FROM current_year_payments_processed WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id AND year=$year"));

										$m[1] = $row['m1_pmt_processed'];
                          				$m[2] = $row['m2_pmt_processed'];
                          				$m[3] = $row['m3_pmt_processed'];
                          				$m[4] = $row['m4_pmt_processed'];
                          				$m[5] = $row['m5_pmt_processed'];
                          				$m[6] = $row['m6_pmt_processed'];
                          				$m[7] = $row['m7_pmt_processed'];
                          				$m[8] = $row['m8_pmt_processed'];
                          				$m[9] = $row['m9_pmt_processed'];
                         				$m[10] = $row['m10_pmt_processed'];
                          				$m[11] = $row['m11_pmt_processed'];
                          				$m[12] = $row['m12_pmt_processed'];

                          				for ($i = 1; $i <= 12; $i++)
                          				{
                            
                            				if($m[$i] == 't')
                              					$m[$i] = "<center><i class='fa fa-check-square text-success'></i></center>";
                            				else
                              					$m[$i] = "<center><i class='fa fa-square-o text-orange'></i></center>";

                          				}

                          				echo "<tr><td>$name ($hoa_id)</td><td>$address ($home_id)</td><td>$m[1]</td><td>$m[2]</td><td>$m[3]</td><td>$m[4]</td><td>$m[5]</td><td>$m[6]</td><td>$m[7]</td><td>$m[8]</td><td>$m[9]</td><td>$m[10]</td><td>$m[11]</td><td>$m[12]</td></tr>";

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

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='http://maps.googleapis.com/maps/api/js?key=AIzaSyA0rANX07hh6ASNKdBr4mZH0KZSqbHYc3Q'></script>
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
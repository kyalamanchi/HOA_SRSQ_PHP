<?php
		ini_set("session.save_path","/var/www/html/session/");
			session_start();
?>
<!DOCTYPE html>

<html lang='en'>

	<head>

		<?php

			if(!$_SESSION['hoa_username'])
				header("Location: logout.php");

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			$community_id = $_SESSION['hoa_community_id'];
			$mode = $_SESSION['hoa_mode'];

			if($mode == 2)
			{	

				$hoa_id = $_SESSION['hoa_hoa_id'];
				$home_id = $_SESSION['hoa_home_id'];

			}

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

		<div class='layout'>

			<!-- Header-->
			<?php if($mode == 1) include "boardHeader.php"; else if($mode == 2) include "residentHeader.php"; ?>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Inspection Notices</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped' style="color: black;">
										
								<thead>
											
									<th>Inspection Date</th>
									<th>Status</th>

									<?php 

										if($mode == 1)
											echo "<th>Name (HOA ID)</th><th>Living In (Home ID)</th>";

									?>

			                        <th>Location</th>
			                        <th>Description</th>
			                        <th>Category</th>
			                        <th>Item</th>

								</thead>

								<tbody>
											
									<?php 

										if($mode == 1)
	                      				{

		                      				$result = pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$status = $row['inspection_status_id'];

			                          			if($status != 2 && $status != 6 && $status != 9 && $status != 13 && $status != 14)
			                          			{

			                          				$home_id = $row['home_id'];
			                          				$hoa_id = $row['hoa_id'];
			                          				$description = $row['description'];
			                          				$location = $row['location_id'];
			                          				$inspection_date = $row['inspection_date'];
			                          				$inspection_category = $row['inspection_category_id'];
			                          				$item = $row['item'];

			                          				if($inspection_date != '')
			                          					$inspection_date = date('m-d-Y', strtotime($inspection_date));

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
			                          				$name = $row1['firstname'];
			                          				$name .= " ";
			                          				$name .= $row1['lastname'];

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
			                          				$living_in = $row1['address1'];

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM locations_in_community WHERE location_id=$location"));
			                          				$location = $row1['location'];

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM inspection_status WHERE id=$status"));
			                          				$status = $row1['inspection_status'];

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM inspection_category WHERE id=$inspection_category"));
			                          				$inspection_category = $row1['name'];

			                          				echo "<tr><td>$inspection_date</td><td>$status</td><td>$name ($hoa_id)</td><td>$living_in ($home_id)</td><td>$location</td><td>$description</td><td>$inspection_category</td><td>$item</td></tr>";

			                          			}

			                        		}

		                        		}
		                        		else if($mode == 2)
		                        		{

		                      				$result = pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id");

			                        		while($row = pg_fetch_assoc($result))
			                        		{

			                          			$status = $row['inspection_status_id'];

			                          			if($status != 2 && $status != 6 && $status != 9 && $status != 13 && $status != 14)
			                          			{

			                          				$description = $row['description'];
			                          				$location = $row['location_id'];
			                          				$inspection_date = $row['inspection_date'];
			                          				$inspection_category = $row['inspection_category_id'];
			                          				$item = $row['item'];

			                          				if($inspection_date != '')
			                          					$inspection_date = date('m-d-Y', strtotime($inspection_date));

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM locations_in_community WHERE location_id=$location"));
			                          				$location = $row1['location'];

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM inspection_status WHERE id=$status"));
			                          				$status = $row1['inspection_status'];

			                          				$row1 = pg_fetch_assoc(pg_query("SELECT * FROM inspection_category WHERE id=$inspection_category"));
			                          				$inspection_category = $row1['name'];

			                          				echo "<tr><td>$inspection_date</td><td>$status</td><td>$location</td><td>$description</td><td>$inspection_category</td><td>$item</td></tr>";

			                          			}

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
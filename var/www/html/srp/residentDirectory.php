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
								
								<h1 class="h5">Resident Directory</h1>
							
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
											
									<th>Name</th>
									<th>Living In</th>
									<th>Mailing Address</th>
			                        <th>Email</th>
			                        <th>Phone</th>

								</thead>

								<tbody>
											
									<?php 

										$result = pg_query("SELECT * FROM member_info WHERE community_id=$community_id");

										while($row = pg_fetch_assoc($result))
										{

											$hoa_id = $row['hoa_id'];
											$account_id = $row['account_id'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
											$name = $row1['firstname'];
											$name .= " ";
											$name .= $row1['lastname'];
											$email = $row1['email'];
											$cell_no = $row1['cell_no'];
											$home_id = $row1['home_id'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
											$living_in = $row1['address1'];
											$living_status = $row1['living_status'];

											if($living_status == 'f')
											{

												$row1 = pg_fetch_assoc(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

												$mailing_address = $row1['address1'];
												$mailing_city = $row1['city_id'];
												$mailing_state = $row1['state_id'];
												$mailing_zip = $row1['zip_id'];

											}
											else
											{

												$mailing_address = $row1['address1'];
												$mailing_city = $row1['city_id'];
												$mailing_state = $row1['state_id'];
												$mailing_zip = $row1['zip_id'];

											}

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM city WHERE city_id=$mailing_city"));
											$mailing_city = $row1['city_name'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM state WHERE state_id=$mailing_state"));
											$mailing_state = $row1['state_code'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM zip WHERE zip_id=$mailing_zip"));
											$mailing_zip = $row1['zip_code'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM account_info WHERE account_id=$account_id"));
											$cell_visibility = $row1['cell_visibility'];
											$email_visibility = $row1['email_visibility'];
											$mailing_address_visibility = $row1['mailing_address_visibility'];

											if($cell_visibility == 'NO')
												$cell_no = "NOT PERMITTED";

											if($email_visibility == 'NO')
												$email = "NOT PERMITTED";

											if($mailing_address_visibility == 'NO')
												$mailing_address = "NOT PERMITTED";
											else
											{

												$mailing_address .= ", ";
												$mailing_address .= $mailing_city;
												$mailing_address .= ", ";
												$mailing_address .= $mailing_state;
												$mailing_address .= " ";
												$mailing_address .= $mailing_zip;

											}

											echo "<tr><td>$name";

											if($mode == 1)
												echo " ($hoa_id)";

											echo "</td><td>$living_in";

											if($mode == 1)
												echo " ($home_id)";

											echo "</td><td>$mailing_address</td><td>$email</td><td>$cell_no</td></tr>";

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
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

			$today = date('Y-m-d');
			$year = date('Y');
			$month = date('m');
			$last = date('t');

			if($mode == 2)
				header('Location: residentDashboard.php');

		?>

		<meta charset='UTF-8'>
		<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<meta name='description' content='Stoneridge Place At Pleasanton HOA'>
		<meta name='author' content='Geeth'>

		<title><?php echo $_SESSION['hoa_community_code']; ?> | Board Dashboard</title>

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
			<?php include "boardHeader.php"; ?>

			<div class="wrapper">

				<!-- Page Header -->
				<section class="module-page-title">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5">Home Pay Method - ACH</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped'  style='color: black;'>

								<thead>
									
									<th>Name<br>(HOA ID)</th>
									<th>Living In<br>(Home ID)</th>
									<th>Recurring Pay</th>
									<th>Start Date</th>
									<th>End Date</th>
									<th>Continous</th>
									<th>Expires On</th>
									<th>Next Schedule Date</th>
									<th>Frequence</th>
									<th>Balance</th>

								</thead>

								<tbody>
									
									<?php

										$result = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1");

										while($row = pg_fetch_assoc($result))
										{

											$home_id = $row['home_id'];
											$hoa_id = $row['hoa_id'];
											$recurring_pay = $row['recurring_pay'];
											$sch_start = $row['sch_start'];
											$sch_end = $row['sch_end'];
											$continous = $row['continous'];
											$expires_on = $row['sch_expires'];
											$next_schedule = $row['next_sch'];
											$frequency = $row['sch_frequency'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
											$name = $row1['firstname'];
											$name .= " ";
											$name .= $row1['lastname'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
											$living_in = $row1['address1'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id"));
											$charges = $row1['sum'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1"));

											$payments = $row1['sum'];

											if($payments == "")
												$payments = 0.0;

											$balance = $charges - $payments;
											$balance = "$ ".$balance;

											if($recurring_pay == 't')
												$recurring_pay = "Enabled";
											else
												$recurring_pay = "Not Set";

											if($continous == 't')
												$continous = "True";
											else
												$continous = "False";

											if($sch_start != "")
												$sch_start = date('m-d-Y', strtotime($sch_start));

											if($sch_end != "")
												$sch_end = date('m-d-Y', strtotime($sch_end));

											if($expires_on != "")
												$expires_on = date('m-d-Y', strtotime($expires_on));

											if($next_schedule != "")
												$next_schedule = date('m-d-Y', strtotime($next_schedule));

	                          				echo "<tr><td>$name<br>($hoa_id)</td><td>$living_in<br>($home_id)</td><td>$recurring_pay</td><td>$sch_start</td><td>$sch_end</td><td>$continous</td><td>$expires_on</td><td>$next_schedule</td><td>$frequency</td><td>$balance</td></tr>";

										}

									?>

								</tbody>
								
							</table>

						</div>

					</div>

				</section>

				<section class="module-page-title p-t-0">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5"><br>Home Pay Method - Bill Pay</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example2' class='table table-striped'  style='color: black;'>

								<thead>
									
									<th>Name</th>
									<th>HOA ID</th>
									<th>Living In</th>
									<th>Home ID</th>
									<th>Balance</th>

								</thead>

								<tbody>
									
									<?php

										$result = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2");

										while($row = pg_fetch_assoc($result))
										{

											$home_id = $row['home_id'];
											$hoa_id = $row['hoa_id'];
											
											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
											$name = $row1['firstname'];
											$name .= " ";
											$name .= $row1['lastname'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
											$living_in = $row1['address1'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id"));
											$charges = $row1['sum'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1"));

											$payments = $row1['sum'];

											if($payments == "")
												$payments = 0.0;

											$balance = $charges - $payments;
											$balance = "$ ".$balance;

	                          				echo "<tr><td>$name</td><td>$hoa_id</td><td>$living_in</td><td>$home_id</td><td>$balance</td></tr>";

										}

									?>

								</tbody>
								
							</table>

						</div>

					</div>

				</section>

				<section class="module-page-title p-t-0">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5"><br>Home Pay Method - Check</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example3' class='table table-striped'  style='color: black;'>

								<thead>
									
									<th>Name</th>
									<th>HOA ID</th>
									<th>Living In</th>
									<th>Home ID</th>
									<th>Balance</th>

								</thead>

								<tbody>
									
									<?php

										$result = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3");

										while($row = pg_fetch_assoc($result))
										{

											$home_id = $row['home_id'];
											$hoa_id = $row['hoa_id'];
											
											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
											$name = $row1['firstname'];
											$name .= " ";
											$name .= $row1['lastname'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
											$living_in = $row1['address1'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id"));
											$charges = $row1['sum'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1"));

											$payments = $row1['sum'];

											if($payments == "")
												$payments = 0.0;

											$balance = $charges - $payments;
											$balance = "$ ".$balance;

	                          				echo "<tr><td>$name</td><td>$hoa_id</td><td>$living_in</td><td>$home_id</td><td>$balance</td></tr>";

										}

									?>

								</tbody>
								
							</table>

						</div>

					</div>

				</section>

				<section class="module-page-title p-t-0">
					
					<div class="container">
							
						<div class="row-page-title">
							
							<div class="page-title-captions">
								
								<h1 class="h5"><br>Home Pay Method - Others</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example4' class='table table-striped'  style='color: black;'>

								<thead>
									
									<th>Name</th>
									<th>HOA ID</th>
									<th>Living In</th>
									<th>Home ID</th>
									<th>Pay Method</th>
									<th>Balance</th>

								</thead>

								<tbody>
									
									<?php

										$result = pg_query("SELECT * FROM home_pay_method WHERE community_id=$community_id");

										while($row = pg_fetch_assoc($result))
										{

											$payment_type = $row['payment_type_id'];

											if($payment_type == "" OR $payment_type > 3)
											{

												$home_id = $row['home_id'];
												$hoa_id = $row['hoa_id'];
												
												$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
												$name = $row1['firstname'];
												$name .= " ";
												$name .= $row1['lastname'];

												$row1 = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
												$living_in = $row1['address1'];

												$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id"));
												$charges = $row1['sum'];

												if($payment_type != "")
												{

													$row1 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$payment_type"));
													$payment_type = $row1['payment_type_name'];
													
												}

												$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND payment_status_id=1"));

												$payments = $row1['sum'];

												if($payments == "")
													$payments = 0.0;

												$balance = $charges - $payments;
												$balance = "$ ".$balance;

		                          				echo "<tr><td>$name</td><td>$hoa_id</td><td>$living_in</td><td>$home_id</td><td>$payment_type</td><td>$balance</td></tr>";

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[ 0, "asc"]] });

	        	$("#example2").DataTable({ "pageLength": 50, "order": [[ 0, "asc"]] });

	        	$("#example3").DataTable({ "pageLength": 50, "order": [[ 0, "asc"]] });

	        	$("#example4").DataTable({ "pageLength": 50, "order": [[ 0, "asc"]] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
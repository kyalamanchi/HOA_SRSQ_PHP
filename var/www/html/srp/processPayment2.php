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
			$name = $_GET['name'];
			$home_id = $_GET['home_id'];
			$hoa_id = $_GET['hoa_id'];

			$today = date('Y-m-d');
			$year = date('Y');

			if($name == '')
				header('Location: processPayment.php');

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
							
							<h1 class="h5">Process Payments - <?php echo $name; ?></h1>
						
						</div>
					
					</div>
					
				</div>
			
			</section>

			<!-- Content -->
			<section class="module">
					
				<div class="container-fluid">

					<div class='text-center col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

						<h3 class='h3'>Charges</h3>

					</div>
						
					<div class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>
					
						<table class='table table-striped'  style='color: black;'>

							<thead>
								
								<th>Month</th>
								<th>Year</th>
								<th>Charge Date</th>
								<th>Assessment Type</th>
								<th>Amount</th>

							</thead>

							<tbody>
								
								<?php

									$total_charges = 0.0;

									$result = pg_query("SELECT * FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id ORDER BY assessment_date asc");

									while($row = pg_fetch_assoc($result))
									{

										$year = date('Y');
										$assessment_rule_type = $row['assessment_rule_type_id'];
										$assessment_month = $row['assessment_month'];
										$assessment_year = $row['assessment_year'];
										$amount = $row['amount'];
										$assessment_date = $row['assessment_date'];
										$total_charges += $amount;

										if($assessment_date != '')
											$assessment_month = date('F', strtotime($assessment_date));

										if($assessment_date != '')
											$assessment_date = date('m-d-Y', strtotime($assessment_date));

										if($amount != '')
											$amount = "$ ".$amount;

										$row1 = pg_fetch_assoc(pg_query("SELECT * FROM assessment_rule_type WHERE assessment_rule_type_id=$assessment_rule_type"));
										$assessment_rule_type = $row1['name'];

                          				echo "<tr><td>$assessment_month</td><td>$assessment_year</td><td>$assessment_date</td><td>$assessment_rule_type</td><td>$amount</td></tr>";

									}

									echo "<tr><td></td><td></td><td></td><td><strong>Total Charges</strong></td><td>$ $total_charges</td></tr>";

								?>

							</tbody>
							
						</table>

					</div>

					<div class='text-center col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

						<h3 class='h3'>Payments</h3>

					</div>
						
					<div class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>
					
						<table class='table table-striped'  style='color: black;'>

							<thead>
								
								<th>Month</th>
								<th>Year</th>
								<th>Payment Date</th>
								<th>Payment Type</th>
								<th>Amount</th>

							</thead>

							<tbody>
								
								<?php

									$total_payments = 0.0;

									$result = pg_query("SELECT * FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id ORDER BY process_date asc");

									while($row = pg_fetch_assoc($result))
									{

										$year = date('Y');
										$payment_type = $row['payment_type_id'];
										$assessment_month = $row['assessment_month'];
										$assessment_year = $row['assessment_year'];
										$amount = $row['amount'];
										$document_num = $row['document_num'];
										$process_date = $row['process_date'];
										$total_payments += $amount;

										if($process_date != '')
											$payment_month = date('F', strtotime($process_date));

										if($process_date != '')
											$payment_year = date('Y', strtotime($process_date));

										if($process_date != '')
											$process_date = date('m-d-Y', strtotime($process_date));

										if($amount != '')
											$amount = "$ ".$amount;

										$row1 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$payment_type"));
										$payment_type = $row1['payment_type_name'];

                          				echo "<tr><td>$payment_month</td><td>$payment_year</td><td>$process_date</td><td>$payment_type # $document_num</td><td>$amount</td></tr>";

									}

									echo "<tr><td></td><td></td><td></td><td><strong>Total Payments</strong></td><td>$ $total_payments</td></tr>";

								?>

							</tbody>
							
						</table>

					</div>

					<div class='text-center col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>

						<h3 class='h3'>Payments</h3>

					</div>
						
					<div class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>
					
						<table class='table table-striped'  style='color: black;'>

							<thead>
								
								<th>Month</th>
								<th>Document ID</th>
								<th>Description</th>
								<th>Charge</th>
								<th>Payment</th>

							</thead>

							<tbody>
								
								<?php

									$total_charges = 0.0;
									$total_payments = 0.0;

                        			for($m = 1; $m <= 12; $m++)
                        			{

                          				$last_date = date("Y-m-t", strtotime("$year-$m-1"));
                          
                          				$charges_results = pg_query("SELECT * FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id AND assessment_date>='$year-$m-1' AND assessment_date<='$last_date' ORDER BY assessment_date");

                          				$payments_results = pg_query("SELECT * FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND process_date>='$year-$m-1' AND process_date<='$last_date' ORDER BY process_date");

                          				while($charges_row = pg_fetch_assoc($charges_results))
                          				{

                            				$amount = $charges_row['amount'];
                            				$total_charges += $amount;
                            				$tdate = $charges_row['assessment_date'];
                            				$desc = $charges_row['assessment_rule_type_id'];

                            				$r = pg_fetch_assoc(pg_query("SELECT * FROM assessment_rule_type WHERE assessment_rule_type_id=$desc"));
                            				$desc = $r['name'];

                            				echo "<tr><td>".date('F', strtotime($tdate))."</td><td>".$charges_row['id']."-".$charges_row['assessment_rule_type_id']."</td><td>".date("m-d-y", strtotime($tdate))."|".$desc."</td><td>$ ".$amount."</td><td></td></tr>";

                          				}

                          				while($payments_row = pg_fetch_assoc($payments_results))
                          				{

                            				$amount = $payments_row['amount'];
                            				$total_payments += $amount;
                            				$tdate = $payments_row['process_date'];

                            				echo "<tr><td>".date('F', strtotime($tdate))."</td><td>".$payments_row['id']."-".$payments_row['payment_type_id']."</td><td>".date("m-d-y", strtotime($tdate))."|"."Payment Received # ".$payments_row['document_num']."</td><td></td><td>$ ".$amount."</td></tr>";

                          				}

                        			}

                        			echo "<tr><td></td><td></td><td><strong>Total</strong></td><td>$ $total_charges</td><td>$ total_payments</td></tr>";
                        			echo "<tr><td></td><td></td><td><strong>Balance</strong></td><td colspan=2>$ $total_charges - $total_payments</td></tr>";

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[2, 'asc']] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
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

			$today = date('Y-m-d');
			$year = date('Y');

			if($name == '')
				header('Location: processPayment.php');

			$home_id = $_GET['home_id'];
			$hoa_id = $_GET['hoa_id'];

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

                        			$balance = $total_charges - $total_payments;

                        			echo "<tr><td></td><td></td><td><strong><center>Total</center></strong></td><td>$ $total_charges</td><td>$ $total_payments</td></tr>";
                        			echo "<tr><td></td><td></td><td><strong><center>Current Balance</center></strong></td><td colspan=2><strong><center>$ $balance</center></strong></td></tr>";

                      			?>

							</tbody>
							
						</table>

					</div>

				</div>

			</section>

			<section class="module module-gray">
					
				<div class="container-fluid">

					<div class='table-responsive col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12 offset-xl-2 offset-lg-2 offset-md-1'>
					
						<center><h3>Current Year Payments Processed</h3></center>

					</div>

					<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
					
						<table class='table text-center'  style='color: black; background: white;'>

							<thead>
								
								<th><center>Jan</center></th>
								<th><center>Feb</center></th>
								<th><center>Mar</center></th>
								<th><center>Apr</center></th>
								<th><center>May</center></th>
								<th><center>Jun</center></th>
								<th><center>Jul</center></th>
								<th><center>Aug</center></th>
								<th><center>Sep</center></th>
								<th><center>Oct</center></th>
								<th><center>Nov</center></th>
								<th><center>Dec</center></th>

							</thead>

							<tbody>
								
								<?php

									$row = pg_fetch_assoc(pg_query("SELECT * FROM current_year_payments_processed WHERE community_id=$community_id AND hoa_id=$hoa_id AND home_id=$home_id AND year=$year"));

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

                          			echo "<tr><td>$row['m1_pmt_processed']</td><td><input type='checkbox' name='month[]' id='month' value='February' ";

                          			if($m[2] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='March' ";

                          			if($m[3] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='April' ";

                          			if($m[4] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='May' ";

                          			if($m[5] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='June' ";

                          			if($m[6] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='July' ";

                          			if($m[7] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='August' ";

                          			if($m[8] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='September' ";

                          			if($m[9] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='October' ";

                          			if($m[10] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='November' ";

                          			if($m[11] == 't')
                          				echo "checked ";

                          			echo "></td><td><input type='checkbox' name='month[]' id='month' value='December' ";

                          			if($m[12] == 't')
                          				echo "checked ";

                          			echo "></td></tr>";


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
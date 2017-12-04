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
								
								<h1 class="h5">Accounts Payable</h1>
							
							</div>

							<div class="page-title-secondary">
								
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item"><i class='fa fa-wrench'></i> Vendors</li>
									<li class="breadcrumb-item active">Accounts Payable</li>

								</ol>

							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container-fluid">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table' style="color: black;">
										
								<thead>
									
									<th>Pay Date</th>
									<th>Vendor Name (Vendor ID)</th>
									<th>Payment Type</th>
									<th>Amount</th>
									<th>Payment Cleared</th>
									<th>Date Payment Cleared</th>
									<th>Bank Account</th>
									<th>Closing Month</th>
									<th>Closing Year</th>

								</thead>

								<tbody>
									
									<?php

										$result = pg_query("SELECT * FROM accounts_payable WHERE community_id=$community_id");

										while ($row = pg_fetch_assoc($result)) 
										{

											$pay_date = $row['pay_date'];
											$vendor_id = $row['vendor_id'];
											$payment_type = $row['payment_type_id'];
											$amount = $row['amount'];
											$payment_cleared = $row['payment_cleared'];
											$date_payment_cleared = $row['date_payment_cleared'];
											$bank_account = $row['bank_account_id'];
											$closing_month = $row['closing_month'];
											$closing_year = $row['closing_year'];

											if($pay_date != '')
												$pay_date = date('m-d-Y', strtotime($pay_date));

											if($date_payment_cleared != '')
												$date_payment_cleared = date('m-d-Y', strtotime($date_payment_cleared));

											if($closing_month != '')
												$closing_month = date('F', strtotime($closing_month));

											if($payment_cleared == 't')
												$payment_cleared = 'YES';
											else
												$payment_cleared = 'NO';

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM vendor_master WHERE vendor_id=$vendor_id"));
											$vendor_name = $row1['vendor_name'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM payment_type WHERE payment_type_id=$payment_type"));
											$payment_type = $row1['payment_type_name'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM bank_account WHERE id=$bank_account"));
											$bank_account = $row1['bank_name'];

											echo "<tr><td>$pay_date</td><td>$vendor_name ($vendor_id)</td><td>$payment_type</td><td>$ $amount</td><td>$payment_cleared</td><td>$date_payment_cleared</td><td>$bank_account</td><td>$closing_month</td><td>$closing_year</td></tr>";

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[0, 'desc']] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
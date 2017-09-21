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
								
							<div class='special-heading m-b-40'>
									
								<h4>Community Deposits</h4>

							</div>

						</div>

					</div>

				</div>

			</section>

			<!-- Content -->
			<section class="module">
					
				<div class="container">
						
					<div class="row">
							
						<table id='example1' class='display table-bordered table-striped' width='100%'>
								
							<thead>
									
									<th>Fund Received On</th>
									<th>ID</th>
									<th>Net Amount</th>
									<th>Number of Transactions</th>
									<th>Status</th>
									<th>Fund Sent On</th>

							</thead>

							<tbody>
									
								<?php

									$result = pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id");

									while ($row = pg_fetch_assoc($result)) 
									{
											
										$deposit_id = $row['id'];
										$funded_on = $row['effective_date'];
										$fund_sent = $row['origination_date'];
										$amount = $row['net_amount'];
										$number_of_transactions = $row['number_of_transactions'];
										$status = $row['status'];

										if($funded_on != "")
											$funded_on = date('m-d-Y', strtotime($funded_on));

										if($fund_sent != "")
											$fund_sent = date('m-d-Y', strtotime($fund_sent));

										if($amount != "")
											$amount = "$ ".$amount;

										echo "<tr><td>$funded_on</td><td>$deposit_id</td><td>$amount</td><td>$number_of_transactions</td><td>$status</td><td>$fund_sent</td></tr>";
									}

								?>

							</tbody>
								
						</table>

					</div>

				</div>

				<!-- Footer-->
				<?php include 'footer.php'; ?>

				<a class='scroll-top' href='#top'><i class='fa fa-angle-up'></i></a>

			</section>

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[0, 'desc']] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
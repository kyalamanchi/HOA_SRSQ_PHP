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

			if($mode == 2)
				header('Location: residentDashboard.php');

			$hoa_id = $_GET['hoa_id'];
			$home_id = $_GET['home_id'];
			$name = $_GET['name'];

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

			<div class='wrapper'>

				<!-- Page Header -->
				<section class='module-page-title'>
					
					<div class='container'>
							
						<div class='row-page-title'>
							
							<div class='page-title-captions'>
								
								<h1 class='h5'>Customer Balance</h1>
							
							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class='module'>
						
					<div class='container-fluid'>

						<div class='row'>

							<div class='offset-xl-2 offset-lg-2 offset-md-1 col-xl-8 col-lg-8 col-md-10 col-sm-12 col-xs-12'>

								<div class='alert alert-info'>

									<center>

										<form method='POST' action='customerBalance.php'>

											<?php

												if(!isset($_POST['mode']))
													echo "

													Show customers having balance 
													<input type='radio' name='mode' id='mode' value='1' checked> Greater than 
													<input type='radio' name='mode' id='mode' value='2'> Lesser than 
													<input type='radio' name='mode' id='mode' value='3'> Equal to $ <input type='number' step='0.01' name='value1' id='value1' value='0.00'>

													";
												else
												{

													$mode = $_POST['mode'];
													$value = $_POST['value1'];

													if($mode == 1)
														echo "

														Show customers having balance 
														<input type='radio' name='mode' id='mode' value='1' checked> Greater than 
														<input type='radio' name='mode' id='mode' value='2'> Lesser than 
														<input type='radio' name='mode' id='mode' value='3'> Equal to $ <input type='number' step='0.01' name='value1' id='value1' value='$value'>

														";

													if($mode == 2)
														echo "

														Show customers having balance 
														<input type='radio' name='mode' id='mode' value='1'> Greater than 
														<input type='radio' name='mode' id='mode' value='2' checked> Lesser than 
														<input type='radio' name='mode' id='mode' value='3'> Equal to $ <input type='number' step='0.01' name='value1' id='value1' value='$value'>

														";

													if($mode == 3)
														echo "

														Show customers having balance 
														<input type='radio' name='mode' id='mode' value='1'> Greater than 
														<input type='radio' name='mode' id='mode' value='2'> Lesser than 
														<input type='radio' name='mode' id='mode' value='3' checked> Equal to $ <input type='number' step='0.01' name='value1' id='value1' value='$value'>

														";

												}

											?>
											
											<br>
											
											<button type='submit' class='btn btn-xs btn-success'>Show</button>

										</form>

									</center>

								</div>

							</div>

						</div>

						<br><br>
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<table id='example1' class='table table-striped' style='color: black;'>

								<thead>
									
									<th>Name</th>
									<th>Living In</th>
									<th>Contact Details</th>
									<th>Total Charges - Total Payments = Total Balance</th>
									<th></th>

								</thead>

								<tbody>
									
									<?php

										$result = pg_query("SELECT * FROM homeid WHERE community_id=$community_id");

										while ($row = pg_fetch_assoc($result)) 
										{

											$home_id = $row['home_id'];
											$living_in = $row['address1'];

											$row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id AND valid_until>='$today'"));
											$name = $row1['firstname'];
											$name .= " ";
											$name .= $row1['lastname'];
											$hoa_id = $row1['hoa_id'];
											$email = $row1['email'];
											$cell_no = $row1['cell_no'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id AND payment_status_id=1"));
											$total_payments = $row1['sum'];

											$row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));
											$total_charges = $row1['sum'];

											$total_balance = $total_charges - $total_payments;
											$total_balance = round($total_balance, 2);

											echo "<tr><td>$name<br>($hoa_id)</td><td>$living_in<br>($home_id)</td><td><i class='fa fa-envelope'></i> $email<br><i class='fa fa-phone'></i> $cell_no</td><td>$ $total_charges - $ $total_payments = <strong>$ $total_balance</strong></td><td><i class='fa fa-print'></i> Invoice</td></tr>";
											
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
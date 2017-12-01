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
			$living_in = $_GET['living_in'];
			$email = $_GET['email'];

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
								
								<h1 class="h5">Set Reminders</h1>
							
							</div>

							<div class="page-title-secondary">
								
								<ol class="breadcrumb">
									
									<li class="breadcrumb-item"><i class='fa fa-users'></i> Board</li>
									<li class="breadcrumb-item active">Set Reminder</li>

								</ol>

							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<form method="POST" action="setReminder3.php">

			                	<div class="row">

				            		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">

				            			<h5>Name : <strong><?php echo $name; ?></strong></h5>
				            			<input type="hidden" name="hoa_id" id="hoa_id" value="<?php echo $hoa_id; ?>">

				            		</div>

				            		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">

				            			<h5>Living In : <strong><?php echo $living_in; ?></strong></h5>
				            			<input type="hidden" name="home_id" id="home_id" value="<?php echo $home_id; ?>">

				            		</div>

			            		</div>

			            		<br>

			            		<div class="row container-fluid">

			            			<label><h5><strong>Reminder Type : </strong></h5></label>

			            		</div>

			            		<div class="row" style='color: black;'>

			            			<?php

			            				$result = pg_query("SELECT * FROM reminder_type");

			            				$i = 0;

			            				while($row = pg_fetch_assoc($result))
			            				{

			            					$id = $row['id'];
			            					$reminder_type = $row['reminder_type'];

			            					echo "<div class='col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-6'><input type='radio' "; if($i == 0) {echo "checked"; $i++; } echo " name='reminder_type' id='reminder_type' value='$id'> $reminder_type</div>";

			            				}

			            			?>
			            			
			            		</div>

			            		<br>

			            		<div class='row container-fluid'>
				            		
				            		<div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12'>
					            		
					            		<div class="row container-fluid">

					            			<label><h5><strong>Open Date : </strong></h5></label>

					            		</div>

					            		<div class="row container-fluid">

	                						<div class="input-group date">
	                  							
	                  							<input type="date" placeholder="yyyy-mm-dd" disabled value="<?php echo date('Y-m-d'); ?>" required>
	                  							<input type="hidden" value="<?php echo date('Y-m-d'); ?>" name='open_date' value='open_date'>
	                						
	                						</div>

	              						</div>

				            		</div>

				            		<div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12'>
					            		
					            		<div class="row container-fluid">

					            			<label><h5><strong>Due Date : </strong></h5></label>

					            		</div>

					            		<div class="row container-fluid">

	                						<div class="input-group date">

	                  							<?php

	                  							$date = date("Y-m-d");

												$i = 7;
												
	                  							?>
	                  							
	                  							<input type="date" placeholder="yyyy-mm-dd" disabled value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" required>
	                  							<input type="hidden"  value="<?php echo date('Y-m-d', strtotime("+7 days")); ?>" name='due_date' id='due_date'>
	                  							<input type="hidden"  value="<?php echo date('Y-m-d'); ?>" name='update_date' id='update_date'>
	                						
	                						</div>

	              						</div>

				            		</div>

				            		<div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12'>
					            		
					            		<div class="row container-fluid">

					            			<label><h5><strong>Assigned To : </strong></h5></label>

					            		</div>

					            		<div class="row container-fluid">

	                						<div class="input-group date">

	                  							<?php

	                  								$row = pg_fetch_assoc(pg_query("SELECT id FROM usr WHERE email='$email'"));
	                  								$assigned_to = $row['id'];
												
	                  							?>
	                  							
	                  							<strong><?php echo $assigned_to; ?></strong>
	                  							<input type='hidden' value="<?php echo $assigned_to; ?>" name='assigned_to' id='assigned_to'>
	                						
	                						</div>

	              						</div>

				            		</div>

				            		<div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 container-fluid'>
					            		
					            		<div class="row container-fluid">

					            			<label><h5><strong>Vendor Assigned : </strong></h5></label>

					            		</div>

					            		<div class="row container-fluid">

	                						<div class="input-group container-fluid">

	                  							<select name='vendor_assigned' id='vendor_assigned'>

		                  							<option selected value=''>NONE</option>

		                  							<?php

		                  								$result = pg_query("SELECT * FROM vendor_master WHERE community_id=$community_id");

		                  								while($row = pg_fetch_assoc($result))
		                  								{
		                  									$vendor_id = $row['vendor_id'];
		                  									$vendor_name = $row['vendor_name'];

		                  									echo "<option value='$vendor_id'>$vendor_name</option>";

		                  								}
													
		                  							?>
	                  							
	                  							</select>
	                						
	                						</div>

	              						</div>

				            		</div>

			            		</div>

			            		<br>

			            		<div class="row container-fluid">

			            			<label><h5><strong>Comment : </strong></h5></label>

			            		</div>

			            		<div class="row container-fluid">

			            			<textarea id='comment' name='comment' class='form-control' required></textarea>
			            			
			            		</div>

			            		<br>

			            		<div class="row text-center">

			            			<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
			            				
			            				<center>
			            					
			            					<button type="submit" class="btn btn-info btn-xs">Set Reminder</button>
			            			
			            				</center>

			            			</div>

			            		</div>

			            		<br>

		                	</form>

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
	        	
	        	$("#example1").DataTable({ "pageLength": 50, "order": [[ 1, "asc"]] });

	      	});

    	</script>

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
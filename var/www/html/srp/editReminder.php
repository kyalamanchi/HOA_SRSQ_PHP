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

			$year = date("Y");
        	$month = date("m");
        	$end_date = date("t");

          	$rid = $_POST['rid'];
          	$due_date = $_POST['edit_due_date'];
          	$vendor_assigned = $_POST['edit_vendor'];
          	$comment = $_POST['edit_comments'];
          	$update_date = date('Y-m-d');
          	$reminder_type = $_POST['edit_reminder_type'];

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
									<li class="breadcrumb-item active">Edit Reminder</li>

								</ol>

							</div>
						
						</div>
						
					</div>
				
				</section>

				<!-- Content -->
				<section class="module">
						
					<div class="container">
							
						<div class='table-responsive col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12'>
						
							<?php 

                    			if($vendor_assigned == "")
                      				$query = "UPDATE reminders SET due_date='$due_date', update_date='$update_date', comments='$comment', reminder_type_id=$reminder_type WHERE id=$rid";
                    			else
                      				$query = "UPDATE reminders SET due_date='$due_date', update_date='$update_date', comments='$comment', reminder_type_id=$reminder_type, vendor_assigned=$vendor_assigned WHERE id=$rid";

                    			$result = pg_query($query);

                    			if($result == 0)
                    			{
                      
                      				echo "<br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-danger'><center><br /><strong style='font-size: 15pt;'>An error occured while updating reminder!</strong><br /><br />Please try again.<br /><br /></center></div></div></div>";

                      				echo "<br><br><center><a href='viewReminder.php'>Click here</a> if this page doenot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='viewReminder.php'},1000);</script>";

                    			}
                    			else 
                    			{
                      
                      				echo "<br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-success'><center><br /><strong style='font-size: 15pt;'>Reminder updated successfully!</strong><br /><br /><br /></center></div></div></div>";

                      				echo "<br><br><center><a href='viewReminder.php'>Click here</a> if this page doenot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='viewReminder.php'},1000);</script>";

                    			}

                  			?>

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

		<!-- Color Switcher (Remove these lines)-->
		<!--script src='assets/js/style-switcher.min.js'></script-->
	</body>

</html>
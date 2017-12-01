<?php
	
	ini_set("session.save_path","/var/www/html/session/");
	
	session_start();

	if(!$_SESSION['hoa_username'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = $_SESSION['hoa_community_id'];
	$mode = $_SESSION['hoa_mode'];

	$today = date('Y-m-d');

	if($mode == 2)
		Header('Location: residentDashboard.php');

	$hoa_id = $_POST['hoa_id'];
	$home_id = $_POST['home_id'];
	$name = $_POST['name'];
	$firstname = $_POST['edit_firstname'];
	$lastname = $_POST['edit_lastname'];
	$email = $_POST['edit_email'];
	$cell_no = $_POST['edit_cell_no'];
	$valid_from = $_POST['edit_valid_from'];
	$valid_until = $_POST['edit_valid_until'];

	$user_id = $_SESSION['hoa_user_id'];

	$ehoa_id = base64_encode($hoa_id);
	$ehome_id = base64_encode($home_id);
	$ename = base64_encode($name);

?>

<!DOCTYPE html>

<html>

	<head>

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

		<?php

			$result = pg_query("UPDATE hoaid SET firstname='$firstname', lastname='$lastname', email='$email', cell_no=$cell_no, valid_from='$valid_from', valid_until='$valid_until', updated_on='$today', updated_by=$user_id WHERE hoa_id=$hoa_id AND home_id=$home_id");

			if($result)
			{

				echo "<br /><br /><br /><br /><br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-success'><center><br /><strong style='font-size: 15pt;'>HOA ID Updated!</strong><br /><br /></center></div></div></div>";

				echo "<script>setTimeout(function(){window.location.href='userDashboard2.php?hoa_id=$ehoa_id&home_id=$ehome_id&name=$ename'},1000);</script>";

			}
			else
			{

				echo "<br /><br /><br /><br /><br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-danger'><center><br /><strong style='font-size: 15pt;'>Some error occured!</strong><br /><br />Please try again.<br /><br /></center></div></div></div>";

				echo "<script>setTimeout(function(){window.location.href='userDashboard2.php?hoa_id=$ehoa_id&home_id=$ehome_id&name=$ename'},1000);</script>";

			}


			echo "<br><br><br><center><a href='userDashboard2.php?hoa_id=$ehoa_id&home_id=$ehome_id&name=$ename'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center>";

		?>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

	</body>

</html>
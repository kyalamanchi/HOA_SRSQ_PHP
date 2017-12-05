<?php
	
	session_start();

?>
<!DOCTYPE html>

<html>

	<head>

		<title>Log In Page</title>

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

			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

			include 'password.php';

			$login_email = $_POST['srp_login_email'];
			$login_password = $_POST['srp_login_password'];

			$result = pg_query("SELECT * FROM usr WHERE email='$login_email'");

			$users = pg_num_rows($result);

			$now = date('Y-m-d');

			if($users)
			{
				$row = pg_fetch_assoc($result);
				$password = $row['password'];

				if(password_verify($login_password, $password))
				{

					session_start();

					$name = $row['first_name'];
					$name .= " ";
					$name .= $row['last_name'];
					$id = $row['id'];
					$member_id = $row['member_id'];
					$community_id = $row['community_id'];
					$otp = "";

					$row = pg_fetch_assoc(pg_query("SELECT * FROM member_info WHERE member_id=$member_id"));
					$hoa_id = $row['hoa_id'];

					$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
					$home_id = $row['home_id'];

					$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));
					$address = $row['address1'];

					$row = pg_fetch_assoc(pg_query("SELECT * FROM community_info WHERE community_id=$community_id"));
					$_SESSION['hoa_community_name'] = $row['legal_name'];
					$_SESSION['hoa_community_code'] = $row['community_code'];
					$_SESSION['hoa_community_website_url'] = $row['community_website_url'];

					$_SESSION['hoa_hoa_id'] = $hoa_id;
					$_SESSION['hoa_home_id'] = $home_id;
					$_SESSION['hoa_username'] = $name;
					$_SESSION['hoa_email'] = $login_email;
					$_SESSION['hoa_user_id'] = $id;
					$_SESSION['hoa_community_id'] = $community_id;
					$_SESSION['hoa_address'] = $address;

					$result = pg_query("UPDATE usr SET forgot_password_code='$otp' WHERE id=$id");

					$num_row = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$id"));

					if($num_row == 0)
					{	

						$_SESSION['hoa_mode'] = 1;

						$result = pg_query("UPDATE usr SET last_login='$now' WHERE id=$id");

						header("Location: residentDashboard.php");

					}
					else
					{
						
						$_SESSION['hoa_mode'] = 2;
						$result = pg_query("UPDATE usr SET last_login='$now' WHERE id=$id");

						header("Location: boardDashboard.php");

					}

				}
				else
				{

					echo "<br /><br /><br /><br /><br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-danger'><center><br /><strong style='font-size: 15pt;'>Invalid password!</strong><br /><br />Please check the password and try again.<br /><br /></center></div></div></div>";

					echo "<script>setTimeout(function(){window.location.href='index.php'},1000);</script>";

				}

			}
			else
			{

				echo "<br /><br /><br /><br /><br /><br /><br /><br /><div class='row'><div class='col-xl-3 col-lg-3 col-md-2 col-sm-1 col-xs-1'> </div><div class='col-xl-6 col-lg-6 col-md-8 col-sm-10 col-xs-10'><div class='alert alert-danger'><center><br /><strong style='font-size: 15pt;'>Invalid user!</strong><br /><br />Please check the email and try again.<br /><br /></center></div></div></div>";

				echo "<script>setTimeout(function(){window.location.href='index.php'},1000);</script>";

			}

		?>

		<!-- Scripts-->
		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
		<script src='https://cdnjs.cloudflare.com/ajax/libs/tether/1.1.1/js/tether.min.js'></script>
		<script src='assets/bootstrap/js/bootstrap.min.js'></script>
		<script src='assets/js/plugins.min.js'></script>
		<script src='assets/js/custom.min.js'></script>

	</body>

</html>
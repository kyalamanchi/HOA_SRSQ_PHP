<?php
	$login_email = $_POST['login_email'];
	$login_password = $_POST['login_password'];

	ini_set('max_execution_time', 180);

	include 'password.php';

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$query = "SELECT * FROM usr WHERE email='".$login_email."'";
	$result = pg_query($query);
	$num_row = pg_num_rows($result);

	if($num_row == 0)
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("User doesnot exist.");'; 
		echo 'window.location.href = "https://hoaboardtime.com/";';
		echo '</script>';
	}
	else
	{
		$row =pg_fetch_assoc($result);
		$password = $row['password'];

		if(password_verify($login_password, $password))
		{
			$name = $row['first_name'];
			$name .= " ";
			$name .= $row['last_name'];
			$forgot_password_code = $row['forgot_password_code'];

			session_start();

			$_SESSION['hoa_username'] = $name;
			$_SESSION['hoa_email'] = $login_email;
			$_SESSION['hoa_user_id'] = $row['id'];
			$_SESSION['hoa_community_id'] = $row['community_id'];

			if($_SESSION['hoa_user_id'] == 400)
			{
				if($forgot_password_code != "")
				{
					$forgot_password_code = "";
					$result = pg_query("UPDATE usr SET forgot_password_code='".$forgot_password_code."' WHERE email='".$login_email."'");
				}

				header("Location: https://hoaboardtime.com/backendBalance.php");
				
			}
			else
			{
				
				$query = "SELECT * FROM hoaid WHERE email='".$login_email."'";
				$result = pg_query($query);
				$row =pg_fetch_assoc($result);

				$_SESSION['hoa_hoa_id'] = $row['hoa_id'];
				$_SESSION['hoa_home_id'] = $row['home_id'];

				$query = "SELECT * FROM homeid WHERE home_id=".$_SESSION['hoa_home_id'];
				$result = pg_query($query);
				$row =pg_fetch_assoc($result);

				$_SESSION['hoa_address'] = $row['address1'];

				$query = "SELECT * FROM community_info WHERE community_id=".$_SESSION['hoa_community_id'];
				$result = pg_query($query);
				$row =pg_fetch_assoc($result);

				$_SESSION['hoa_community_name'] = $row['legal_name'];
				$_SESSION['hoa_community_code'] = $row['community_code'];
				$_SESSION['hoa_community_website_url'] = $row['community_website_url'];

				$query = "SELECT * FROM board_committee_details WHERE user_id=".$_SESSION['hoa_user_id'];
				$result = pg_query($query);
				$num_row = pg_num_rows($result);

				if($num_row == 0)
					header("Location: https://hoaboardtime.com/residentDashboard.php");
				else
					header("Location: https://hoaboardtime.com/boardDashboard.php");

			}
		}
		else
		{
			echo '<script type="text/javascript">'; 
			echo 'alert("Invalid password entered.Please check the password and try again.");'; 
			echo 'window.location.href = "https://hoaboardtime.com/";';
			echo '</script>';
		}
	}
?>
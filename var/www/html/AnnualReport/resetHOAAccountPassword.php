<?php

	session_start();

	if(!$_SESSION)
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	include 'password.php';

	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];

	$password = $_POST['set_password'];
	$confirm_password = $_POST['confirm_password'];

	if($password == $confirm_password)
	{
		
		$pass = password_hash($confirm_password, PASSWORD_BCRYPT);

		$result = pg_query("UPDATE usr SET password='".$pass."', modified_date='".date('Y-m-d')."' WHERE id='".$user_id."'");

		echo "<script type='text/javascript'> alert('Password successfully changed.'); </script>";

		session_start();
		session_unset();
		session_destroy();
		session_regenerate_id(true);

		if($community_id == 1)
			header("Location: https://stoneridgeplace.com");
		else if($community_id == 2)
			header("Location: https://hoaboardtime.com");

	}
	else
		echo "<script type='text/javascript'> alert('Password confirmation failed. Please try again.'); window.location = 'hoaAccountInfo.php' </script>";

?>
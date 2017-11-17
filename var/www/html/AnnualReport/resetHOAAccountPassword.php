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

		echo "<script type='text/javascript'> alert('Password successfully changed.'); </script><script>setTimeout(function(){window.location.href='navigatePage.php'},2000);</script>";

	}
	else
		echo "<script type='text/javascript'> alert('Password confirmation failed. Please try again.'); window.location = 'hoaAccountInfo.php' </script>";

?>
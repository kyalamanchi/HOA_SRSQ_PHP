<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
	$username = $row['firstname'];
	$username .= " ";
	$username .= $row['lastname'];
	$_SESSION['hoa_alchemy_email'] = $row['email'];
	$_SESSION['hoa_alchemy_home_id'] = $row['home_id'];

	$_SESSION['hoa_alchemy_username'] = $username;

	$row = pg_fetch_assoc(pg_query("SELECT * FROM member_info WHERE hoa_id=$hoa_id"));
	$member_id = $row['member_id'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM usr WHERE member_id=$member_id"));
	$_SESSION['hoa_alchemy_user_id'] = $row['id'];

	header("Location: userPage.php");

?>
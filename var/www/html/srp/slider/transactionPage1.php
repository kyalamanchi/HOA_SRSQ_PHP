<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));
	$username = $row['firstname'];
	$username .= " ";
	$username .= $row['lastname'];

	$_SESSION['hoa_alchemy_username'] = $username;

	echo $_SESSION['hoa_alchemy_hoa_id']." ".$_SESSION['hoa_alchemy_username'];

?>
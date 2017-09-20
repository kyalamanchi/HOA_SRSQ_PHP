<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	include 'password.php';

	$login_email = $_POST['login_email'];
	$login_password = $_POST['login_password'];

	echo $login_email." - - - ".$login_password;

?>
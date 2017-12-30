<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$role_type = $_POST['roleId'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role_type"));

	echo $row['name'];

?>
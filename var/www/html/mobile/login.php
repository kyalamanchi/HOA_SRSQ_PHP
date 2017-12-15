<?php

include 'password.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");

$query  = "SELECT * FROM USR WHERE EMAIL='".$_GET['email']."'";

$queryResult = pg_query($query);

$row = pg_fetch_assoc($queryResult);

if ( password_verify($_GET['pwd'], $row['password']) ){
	echo "Login success";
}
else {
	print_r($row);
}

?>
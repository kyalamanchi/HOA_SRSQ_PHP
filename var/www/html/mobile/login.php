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
	$userData = array();

	$subQuery = "SELECT * FROM member_info WHERE member_id=".$row['member_id'];
	$subQueryResult = pg_query($subQuery);

	$subRow = pg_fetch_assoc($subQueryResult);



	$userData['hoa_id'] = $subRow['hid'];

	$userData['first_name'] = $row['first_name'];

	$userData['last_name'] = $row['last_name'];

	$userData['login_email'] = $_GET['email'];

	print_r(json_encode($userData));
}
else {
	print_r($row);
}

?>
<?php

include 'password.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");

$query = "SELECT * FROM HOMEID WHERE COMMUNITY_ID=".$_GET['cid'];

$queryResult = pg_query($query);

$homeID = array();

while ($row = pg_fetch_assoc($queryResult)) {
	$homeID[$row['home_id']] = $row['address1'];
}
$query = "SELECT * FROM HOAID WHERE COMMUNITY_ID=".$_GET['cid'];
$queryResult = pg_query($query);
$members = array();
while ($row = pg_fetch_assoc($queryResult)) {
	$sub = array();
	$sub['hoa_id'] = $row['hoa_id'];
	$sub['first_name'] = $row['firstname'];
	$sub['last_name'] = $row['lastname'];
	$sub['address'] = $homeID[$row['home_id']];

	array_push($members, $sub);
}


$response = array();

$response["response"] = "success";

$response["memberData"] = $members;

echo json_encode($response);

?>
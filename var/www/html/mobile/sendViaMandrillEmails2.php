<?php
date_default_timezone_set('America/Los_Angeles');
error_reporting(E_ALL);
ini_set('display_errors', 1);
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$hoaID = $_GET['hoa_id'];
$query = "SELECT EMAIL FROM HOAID WHERE HOA_ID=".$hoaID;
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);

if ( isset($row['email']) ){
	$email  = $row['email'];
	$email  = "";
	$url = "https://hoaboardtime.com/sendViaMandrill.php?hoaid=".$hoaID."&email=".$email;
	$req = curl_init();
	curl_setopt($req, CURLOPT_URL,$url);
	curl_exec($req);
	$response = array();
	$response["response"] = "success";

	echo json_encode($response);
}
else {
	$response = array();
	$response["response"] = "error";
	echo json_encode($response);
}

?>
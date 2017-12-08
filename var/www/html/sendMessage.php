<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('America/Los_Angeles');

pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");


$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

$message = $parseJSON[0]->message_body;

$message str_replace('\n', '%0a', $message);

if ( $parseJSON[0]->mode == "all" ){
	echo "ALL";
}
else if ( $parseJSON[0]->mode == "single" ){
	echo "SINGLE";
}

else {
	exit(0);
}


?>
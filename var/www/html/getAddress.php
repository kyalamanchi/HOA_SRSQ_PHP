<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);
$hoaID = $parseJSON[0]->member_id;
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$query = "SELECT HOME_ID FROM HOAID WHERE HOA_ID = ".$hoaID;
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$homeID = $row['home_id'];

$query = "SELECT * FROM HOMEID WHERE HOME_ID=".$homeID;
$queryResult = pg_query($query);
$row  = pg_fetch_assoc($queryResult);

if ( $row['living_status'] == 'f') {
	$query = "SELECT * FROM HOME_MAILING_ADDRESS WHERE HOME_ID=".$row['home_id'];
	$queryResult = pg_query($query);
	$row2 = pg_fetch_assoc($queryResult);

	$returnArray = array();

	array_push($returnArray, $row['home_id'].'#'.$row['address1']);
	array_push($returnArray, $row2['home_id'].'#'.$row2['address1']);
	echo json_encode($returnArray);
}

else {
	$returnArray = array();
	array_push($returnArray, $row['home_id'].'#'.$row['address1']);
	echo json_encode($returnArray);
}

?>
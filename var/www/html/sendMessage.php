<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('America/Los_Angeles');

pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");


$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

$message = $parseJSON[0]->message_body;

$message = str_replace('\n', '%0a', $message);

if ( $parseJSON[0]->mode == "all" ){
	
	$query = "SELECT * FROM COMMUNITY_COMMS WHERE COMMUNITY_ID=".$parseJSON[0]->community_id." AND EVENT_TYPE_ID=".$parseJSON[0]->event_type;
	$queryResult = pg_query($query);
	$personIDS = array();
	while ($row  = pg_fetch_assoc($queryResult)) {
		$personIDS[$row['person_id']] = 1;
	}

	foreach ($personIDS as $key => $value) {
		$query = "SELECT CELL_NO FROM PERSON WHERE ID=".$key;
		$queryResult = pg_query($query);
		$row = pg_fetch_assoc($queryResult);
		print_r($row['cell_no']);
	}

}
else if ( $parseJSON[0]->mode == "single" ){

	$query = "SELECT * FROM HOAID WHERE HOA_ID=".$parseJSON[0]->hoa_id;
	$queryResult = pg_query($query);
	$row = pg_fetch_assoc($queryResult);
	echo $row['cell_no'];
	
}

else {
	exit(0);
}


?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('America/Los_Angeles');

pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");




$data = file_get_contents('php://input');
$parseJSON = json_decode($data);




		
if ( $parseJSON[0]->community_id == 1){
			$accountID = '';
			$authToken  = '';
}
else if ( $parseJSON[0]->community_id == 2){
			$accountID = 'AC9370eeb4b1922b7dc29d94c387b3ab56';
			$authToken  = '3b29450d9ce0e5ec7ba6b328f05525a2';
}

$homeQuery = "SELECT * FROM HOMEID WHERE COMMUNITY_ID=".$parseJSON[0]->community_id;

$homeQueryResult = pg_query($homeQuery);

$homeIDS = array();

while ($row23 = pg_fetch_assoc($homeQueryResult)) {
	$homeIDS[$row23['home_id']] = $row23['address1'];
}




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

		$query = "SELECT * FROM PERSON WHERE ID=".$key;
		$queryResult = pg_query($query);
		$row = pg_fetch_assoc($queryResult);
		if ( $row['cell_no'] ){
		$messageSub = str_replace('#address#', $homeIDS[$row['home_id']], $message);
		$messageSub = str_replace('#name#', $row['fname'].' '.$row['lname'], $message);
		echo $messageSub;
		}
		else {
			echo "No Phone number found.";
		}
	}

}
else if ( $parseJSON[0]->mode == "single" ){
	
	$query = "SELECT * FROM HOAID WHERE HOA_ID=".$parseJSON[0]->hoa_id;
	$queryResult = pg_query($query);
	$row = pg_fetch_assoc($queryResult);
	if ( $row['cell_no'] ){
		
		if ( $parseJSON[0]->community_id == 1){
			$accountID = '';
			$authToken  = '';
		}
		else if ( $parseJSON[0]->community_id == 2){
			$accountID = 'AC9370eeb4b1922b7dc29d94c387b3ab56';
			$authToken  = '3b29450d9ce0e5ec7ba6b328f05525a2';
		}

		$message = str_replace('#address#', $homeIDS[$row['home_id']], $message);
		$message = str_replace('#name#', $row['firstname'].' '.$row['lastname'], $message);
		echo $message;



	}
	else 
	{
		echo "No Phone number found.";
	}
}

else {
	exit(0);
}


?>
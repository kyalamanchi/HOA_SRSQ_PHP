<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');
	$connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
	$qr = "SELECT SID FROM SMS_SENT";
	$qrr = pg_query($qr);
	$smsArray = array();

	while ($row = pg_fetch_assoc($qrr)) {
		$smsArray[$row['sid']]  = 1;
	}


	$url = 'https://api.twilio.com/2010-04-01/Accounts/AC06019424f034503e8a7c67a8ddfcd490/Messages.json?PageSize=1000&Page=0';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_USERPWD, "AC06019424f034503e8a7c67a8ddfcd490" . ":" . "a73768c36829436835653b51dd3c693c");
	$res = curl_exec($ch);
	$res = json_decode($res);
	foreach ($res->messages as $message) {

		if ( $smsArray[$message->sid] ){
			$qr = "UPDATE SMS_SENT SET UPDATED_BY=401,UPDATED_ON='".date('Y-m-d H:i:s')."', STATUS='$message->status',date_updated='".date('Y-m-d H:i:s',strtotime($message->date_updated))."' WHERE SID='$message->sid'";
			pg_query($qr);
		}
		else {
			$dateCreated2 = $message->date_created;
			$dateUpdated2 = $message->date_updated;
			// $toNumber = $message->to;
			// $caseOne = substr($toNumber, 2);
			// $caseTwo = substr($toNumber, 3);
			// $caseThree = substr($toNumber, 4);
			// $caseOne = base64_encode($caseOne);
			// $caseThree = base64_encode($caseThree);
			// $caseTwo = base64_encode($caseTwo);
			// $personQuery = "SELECT * FROM PERSON WHERE CELL_NO = '".."'";
			// $personQueryResult = pg_query($personQuery);
			// $row = pg_fetch_assoc($personQueryResult);
			// $personID = $row['id'];
			$qr = "INSERT INTO SMS_SENT(SID,DATE_CREATED,DATE_UPDATED,TO_NUMBER,FROM_NUMBER,STATUS,URI,UPDATED_BY,UPDATED_ON) VALUES('$message->sid','$dateCreated2','$dateUpdated2','$message->to','$message->from','$message->status','$message->uri',401,'".date('Y-m-d H:i:s')."')";
			pg_query($qr);
		}
	}
?>
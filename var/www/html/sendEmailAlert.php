<?php
	date_default_timezone_set('America/Los_Angeles');
	$connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
	$communityID = $_GET['cid'];
	$eventID = $_GET['eid'];

	//Getting list of members

	if (  isset($communityID) && isset($eventID) ){
		$query = "SELECT * FROM COMMUNITY_COMMS WHERE COMMUNITY_ID =".$communityID." AND EVENT_TYPE_ID = ".$eventID." AND email='true'";
		$queryResult = pg_query($query);

		if ( $eventID == 5 ){

			while ($row = pg_fetch_assoc($queryResult)) {
				$hoaID = $row['hoa_id'];
				$subQuery = "SELECT EMAIL FROM HOAID WHERE HOA_ID=".$hoaID;
				$subQueryResult = pg_query($subQuery);
				$subRow = pg_fetch_assoc($subQueryResult);
				$email = $subRow['email'];
				print_r($hoaID." ".$email);
				print_r(nl2br("\n\n"));
			}


		}


	}
	else {
		echo "Invalid input given.";
		exit(0);
	}




	// $telnoquery = "SELECT TELNO FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$communityID;
	// $telnoqueryResult = pg_query($telnoquery);

	// $telnoassoc = pg_fetch_assoc($telnoqueryResult);

	// $telno = $telnoassoc['telno'];



	// $query=  "SELECT * FROM COMMUNITY_COMMS WHERE EVENT_TYPE_ID=$eventID AND PERSON_ID IN (SELECT ID FROM PERSON WHERE COMMUNITY_ID  = $communityID) ORDER BY PERSON_ID";
	// $queryResult = pg_query($query);
	// $phoneAlerts = array();
	// $pushAlerts = array();
	// $emailAlerts = array(); 
	// $hoaPersonIDS  =  array();
	// while ($row = pg_fetch_assoc($queryResult)) {
	// 	$hoaPersonIDS[ $row['person_id'] ] = $row['hoa_id'];
	// 	if ( $row['phone'] == 't' ){
	// 		array_push($emailAlerts, $row['person_id']);
	// 	}
	// 	if ( $row['email'] == 't' ){
	// 		array_push($phoneAlerts, $row['person_id']);
	// 	}
	// 	if ( $row['push'] == 't' ){
	// 		array_push($pushAlerts, $row['person_id']);
	// 	}
	// }
	// $countryQuery = "SELECT * FROM COUNTRY ORDER BY COUNTRY_ID";
	// $countryQueryResult = pg_query($countryQuery);

	// $countryCodes = array();
	// while ($row = pg_fetch_assoc($countryQueryResult)) {
	// 	$countryCodes[$row['country_id']] = $row['tel_prefix'];
	// }


	// $personCountry = array();

	// foreach ($hoaPersonIDS as $key => $value) {
	// 	$hoaQuery = "SELECT HOME_ID FROM HOAID WHERE HOA_ID=$value";
	// 	$hoaQueryResult = pg_query($hoaQuery);
	// 	$homeId = pg_fetch_assoc($hoaQueryResult);
	// 	$homeId = $homeId['home_id'];
	// 	$homeQ = "SELECT * FROM HOMEID WHERE HOME_ID=$homeId";
	// 	$homeQR = pg_query($homeQ);
	// 	$home = pg_fetch_assoc($homeQR);
	// 	if ( $home['living_status'] == 't' ){
	// 		$personCountry[$key] = $home['country_id'];
	// 	}
	// 	else {
	// 		$mailing = "SELECT * FROM HOME_MAILING_ADDRESS WHERE HOME_ID=$homeId";
	// 		$mailingResult = pg_query($mailing);
	// 		$qr = pg_fetch_assoc($mailingResult);
	// 		$personCountry[$key] = $qr['country_id'];
	// 	}
	// }


	// $toPhoneNumbers = array();
	// $toEmails = array();
	// $personHOMEID  = array();
	// foreach ($phoneAlerts as $key) {
	// 	$phoneNumberQ  = "SELECT CELL_NO,HOME_ID FROM PERSON WHERE ID=$key";
	// 	$phoneNumberQR = pg_query($phoneNumberQ);
	// 	$number = pg_fetch_assoc($phoneNumberQR);
	// 	$personHOMEID[$key] = $number['home_id'];
	// 	$number = $number['cell_no'];

	// 	if ($number)
	// 	$toPhoneNumbers[$personCountry[$key].$number] = $key;
	// }

	// foreach ($emailAlerts as $key) {
	// 	$emailQ = "SELECT EMAIL,HOME_ID FROM PERSON WHERE ID=$key";
	// 	$emailQR = pg_query($emailQ);
	// 	$email = pg_fetch_assoc($emailQR);
	// 	$personHOMEID[$key] = $email['home_id'];
	// 	$email = $email['email'];
	// 	if ( $email ){
	// 		array_push($toEmails, $email);
	// 	}
	// }

	// foreach ($personHOMEID as $key => $value) {
	// 	$qr = "SELECT * FROM HOMEID WHERE HOME_ID=".$value;
	// 	$qrr = pg_query($qr);
	// 	$r = pg_fetch_assoc($qrr);
	// 	$personHOMEID[$key] = $r['address1'];
	// }



	// $mq = "SELECT BODY FROM MOBILE_NOTIF_BODY WHERE COMMUNITY_ID = $communityID AND  EVENT_TYPE_ID = $eventID";
	// $mqr = pg_query($mq);
	// $message = pg_fetch_assoc($mqr);
	// $body = $message['body'];

	// if ( $eventID == 5 ){
	// 	$body = str_replace('#month#', date('F', strtotime('+1 month')) , $body) ;
	// 	$cq = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID = $communityID";
	// 	$cqR = pg_query($cq);
	// 	$cname = pg_fetch_assoc($cqR);
	// 	$cname = $cname['legal_name'];
	// 	$body = $body.' - '.$cname;
	// 	$mbody = $body;
	// 	//SENDING SMS
	// 	foreach ($toPhoneNumbers as $key => $value) {
	// 	$body =  $mbody;
	// 	$body = str_replace('#homeid#', $personHOMEID[$value] , $body) ;
	// 	$url  = 'https://api.twilio.com/2010-04-01/Accounts/AC06019424f034503e8a7c67a8ddfcd490/Messages.json';
	// 	$ch = curl_init();
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, "Body=$body&To=%2B$key&From=%2B1$telno");
	// 	curl_setopt($ch, CURLOPT_POST, 1);
	// 	curl_setopt($ch, CURLOPT_USERPWD, "AC06019424f034503e8a7c67a8ddfcd490" . ":" . "a73768c36829436835653b51dd3c693c");
	// 	$headers = array();
	// 	$headers[] = "Content-Type: application/x-www-form-urlencoded";
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// 	$result = curl_exec($ch);
	// 	if (curl_errno($ch)) {
 //    		echo 'Error:' . curl_error($ch);
	// 	}
	// 	curl_close ($ch);
	// 	print_r(nl2br("\n\n"));
	// 	print_r("Response is ".$result);
	// 	print_r(nl2br("\n\n"));
	// 	$result = json_decode($result);
	// 	$sid = $result->sid;
	// 	$dateCreated = date('Y-m-d H:i:s',strtotime($result->date_created));
	// 	$dateUpdated = date('Y-m-d H:i:s',strtotime($result->date_updated));
	// 	$toNumber = $result->to;
	// 	$fromNumber = $result->from;
	// 	$status = $result->status;
	// 	$uri = $result->uri;
	// 	$insert = "INSERT INTO SMS_SENT(SID,DATE_CREATED,DATE_UPDATED,TO_NUMBER,FROM_NUMBER,STATUS,URI,PERSON_ID) VALUES('$sid','$dateCreated','$dateUpdated','$toNumber','$fromNumber','$status','$uri',$value)";
	// 	pg_query($insert);
	// 	}
	// }
	// else {
	// 	exit(0);
	// }
?>
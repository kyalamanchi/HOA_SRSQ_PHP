<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');
$connection  = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

$query = "SELECT api_mail_id FROM community_emails_sent ";
$queryResult = pg_query($query);
$mandrillIDS = array();

while ($row = pg_fetch_assoc($queryResult)) {
	$mandrillIDS[$row['api_mail_id']]  = 1;
}

$uri = 'https://mandrillapp.com/api/1.0/messages/search.json';
$api_key = 'NRqC1Izl9L8aU-lgm_LS2A';
$postString = '{
    "key": "'.$api_key.'",
    "query": "stoneridgeplace.org",
    "date_from": "'.date('Y-m-d', strtotime('-90 days')).'"
}';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
$result = curl_exec($ch);	
$result = json_decode($result);
foreach ($result as $result1) {
	if ( $connection ){

		if (  $mandrillIDS[$result1->_id] != 1 ){
		$query = "INSERT INTO community_emails_sent(\"from_email\",\"to_email\",\"email_subject\",\"number_of_clicks\",\"number_of_opens\",\"api_mail_id\",\"sent_date\",\"status\",\"community_id\",\"update_date\",\"updated_by\") VALUES('".$result1->sender."','".$result1->email."','".$result1->subject."',".$result1->clicks.",".$result1->opens.",'".$result1->_id."','".date('Y-m-d',$result1->ts)."','".$result1->state."',1,'".date('Y-m-d H:i:s')."',401)";
		pg_query($query);
		}
		else {
			$query = "UPDATE community_emails_sent SET \"status\"='".$result1->state."',\"update_date\"='".date('Y-m-d H:i:s')."',\"updated_by\"=401 WHERE api_mail_id='".$result1->_id."'";
			pg_query($query);
		}
	}
}


$uri = 'https://mandrillapp.com/api/1.0/messages/search.json';
$api_key = 'cYcxW-Z8ZPuaqPne1hFjrA';
	$postString = '{
    "key": "'.$api_key.'",
    "query": "stoneridgesquare.org",
    "date_from": "'.date('Y-m-d', strtotime('-90 days')).'"
}';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $uri);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
$result = curl_exec($ch);	
$result = json_decode($result);
print_r($result);
foreach ($result as $result1) {	
	if ( $connection ){
		if (  $mandrillIDS[$result1->_id] != 1 ){
		$query = "INSERT INTO community_emails_sent(\"from_email\",\"to_email\",\"email_subject\",\"number_of_clicks\",\"number_of_opens\",\"api_mail_id\",\"sent_date\",\"status\",\"community_id\",\"update_date\",\"updated_by\") VALUES('".$result1->sender."','".$result1->email."','".$result1->subject."',".$result1->clicks.",".$result1->opens.",'".$result1->_id."','".date('Y-m-d',$result1->ts)."','".$result1->state."',2,'".date('Y-m-d H:i:s')."',401)";
		pg_query($query);
		}
		else {
			$query = "UPDATE community_emails_sent SET \"number_of_clicks\"=".$result1->clicks.",\"number_of_opens\"=".$result1->opens.",\"status\"='".$result1->state."',\"update_date\"='".date('Y-m-d H:i:s')."',\"updated_by\"=401 WHERE api_mail_id='".$result1->_id."'";
			pg_query($query);
		}
	}
}
?>
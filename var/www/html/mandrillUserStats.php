<?php
date_default_timezone_set('America/Los_Angeles');
$connection  = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

$uri = 'https://mandrillapp.com/api/1.0/messages/search.json';
$api_key = 'NRqC1Izl9L8aU-lgm_LS2A';
if ( $_GET['id']){
$postString = '{
    "key": "'.$api_key.'",
    "query": "email:'.$_GET['id'].'",
    "date_from": "'.date('Y-m-d', strtotime('-90 days')).'"
}';
}
else {
	$postString = '{
    "key": "'.$api_key.'",
    "query": "sender:info@stoneridgeplace.org",
    "date_from": "'.date('Y-m-d', strtotime('-90 days')).'"
}';
}
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
		$query = "INSERT INTO community_emails_sent(\"from_email\",\"to_email\",\"email_subject\",\"number_of_clicks\",\"number_of_opens\",\"email_id\",\"sent_date\") VALUES('".$result1->sender."','".$result1->email."','".$result1->subject."',".$result1->clicks.",".$result1->opens.",'".$result1->email."','".date('Y-m-d',$result1->ts)."','".$result1->state."')";
		echo $query;
		echo nl2br("\n\n");
	}
}
?>
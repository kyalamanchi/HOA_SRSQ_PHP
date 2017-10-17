<?php
date_default_timezone_set('America/Los_Angeles');
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
	print_r($result1);
	print_r(nl2br("\n\n\n"));
	print_r("Email : ".$result1->email.nl2br("\n"));
	print_r("Date : ".date('Y-m-d',$result1->ts).nl2br("\n"));
	print_r("Subject : ".$result1->subject.nl2br("\n"));
	print_r("Number of clicks : ".$result1->clicks.nl2br("\n"));
	print_r($result1->_id);
	print_r("Number of opens : ".$result1->opens.nl2br("\n\n\n"));

}
?>
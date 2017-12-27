<?php

	ini_set("session.save_path","/var/www/html/session/");
	session_start();

    date_default_timezone_set('America/Los_Angeles');

	header("Content-type: application/pdf");
	
	$agreementID  = $_GET['id'];
	$url  = 'https://api.na1.echosign.com:443/api/rest/v5/agreements/';
	$url  = $url.$agreementID."/combinedDocument";
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

	if($_SESSION['hoa_community_id'] == 2)
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Token:3AAABLblqZhBbuoGJoQZXIMhISUIAnh7R_qmzGgn_COsBf1G0kXyDFiaXxE-oM8ZMaL1LPybdYz1U2gYXszLLzpLuenZ3Ojfm'));

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	$result = curl_exec($ch);
	
	print_r($result);

	pg_close();

?>
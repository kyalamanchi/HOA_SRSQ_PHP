<?php

	date_default_timezone_set('America/Los_Angeles');

	header("Content-type: application/pdf");
	
	$agreementID  = '3AAABLblqZhBU4LIZlQ_miglGMOP4dPF6sw9GR3Z7Tdy8ouqC10YjAoGLetf8sXmMcdT2PpbW8s8Lt_htCcAj8C9UisNWZsEt';#$_GET['id'];
	$url  = 'https://api.na1.echosign.com:443/api/rest/v5/agreements/';
	$url  = $url.$agreementID."/combinedDocument";
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Token:3AAABLblqZhBbuoGJoQZXIMhISUIAnh7R_qmzGgn_COsBf1G0kXyDFiaXxE-oM8ZMaL1LPybdYz1U2gYXszLLzpLuenZ3Ojfm'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	$result = curl_exec($ch);
	
	print_r($result);

	pg_close();

?>
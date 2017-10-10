<?php
	
	session_start();

	require 'app/start.php';

	if($_SESSION['hoa_community_id'] == 1)
		$accessToken = '0gTJRfMcSHAAAAAAAAAADNfolm5IYvkINbXQpejgF8X2Hoy_6kXOlJemzq1a-588';
	else if($_SESSION['hoa_community_id'] == 2)
		$accessToken = 'QwUjEm5GAkAAAAAAAAAAVDjZsvVGfEhuiibnS0Zd-m96gHxqjZmpb2NTrT0g2Rd_';

	$client = new Dropbox\Client($accessToken, $appName, 'UTF-8');

	$path = $_GET['path'];
	$description = $_GET['desc'];

	$client->getFile($path, fopen($description.".pdf", 'wb'));

	header("Location: https://hoaboardtime.com/".$description.".pdf");

?>
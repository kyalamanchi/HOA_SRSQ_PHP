<?php
	
	session_start();



	if($_GET['cid'] == 1)
	{
		
		$accessToken = '0gTJRfMcSHAAAAAAAAAADNfolm5IYvkINbXQpejgF8X2Hoy_6kXOlJemzq1a-588';

	}
	else if($_GET['cid'] == 2)
	{
		
		$accessToken = 'QwUjEm5GAkAAAAAAAAAAN-KemUHI72QOlDsQxtH6H9JlRixSoi1fqq7D7BCHrNFm';

	}

	$path = $_GET['path'];
	$description = $_GET['desc'];

	$url = 'https://content.dropboxapi.com/2/files/download';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken,'Dropbox-API-Arg: {"path": "'.$path.'"}'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);

	if (strpos( json_decode($response), 'error_summary') !== false) 
	{
    	
    	echo '<br><br><br><br><br><center><h3>There was an error opening this document. This file cannot be found.</h3></center>';

	}	
	else
	{

		header('Content-type: application/pdf'); 
		header('Content-Disposition: inline; filename="'.$description.'.pdf"'); 
		echo $response;

	}
	
?>
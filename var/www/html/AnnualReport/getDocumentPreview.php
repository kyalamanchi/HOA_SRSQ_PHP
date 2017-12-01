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
	if( $_GET['t'] == 1 ){
		$accessToken= 'n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB';
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
    	
    	$result = pg_query("UPDATE document_management SET active='f' WHERE document_id=$doc_id");
    	
    	echo '<br><br><br><br><br><center><h3>There was an error opening this document. This file cannot be found.</h3></center>';

	}
	else if ( (strpos( ($response), 'pdf') !== false) || (strpos( ($response), 'PDF') !== false )  ){
		header('Content-type: application/pdf'); 
		header('Content-Disposition: inline; filename="'.$description.'.pdf"'); 
		echo $response;
	}
	else
	{
	$fileContent = $response;
	$url = 'https://api.dropboxapi.com/2/files/alpha/get_metadata';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken,'Content-Type:application/json'));
	curl_setopt($ch, CURLOPT_POSTFIELDS,     '{
    "path": "'.$path.'",
    "include_media_info": true,
    "include_deleted": false,
    "include_has_explicit_shared_members": true
	}' ); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$res = curl_exec($ch);
	$name = (json_decode($res)->name);
	$name = explode(".", $name);
	$val = uniqid();
	$name = $name[0].$val.$name[1];
	file_put_contents($name, $fileContent);
	header('Content-Description: File Transfer');
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header("Content-Disposition: attachment; filename=\"".basename($name)."\"");
    header("Content-Transfer-Encoding: binary");
    header("Expires: 0");
    header("Pragma: public");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header('Content-Length: ' . filesize($name)); 
    ob_clean();
    flush();
    readfile($name);
	unlink($name);
	echo '<br><br><br><br><br><center><h3>File cannot be opened. Downloading File...</h3></center>';

	}
?>
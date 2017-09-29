<?php
if ( $_GET['id'] ){
	$fileName = $_GET['id'].'.zip';
	$url = 'https://content.dropboxapi.com/2/files/download';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Dropbox-API-Arg: {"path": "'.$_GET['data'].'"}'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);
	$file = fopen($fileName, "w");
	fwrite($file, $response);
	fclose($file);
	header('Content-Type: application/octet-stream');
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-disposition: attachment; filename=\"" . basename($fileName) . "\""); 
	readfile($fileName);
	unlink($fileName);
}
?>
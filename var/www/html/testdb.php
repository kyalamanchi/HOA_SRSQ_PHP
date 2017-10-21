<?php
$url = 'https://content.dropboxapi.com/2/files/download';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Dropbox-API-Arg: {"path": "Alchemy/2017Ad.pdf"}'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
header('Content-type: application/pdf'); header('Content-Disposition: inline; filename="a.pdf"'); 
echo $response;
?>
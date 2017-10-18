<?php
$url = 'https://content.dropboxapi.com/2/files/download';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer QwUjEm5GAkAAAAAAAAAAN-KemUHI72QOlDsQxtH6H9JlRixSoi1fqq7D7BCHrNFm','Dropbox-API-Arg: {"path": "id:xyPla0oGjJAAAAAAAAAHRQ"}'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
$file = fopen('data.pdf', 'w');
fwrite($file, $response);
header('Content-type: application/pdf'); 
header('Content-Disposition: inline; filename="data.pdf"'); 
readfile('data.pdf');
?>
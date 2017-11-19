<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

$handler = fopen($parseJSON[0]->file_name, "w");
fwrite($handler, $parseJSON[0]->file_data);
fclose($handler);


$url = 'https://content.dropboxapi.com/2/files/upload';
    $pdfFileContent = $parseJSON[0]->file_data;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer xCCkLEFieJAAAAAAAAABUHpqfAcHsr24243JwXKp_A6jK_cKpN-9IFdm8QxGBjx9','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/'.$pdfFileName.'","mode": "overwrite","autorename": false,"mute": false}'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $pdfFileContent); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);

echo json_decode($response);

unlink($parseJSON[0]->file_name);




?>
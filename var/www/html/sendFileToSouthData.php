<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

$handler = fopen($parseJSON[0]->file_name, "w");
fwrite($handler, base64_decode($parseJSON[0]->file_data));
fclose($handler);


	$url = 'https://content.dropboxapi.com/2/files/upload';
    $pdfFileContent = file_get_contents($parseJSON[0]->file_name);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer xCCkLEFieJAAAAAAAAABUHpqfAcHsr24243JwXKp_A6jK_cKpN-9IFdm8QxGBjx9','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/'.$parseJSON[0]->file_name.'","mode": "overwrite","autorename": false,"mute": false}'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $pdfFileContent); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $response = json_decode($response);
    if ( isset($response->error_summary) ){
    	echo "An error occured.";
    }
    else {
    	echo "File uploaded successfully";
    }





//Deleting created file
unlink($parseJSON[0]->file_name);
?>
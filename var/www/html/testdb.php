<?php
session_start();
echo $_SESSION['hoa_community_id'];
if($_SESSION['hoa_community_id'] == 1)
		$accessToken = '0gTJRfMcSHAAAAAAAAAADNfolm5IYvkINbXQpejgF8X2Hoy_6kXOlJemzq1a-588';
	else if($_SESSION['hoa_community_id'] == 2)
		$accessToken = 'QwUjEm5GAkAAAAAAAAAADocHK4CgCJoBl2A8-fe9Fs42E06qkDqJA2S9YPwGbZyF';
$path = $_GET['path'];
$description = $_GET['desc'];
$url = 'https://content.dropboxapi.com/2/files/download';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken,'Dropbox-API-Arg: {"path": "'.$path.'"}'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
// header('Content-type: application/pdf'); header('Content-Disposition: inline; filename="'.$description.'.pdf"'); 
echo $response;
?>
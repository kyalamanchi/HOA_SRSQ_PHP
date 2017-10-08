<?php
$hoaID = $_GET['hoaid'];
$email = $_GET['emails'];
$emails = explode(' ', $email);
foreach ($emails as $em) {
	$url  = "https://hoaboardtime.com/sendViaMandrill.php?hoaid=".$hoaID."&email=".$em;
	// $req = curl_init();
	// curl_setopt($req, CURLOPT_URL,$url);
	// curl_exec($req);
	echo $url;
}
?>
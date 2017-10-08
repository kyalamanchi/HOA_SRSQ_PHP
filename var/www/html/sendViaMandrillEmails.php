<?php
$hoaID = $_GET['hoaid'];
$email = $_GET['emails'];
$emails = explode(' ', $email);
foreach ($emails as $em) {
	$url  = "https://hoaboardtime.com/sendViaMandrill.php?hoaid=".$hoaID."&email=".$em;
	echo $url;
}
?>
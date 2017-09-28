<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
if ( $_GET['id'] == 1){


$message  = "Updating SRP Transactions";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateCurrentPaymentsSRP.php");
curl_exec($req);

$message  = "Updating SRP paymethods";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateHomePayMethodSRP.php");
curl_exec($req);

$message  = "Updating SRP deposits";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDeposits.php");
curl_exec($req);

$message  = "Updating SRP deposit transactions";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDepositsTransactions.php");
curl_exec($req);


$id = date('Y-m-d H:i:s');
$message  = "Done!!!";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

?>
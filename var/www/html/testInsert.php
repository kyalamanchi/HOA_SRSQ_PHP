<?php
$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateCurrentPaymentsSRP.php");
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
?>
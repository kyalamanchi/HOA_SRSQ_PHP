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
$message  = "Updating SRP paymethods";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$message  = "Updating SRP deposits";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$message  = "Updating SRP deposit transactions";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$id = date('Y-m-d H:i:s');
$message  = "Done!!!";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

?>
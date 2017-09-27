<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

if ( $_GET['id']; ){
$message  = $_GET['id'];
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

else {
  $message  = "Failed...HOA ID not found.";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

?>

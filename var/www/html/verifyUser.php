<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
if ( $_GET['id'] ){
$message  = $_GET['id'];
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);

if ( $row['cell_no'] ){
  $message = substr($row['cell_no'], -4);
  echo 'data: '.$message."\n\n";  
  ob_end_flush();
  flush();
}
else if ( $row['email'] ){
  $string = explode('@', $row['email']);
  $message = '@'.$string[1];
  echo 'data: '.$message."\n\n";  
  ob_end_flush();
  flush();
}
else {
  $message  = "Verification failed";
}


}
else {
  $message  = "Failed...HOA ID not found.";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

?>

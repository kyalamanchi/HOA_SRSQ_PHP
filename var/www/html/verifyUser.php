<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
if ( $_GET['id'] ){
$message  = $_GET['id'];
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);

if ( $row['cell_no'] ){
  $id = "";
  $id = $id.strlen($row['cell_no']);
  $id = $id." ";
  $length  = strlen($row['cell_no']);
  $id  = $id.str_repeat("*", $length-2);
  $id = $id.substr($row['cell_no'], -2);
  echo "id: $id\n";
  $message = "number";
  echo 'data: '.$message."\n\n";  
  ob_end_flush();
  flush();
}
else if ( $row['email'] ){
  $id = "";
  $id = $id.strlen($row['email']);
  $id = $id." ";
  $string = explode('@', $row['email']);
  $id = substr($string[0],0,2);
  $id = $id.str_repeat("*",strlen($string[0]-2))."@";
  $id = $id.substr($string[1], -6);
  $message = "email";
  echo "id: $id\n";
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

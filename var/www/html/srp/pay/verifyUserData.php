<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$connection = pg_connect("host=srsq-only.crsa3tdmtcll.ussrsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
if ( $_GET['id'] && $_GET['data']){
  $query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
  $queryResult = pg_query($query);
  $row = pg_fetch_assoc($queryResult);
  if ( $row['cell_no'] ){
      if ( !(strcmp($row['cell_no'], $_GET['data'])) ){
  
        $message  = "success";
      echo 'data: '.$message."\n\n";  
      ob_end_flush();
      flush();
        exit(0);
      }
  }
   if ( $row['email'] ){
      if ( !(strcmp($row['email'], $_GET['data'])) ){
        $message  = "success";
      echo 'data: '.$message."\n\n";  
      ob_end_flush();
      flush();
        exit(0);
      }
  }

  $message  = "failed";
      echo 'data: '.$message."\n\n";  
      ob_end_flush();
      flush();
  
}
else {
$message  = "failed";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

?>


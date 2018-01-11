<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
include 'includes/dbconn.php';
if ( $_GET['id'] && $_GET['data']){
  $query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
  $queryResult = pg_query($query);
  $row = pg_fetch_assoc($queryResult);
  if ( $row['cell_no'] ){
      $query2 = "SELECT  verification_code FROM verification_code_sent WHERE verification_code_type=1 AND hoa_id=".$_GET['id'];
      $query2Result = pg_query($query2);
      $row = pg_fetch_assoc($query2Result);
      $otp = base64_decode($row['verification_code']);
      if ( !(strcmp( $otp, $_GET['data'])) ){
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


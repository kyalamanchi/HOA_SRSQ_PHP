<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
if ( $_GET['id'] && $_GET['data']){
  $query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
  $queryResult = pg_query($query);
  $row = pg_fetch_assoc($queryResult);
  if ( ($row['cell_no'] == $_GET['data']) || ($row['email'] == $_GET['data']) ){
    echo "success";
    exit(0);
  }
  else {
    echo "failed";
    exit(0);
  }
}
else {
$message  = "failed";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}

?>


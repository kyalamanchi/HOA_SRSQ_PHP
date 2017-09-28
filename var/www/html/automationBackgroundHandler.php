<?php
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');

$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");

$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
if ( $_GET['id'] == 1){
//SRP UPDATION
$message  = "Updating SRP Transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateCurrentPaymentsSRP.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,1,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP paymethods...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateHomePayMethodSRP.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,8,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP deposits...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDeposits.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,2,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP deposit transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDepositsTransactions.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,3,'".date('Y-m-d H:i:s')."')";
pg_query($query);

//SRSQ UPDATION
$message  = "Updating SRSQ Transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateCurrentPaymentsSRSQ.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(2,1,1,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRSQ paymethods...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateHomePayMethodSRSQ.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(2,1,8,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRSQ deposits...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/communityDeposits.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(2,1,2,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRSQ deposit transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/communityDepositsTransactions.php");
curl_exec($req);

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(2,1,3,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$id = date('Y-m-d H:i:s');
$message  = "Done!!!";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

}

?>
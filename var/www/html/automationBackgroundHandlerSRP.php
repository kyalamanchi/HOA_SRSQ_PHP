<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');

$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

if ( isset($_GET['id'])){
if ( $_GET['id'] == 1){
//SRP UPDATION
$message  = "Updating SRP Transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateCurrentPaymentsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,1,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP paymethods...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateHomePayMethodSRP.php");
$message  = curl_exec($req);
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,8,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP deposits...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDeposits.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);


$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,2,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP deposit transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDepositsTransactions.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);


$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,3,'".date('Y-m-d H:i:s')."')";
pg_query($query);


}
else if ( $_GET['id'] == 2){

//SRP
$message  = "Updating SRP Agreements...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateAgreementsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,2,4,'".date('Y-m-d H:i:s')."')";
pg_query($query);


$message  = "Updating SRP Mega Sign Agreements...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateMegaSignAgreementsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,2,5,'".date('Y-m-d H:i:s')."')";
pg_query($query);


$message  = "Updating SRP Mega Sign Child Agreements...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateMegaSignChildAgreementsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,2,6,'".date('Y-m-d H:i:s')."')";
pg_query($query);


}

else if ( $_GET['id'] == 3){
$message  = "Please wait.....";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/allBillingStatementGeneration.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);
$id = date('Y-m-d H:i:s');
$message  = "Genereated and uploaded to Dropbox";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$id = date('Y-m-d H:i:s');
$message  = "Done!!!";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,3,7,'".date('Y-m-d H:i:s')."')";
pg_query($query);
}
else if ( $_GET['id'] == 4 ){
$message  = "Please wait.....";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$message  = "Updating email data...Please wait.....";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/mandrillUpdateStatsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);
$id = date('Y-m-d H:i:s');
$message  = "Done!!!";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"START_TIME\") VALUES(1,4,'".date('Y-m-d H:i:s')."')";
pg_query($query);

}
}
else {
	//SRP UPDATION
$message  = "Updating SRP Transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateCurrentPaymentsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,1,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP paymethods... ";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateHomePayMethodSRP.php");
$message  = curl_exec($req);
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,8,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP deposits...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDeposits.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);


$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,2,'".date('Y-m-d H:i:s')."')";
pg_query($query);

$message  = "Updating SRP deposit transactions...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/srpcommunityDepositsTransactions.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);


$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,1,3,'".date('Y-m-d H:i:s')."')";
pg_query($query);



//SRP
$message  = "Updating SRP Agreements...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateAgreementsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,2,4,'".date('Y-m-d H:i:s')."')";
pg_query($query);


$message  = "Updating SRP Mega Sign Agreements...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateMegaSignAgreementsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,2,5,'".date('Y-m-d H:i:s')."')";
pg_query($query);


$message  = "Updating SRP Mega Sign Child Agreements...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/updateMegaSignChildAgreementsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message  = curl_exec($req);
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();

$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,2,6,'".date('Y-m-d H:i:s')."')";
pg_query($query);


$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/allBillingStatementGeneration.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);
$id = date('Y-m-d H:i:s');
$message  = "Genereated and uploaded to Dropbox";
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$message  = "Done!!!";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"JOB_SUB_CATEGORY_ID\",\"START_TIME\") VALUES(1,3,7,'".date('Y-m-d H:i:s')."')";
pg_query($query);


$message  = "Please wait.....";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$message  = "Updating email data...Please wait.....";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/mandrillUpdateStatsSRP.php");
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);
$message  = "Done!!!";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"START_TIME\") VALUES(1,4,'".date('Y-m-d H:i:s')."')";
pg_query($query);

}

?>
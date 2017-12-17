<?php

include 'password.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");



$query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['hoa_id'];

$queryResult = pg_query($query);

$hoaRow = pg_fetch_assoc($queryResult);

$homeID = $hoaRow['home_id'];


$currentPaymentsQuery = "SELECT SUM(AMOUNT) FROM CURRENT_PAYMENTS WHERE HOME_ID=".$homeID;
$currentPaymentsQueryResult = pg_query($currentPaymentsQuery);
$row = pg_fetch_assoc($currentPaymentsQueryResult);

$currentPaymentsTotal = $row['sum'];



$currentChargesQuery = "SELECT SUM(AMOUNT) FROM CURRENT_CHARGES WHERE HOME_ID=".$homeID;
$currentChargesQueryResult = pg_query($currentChargesQuery);

$row = pg_fetch_assoc($currentChargesQueryResult);

$currentChargesTotal  = $row['sum'];



$balance = $currentChargesTotal - $currentPaymentsTotal;




$personQuery = "SELECT * FROM PERSON WHERE HOA_ID=".$_GET['hoa_id']."";
$personQueryResult  = pg_query($personQuery);
$count = 0;

$emailQuery = "SELECT COUNT(*) FROM COMMUNITY_EMAILS_SENT WHERE TO_EMAIL='";

$smsQuery = "SELECT COUNT(*) FROM SMS_SENT WHERE PERSON_ID=";

while ($personRow = pg_fetch_assoc($personQueryResult)) {

	if ( $count == 0 ){
		if (isset($personRow['email'])){
		$emailQuery = $emailQuery.$personRow['email']."'";
		$count  = $count + 1;
		$smsQuery = $smsQuery.$personRow['id'];
		}

	}
	else {
		$emailQuery = $emailQuery." OR TO_EMAIL='".$personRow['email']."'";
		$smsQuery = $smsQuery." OR PERSON_ID=".$personRow['id'];
	}
}

print_r($emailQuery);


print_r(nl2br("\n\n"));

print_r($smsQuery);




?>
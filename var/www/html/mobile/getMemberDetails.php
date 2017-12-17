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
		$count  = $count + 1;
		$emailQuery = $emailQuery." OR TO_EMAIL='".$personRow['email']."'";
		$smsQuery = $smsQuery." OR PERSON_ID=".$personRow['id'];
	}
}

$emailQueryResult  = pg_query($emailQuery) ;

$smsQueryResult = pg_query($smsQuery);

$emailQueryResultResponse = pg_fetch_assoc($emailQueryResult);

$smsQueryResultResponse = pg_fetch_assoc($smsQueryResult);

$emailsCount =  $emailQueryResultResponse['count'];

$smsCount = $smsQueryResultResponse['count'];

print_r($emailsCount);
print_r(nl2br("\n\n"));
print_r($smsCount);

$memberRatingQuery = "SELECT MEMBER_RATING FROM community_campaigns_lists_members WHERE email_address  = (SELECT EMAIL FROM HOAID WHERE HOA_ID = 1259)";
$memberRatingQueryResult = pg_query($memberRatingQuery);

$memberRow  = pg_fetch_assoc($memberRatingQueryResult);

$memberRating = $memberRow['member_rating'];

$memberData = array();

$memberData["user_balance"] =  $balance;

$memberData["user_rating"] = $memberRating;

$memberData["user_emails_count"] = $emailsCount;

$memberData["user_sms_count"] = $smsCount;

$memberData["user_persons"] = $count;


$response = array();

$response["response"] = "success";

$response["member_data"] = $memberData;






?>
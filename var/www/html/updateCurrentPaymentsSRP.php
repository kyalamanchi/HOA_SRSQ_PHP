<?php
date_default_timezone_set('America/Los_Angeles');
$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
$query  = "SELECT * FROM current_payments WHERE community_id=1 AND  date_part('year',last_updated_on) = EXTRACT(year FROM CURRENT_DATE) AND date_part('month',last_updated_on) = EXTRACT(month FROM CURRENT_DATE)";
$homeIDQuery = "SELECT * FROM hoaid WHERE community_id=1";
$hoIDresult = pg_query($homeIDQuery);
$hoaIDSArray = array();
while( $hoarow = pg_fetch_assoc($hoIDresult)){
	$hoaIDSArray[$hoarow['hoa_id']] =  $hoarow['home_id'];
}
$result = pg_query($query);
$bankTransactionsIDSArray = array(); 
while ($row = pg_fetch_assoc($result)) {
	$bankTransactionsIDSArray[$row['bank_transaction_id']] = $row['payment_status_id'];
}
$startDate = date('Y-m-01');
$failedTransactionIDS = array();
$url = 'https://api.forte.net/v3/organizations/org_335357/locations/loc_193771/transactions?filter=start_received_date%20eq%20';
$url = $url.$startDate;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-forte-auth-organization-id: org_335357','authorization: Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
if ($result->number_results <= 1000){
$url = 'https://api.forte.net/v3/organizations/org_335357/locations/loc_193771/transactions?filter=start_received_date%20eq%20';
$url = $url.$startDate.'&page_size='.$result->number_results;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-forte-auth-organization-id: org_335357','authorization: Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
foreach ($result->results as $transaction) {
	if ( $bankTransactionsIDSArray[$transaction->transaction_id] ){

		if ( $transaction->status != 'voided'){
		if ( $transaction->status == 'funded' ){
			$paymentStatusIDUpdate = 1;
		}
		else if ( $transaction->status == 'settling' ){
			$paymentStatusIDUpdate = 8;
		}
		else if ( $transaction->status == 'approved' ){
			$paymentStatusIDUpdate = 6;
		}
		else if ( $transaction->status == 'ready' ){
			$paymentStatusIDUpdate = 10;
		}
		$val = $val+1;
		$updateQuery = "UPDATE current_payments SET payment_status_id=".$paymentStatusIDUpdate.",last_updated_on='".date("Y-m-d")."' WHERE bank_transaction_id='".$transaction->transaction_id."'";
		print_r("Count is ".$val." ".$updateQuery.nl2br("\n"));
		pg_query($updateQuery);
	}

	}
	else{
	if ( $transaction->status != 'voided'){
		if ( $transaction->customer_id ){
			$hoaID = $transaction->customer_id;
		}
		else if ( $transaction->order_number){
			$hoaID = $transaction->order_number;
		}
		else if ( $transaction->reference_id ){
			$hoaID = $transaction->reference_id;
		}
		if ( $transaction->status == 'funded' ){
			$paymentStatusID = 1;
		}
		else if ( $transaction->status == 'settling' ){
			$paymentStatusID = 8;
		}
		else if ( $transaction->status == 'approved' ){
			$paymentStatusID = 6;
		}
		else if ( $transaction->status == 'ready' ){
			$paymentStatusID = 10;
		}
		if ( $hoaID ){
		$paymentID = $hoaID.$hoaIDSArray[$hoaID];
		$insertQuery = "INSERT INTO current_payments (\"payment_id\",\"home_id\",\"payment_type_id\",\"amount\",\"process_date\",\"document_num\",\"community_id\",\"hoa_id\",\"referred_to_attorney\",\"payment_status_id\",\"transaction_balance\",\"last_updated_on\",\"email_notification_sent\",\"updated_by\",\"bank_transaction_id\") VALUES(".$paymentID.",".$hoaIDSArray[$hoaID].",1,".$transaction->authorization_amount.",'".$transaction->received_date."',".$transaction->response->authorization_code.",1,".$hoaID.",'FALSE',".$paymentStatusID.",0,'".date("Y-m-d")."','TRUE',401,'".$transaction->transaction_id."')";
		
		pg_query($insertQuery);
		print_r("Inserting new record ".$transaction->transaction_id.nl2br("\n").$insertQuery.nl2br("\n"));
	}
	else{
		$failedTransactionIDS[$transaction->transaction_id] = 0;
	}
	}
	}
}
if (!empty($failedTransactionIDS)){
	foreach ($failedTransactionIDS as $key => $value) {
		print_r("Transaction ID is".$key.nl2br("\n"));
		print_r("Checking echeck object......".nl2br("\n"));
		$transactionURL = "https://api.forte.net/v3/transactions/";
		$transactionURL = $transactionURL.$key;
		$ch = curl_init($transactionURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-forte-auth-organization-id: org_335357','authorization: Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$transactionresult = curl_exec($ch);
		curl_close($ch);
		$transactionresult = json_decode($transactionresult);
		$paymentStatusID = 0;
		if ( $transactionresult->status == 'funded' || $transactionresult->status == 'FUNDED'){
			$paymentStatusID = 1;
		}
		else if ( $transactionresult->status == 'settling' || $transactionresult->status == 'SETTLING' ){
			$paymentStatusID = 8;
		}
		else if ( $transactionresult->status == 'approved' || $transactionresult->status == 'APPROVED'){
			$paymentStatusID = 6;
		}
		else if ( $transactionresult->status == 'ready'){
			$paymentStatusID = 10;
		}
		if ( is_numeric($transactionresult->echeck->item_description) ){
			print_r("Found hoa id in echeck object");
			$hoaID = $transactionresult->echeck->item_description;
			$paymentID = $hoaID.$hoaIDSArray[$hoaID];
			$insertQuery = "INSERT INTO current_payments (\"payment_id\",\"home_id\",\"payment_type_id\",\"amount\",\"process_date\",\"document_num\",\"community_id\",\"hoa_id\",\"referred_to_attorney\",\"payment_status_id\",\"transaction_balance\",\"last_updated_on\",\"email_notification_sent\",\"updated_by\",\"bank_transaction_id\") VALUES(".$paymentID.",".$hoaIDSArray[$hoaID].",1,".$transactionresult->authorization_amount.",'".$transactionresult->received_date."',".$transactionresult->response->authorization_code.",1,".$hoaID.",'FALSE',".$paymentStatusID.",0,'".date("Y-m-d")."','TRUE',401,'".$transactionresult->transaction_id."')";
			pg_query($insertQuery);
			print_r("Inserting new record ".$transaction->transaction_id.nl2br("\n"));
		}
	}
}
else {
}
}
else {
	print_r("Greater than 1000");
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
        $scheduleUpdateQuery = "INSERT INTO SCHEDULED_JOBS(\"JOB_TITLE\",\"START_TIME\",\"RUN_BY\",\"IP_ADDRESS\") VALUES('CURRENT PAYMENTS SRP','".date('Y-m-d H:i:s')."','MANUAL','".get_client_ip()."')";
        pg_query($scheduleUpdateQuery);
?>
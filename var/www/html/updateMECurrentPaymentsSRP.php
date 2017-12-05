<?php
date_default_timezone_set('America/Los_Angeles');
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
$query = "SELECT * FROM current_payments WHERE payment_status_id !=1 AND community_id = 1 AND last_updated_on < '".date('Y-m-d')."' AND bank_transaction_id IS NOT NULL";
$queryResult = pg_query($query);
while ($row = pg_fetch_assoc($queryResult)) {
$url = 'https://api.forte.net/v3/organizations/org_335357/locations/loc_193771/transactions/';
$url = $url.$row['bank_transaction_id'];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','x-forte-auth-organization-id: org_335357','authorization: Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
$result = json_decode($result);
if ( $result->status != 'voided'){
		if ( $result->status == 'funded' ){
			$paymentStatusIDUpdate = 1;
		}
		else if ( $result->status == 'settling' ){
			$paymentStatusIDUpdate = 8;
			$updateHPM = 1;
		}
		else if ( $result->status == 'approved' ){
			$paymentStatusIDUpdate = 6;
			$updateHPM = 1;
		}
		else if ( $result->status == 'ready' ){
			$paymentStatusIDUpdate = 10;
			$updateHPM = 1;
		}
		$updateStatus = "UPDATE current_payments SET payment_status_id=$paymentStatusIDUpdate , last_updated_on='".date('Y-m-d')."' , updated_by = 401 WHERE id=".$row['id'];
		pg_query($updateStatus);
}
}
?>
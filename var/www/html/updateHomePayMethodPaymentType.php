<?php
date_default_timezone_set('America/Los_Angeles');
$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
if ( $connection ){
	$query = "SELECT A.HOA_ID FROM  (SELECT PROCESS_DATE,HOA_ID FROM CURRENT_PAYMENTS CP1 WHERE PROCESS_DATE = ( SELECT MAX(PROCESS_DATE) FROM CURRENT_PAYMENTS WHERE CP1.HOA_ID = CURRENT_PAYMENTS.HOA_ID ) ORDER BY PROCESS_DATE DESC) AS A ORDER BY HOA_ID";
	$qr = pg_query($query);
	while ($row = pg_fetch_assoc($qr)) {
		print_r($row['hoa_id']);
		print_r(nl2br("\n"));
	}
}
?>
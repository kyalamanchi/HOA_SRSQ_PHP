<?php
date_default_timezone_set('America/Los_Angeles');
$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
$query = "SELECT * FROM COMMUNITY_STATEMENTS_MAILED WHERE ORDER_ID IS NOT NULL AND INVOICE_TOTAL IS NULL";
$queryResult = pg_query($query);
while ($row = pg_fetch_assoc($queryResult)) {
	$req = curl_init();
curl_setopt($req, CURLOPT_URL,"http://southdata.us-west-2.elasticbeanstalk.com/GetInvoiceDetails.aspx?id=".$row['order_id']);
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
$message = curl_exec($req);

$message = explode('@', $message);
if ( $message[0] != "Failed." ){
$updateQuery = "UPDATE COMMUNITY_STATEMENTS_MAILED SET INVOICE_ID=".$message[1].",invoice_total=".$message[5].",invoice_date='".date('Y-m-d',strtotime($message[2]))."',invoice_unit_price=".$message[4].",quantity=".$message[3].",updated_on='".date('Y-m-d H:i:s')."',updated_by=401 WHERE statement_id=".$row['statement_id'];
pg_query($updateQuery);
}
else {
	echo $row['statement_id'];
	print_r(nl2br("\n\n"));
}

}
?>
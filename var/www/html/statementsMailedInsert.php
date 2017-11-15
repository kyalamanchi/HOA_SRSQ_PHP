<?php
$connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
if ( $connection){
    $query  = "SELECT HOME_ID,COMMUNITY_ID FROM HOAID WHERE HOA_ID = ".$_GET['id'];
    $orderNumber = $_GET['orderID'];
    print_r($query);
    print_r(nl2br("\n"));
    $queryResult = pg_query($query);
    $row = pg_fetch_assoc($queryResult);
    $homeID = $row['home_id'];
    $communityID = $row['community_id'];
    $query = "INSERT INTO COMMUNITY_STATEMENTS_MAILED(\"home_id\",\"hoa_id\",\"date_sent\",\"community_id\",\"statement_type_id\",\"notification_type\",\"order_id\",\"invoice_id\",\"updated_on\",\"updated_by\") VALUES(".$homeID.",".$_GET['id'].",'".date('Y-m-d')."',".$communityID.",2,4,".$orderNumber.",".$orderNumber.",'".date('Y-m-d')."',401)";
    pg_query($query);
    
    print_r($query);
}
?>
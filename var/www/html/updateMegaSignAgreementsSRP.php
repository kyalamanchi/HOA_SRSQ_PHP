<?php
date_default_timezone_set('America/Los_Angeles');
$dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$pullAgreementsQuery = "SELECT mega_sign_id FROM community_mega_sign_agreements WHERE COMMUNITY_ID = 1";
$pullAgreementsQueryResult = pg_query($pullAgreementsQuery);
$agreementIDS = array();
while ($row = pg_fetch_row($pullAgreementsQueryResult)) {
    $agreementIDS[$row[0]] = 1;
}
 $url  = 'https://api.na1.echosign.com:443/api/rest/v5/megaSigns';
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Token:3AAABLblqZhBWF9BYTpVk2qiLdux9HoMp6296MnQhdvuw5sR-wRF84ZkKs3rUG6GDbSI8MVYE2-Kgabac7qiVa1FqAytq957r'));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 $result = curl_exec($ch);
 $result = json_decode($result);

 foreach ($result->megaSignList as $agreement) {
     if ( $agreementIDS[$agreement->megaSignId] ){
     	$updateQuery = "UPDATE community_mega_sign_agreements SET STATUS='".$agreement->status."', UPDATED_ON='".date('Y-m-d H:i:s')."' WHERE mega_sign_id='".$agreement->megaSignId."'";
        if (!pg_query($updateQuery) ){
        		print_r($updateQuery.nl2br("\n"));
        }
     }
     else {
     	$insertQuery = "INSERT INTO community_mega_sign_agreements(\"community_id\",\"agreement_name\",\"agreement_date\",\"mega_sign_id\",\"status\",\"updated_on\") VALUES(1,'".$agreement->name."','".date('Y-m-d H:i:s',strtotime($agreement->displayDate))."','".$agreement->megaSignId."','".$agreement->status."','".$date('Y-m-d H:i:s')."')";
        if (!pg_query($insertQuery)){
        	print_r($insertQuery.nl2br("\n"));
        }
 }
}

?>
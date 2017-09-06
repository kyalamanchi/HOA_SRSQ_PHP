<?php
date_default_timezone_set('America/Los_Angeles');
$dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$pullAgreementsQuery = "SELECT mega_sign_id FROM community_mega_sign_agreements WHERE COMMUNITY_ID = 2";
$pullAgreementsQueryResult = pg_query($pullAgreementsQuery);
$agreementIDS = array();
while ($row = pg_fetch_row($pullAgreementsQueryResult)) {
    $agreementIDS[$row[0]] = 1;
}
 $url  = 'https://api.na1.echosign.com:443/api/rest/v5/megaSigns';
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Token:3AAABLblqZhBbuoGJoQZXIMhISUIAnh7R_qmzGgn_COsBf1G0kXyDFiaXxE-oM8ZMaL1LPybdYz1U2gYXszLLzpLuenZ3Ojfm'));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 $result = curl_exec($ch);
 $result = json_decode($result);

 foreach ($result->megaSignList as $agreement) {
     if ( $agreementIDS[$agreement->megaSignId] ){
        pg_query("UPDATE community_mega_sign_agreements SET STATUS='".$agreement->status."', UPDATED_ON='".date('Y-m-d H:i:s')."' WHERE mega_sign_id='".$agreement->megaSignId."'");
     }
     else {
        if (pg_query("INSERT INTO community_mega_sign_agreements(\"community_id\",\"agreement_name\",\"agreement_date\",\"mega_sign_id\",\"status\",\"updated_on\") VALUES(2,'".$agreement->name."','".date('Y-m-d H:i:s',strtotime($agreement->displayDate))."','".$agreement->megaSignId."','".$agreement->status."','".$date('Y-m-d H:i:s')."')")){

        }
        else {
            print_r("INSERT INTO community_mega_sign_agreements(\"community_id\",\"agreement_name\",\"agreement_date\",\"mega_sign_id\",\"status\",\"updated_on\") VALUES(2,'".$agreement->name."','".date('Y-m-d H:i:s',strtotime($agreement->displayDate))."','".$agreement->megaSignId."','".$agreement->status."','".$date('Y-m-d H:i:s')."')");
        }
     }

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
        $scheduleUpdateQuery = "INSERT INTO SCHEDULED_JOBS(\"JOB_TITLE\",\"START_TIME\",\"RUN_BY\",\"IP_ADDRESS\") VALUES('MEGA SIGN AGREEMENTS SRP','".date('Y-m-d H:i:s')."','MANUAL','".get_client_ip()."')";
        pg_query($scheduleUpdateQuery);
 pg_close();
?>
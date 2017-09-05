<?php
date_default_timezone_set('America/Los_Angeles');
$dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$pullAgreementsQuery = "SELECT agreement_id FROM community_sign_agreements WHERE COMMUNITY_ID = 1";
$pullAgreementsQueryResult = pg_query($pullAgreementsQuery);
$agreementIDS = array();
if($pullAgreementsQueryResult){
while ($row = pg_fetch_row($pullAgreementsQueryResult)) {
    $agreementIDS[$row[0]] = 1;
}
}

 $url  = 'https://api.na1.echosign.com:443/api/rest/v5/agreements';
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Access-Token:3AAABLblqZhBWF9BYTpVk2qiLdux9HoMp6296MnQhdvuw5sR-wRF84ZkKs3rUG6GDbSI8MVYE2-Kgabac7qiVa1FqAytq957r'));
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 $result = curl_exec($ch);
 $result = json_decode($result);
foreach ($result->userAgreementList as $agreement) {
	if ( $agreementIDS[$agreement->agreementId] ){
		
		$updateQuery = "UPDATE COMMUNITY_SIGN_AGREEMENTS SET AGREEMENT_STATUS='".$agreement->status."',LAST_UPDATED='".date('Y-m-d H:i:s')."' WHERE agreement_id='".$agreement->agreementId."'";
		if (!pg_query($updateQuery)){
				print_r("Failed to update".nl2br("\n"));
		}

	}
	else {
			$sendToCount = 0;
			$sendToNames = array();
			foreach ($agreement->displayUserSetInfos as $user) {
				foreach ($user->displayUserSetMemberInfos as $userInfo) {
					$sendToCount = $sendToCount + 1;
					$sendToNames[$userInfo->email] = 1;
				}
			}
		foreach ($sendToNames as $key => $value) {
				$insertQuery  = "INSERT INTO COMMUNITY_SIGN_AGREEMENTS(\"community_id\",\"document_to\",\"document_type\",\"agreement_id\",\"create_date\",\"send_date\",\"agreement_status\",\"agreement_name\",\"sent_to_count\",\"last_updated\") VALUES(1,'".$key."',1,'".$agreement->agreementId."','".$agreement->displayDate."','".$agreement->displayDate."','".$agreement->status."','".$agreement->name."',".$sendToCount.",'".date('Y-m-d H:i:s')."')";
				if (pg_query($insertQuery)){

				}
				else{
					print_r("Failed".$insertQuery);
				}
		}
	}
}
 pg_close();
?>
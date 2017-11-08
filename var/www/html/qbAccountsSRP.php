<?php
date_default_timezone_set('America/Los_Angeles');
setlocale(LC_MONETARY, 'en_US');
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
$ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/query');
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'POST');
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept:application/json','Content-Type:application/text','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1510105283",oauth_nonce="ukGoDzEcZT3",oauth_version="1.0",oauth_signature="84LMS3Ts2kQIozMO2MtnALzxrsY%3D"'));
   curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from Account MAXRESULTS 1000");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   $result = curl_exec($ch);
   $result = json_decode($result);
   foreach ($result->QueryResponse->Account as $account) {
       
        if ( strtolower($account->Classification) == 'revenue'){
            $classification  = 3;
        }
        else if ( strtolower($account->Classification) == 'liability'){
            $classification = 1;
        }
        else  if ( strtolower($account->Classification) == 'asset' ){
            $classification = 4;
        }
        else if ( strtolower($account->Classification) == 'expense' ) {
            $classification = 2;
        }
        else if ( strtolower($account->Classification) == 'equity' ){
            $classification = 5;
        }
        else {
            echo "failed cannot find classification";
            exit(0);
        }

        if ( $account->Active == 'true' ){
            $stat = 'true';
        }
        else {
            $stat = 'false';
        }


        if ( isset($account->ParentRef->value) ){
       $query = "INSERT INTO community_accounts (community_id,category,is_active,updated_on,updated_by,account_type,display_name,display_desc,is_sub_account,parent_account,account_sub_type,qb_id) VALUES(1,$classification,'".$stat."','".date('Y-m-d H:i:s')."',401,'".$account->AccountType."','".$account->Name."','".$account->Description."','true',(SELECT ID FROM community_accounts WHERE COMMUNITY_ID = 2 AND qb_id=".$account->ParentRef->value."),'".$account->AccountSubType."',".$account->Id.") ON CONFLICT (community_id,qb_id) DO UPDATE SET updated_on='".date('Y-m-d H:i:s')."',updated_by=401";
       pg_query($query);
        print_r(nl2br("\n\n\n"));
        }
        else{
             $query = "INSERT INTO community_accounts (community_id,category,is_active,updated_on,updated_by,account_type,display_name,display_desc,is_sub_account,account_sub_type,qb_id) VALUES(1,$classification,'".$stat."','".date('Y-m-d H:i:s')."',401,'".$account->AccountType."','".$account->Name."','".$account->Description."','false','".$account->AccountSubType."',".$account->Id.") ON CONFLICT (community_id,qb_id) DO UPDATE SET updated_on='".date('Y-m-d H:i:s')."',updated_by=401";
             pg_query($query);
            print_r(nl2br("\n\n\n"));
        }

   }
?>

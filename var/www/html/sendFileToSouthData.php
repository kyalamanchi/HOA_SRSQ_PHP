<?php
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
function getFileCount($file){
        if(file_exists($file)) {
            if($handle = @fopen($file, "rb")) {
                $count = 0;
                $i=0;
                while (!feof($handle)) {
                    if($i > 0) {
                        $contents .= fread($handle,8152);
                    }
                    else {
                          $contents = fread($handle, 1000);
                        if(preg_match("/\/N\s+([0-9]+)/", $contents, $found)) {
                            return $found[1];
                        }
                    }
                    $i++;
                }
                fclose($handle);             
                if(preg_match_all("/\/Type\s*\/Pages\s*.*\s*\/Count\s+([0-9]+)/", $contents, $capture, PREG_SET_ORDER)) {
                    foreach($capture as $c) {
                        if($c[1] > $count)
                            $count = $c[1];
                    }
                    return $count;            
                }
            }
        }
        return 0;

}




$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

$handler = fopen($parseJSON[0]->file_name, "w");
fwrite($handler, base64_decode($parseJSON[0]->file_data));
fclose($handler);


    $url = 'https://content.dropboxapi.com/2/files/upload';
    $pdfFileContent = file_get_contents($parseJSON[0]->file_name);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer xCCkLEFieJAAAAAAAAABUHpqfAcHsr24243JwXKp_A6jK_cKpN-9IFdm8QxGBjx9','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/'.$parseJSON[0]->file_name.'","mode": "overwrite","autorename": false,"mute": false}'));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $pdfFileContent); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $number = getFileCount($parseJSON[0]->file_name);

    if ( isset($response->error_summary) ){
        echo "An error occured. Failed to upload file.";
    }
    else {

    //Creating tab file
    $hoaID = $parseJSON[0]->hoa_id;

    $query = "SELECT * FROM HOAID WHERE HOA_ID=".$hoaID;
    $queryResult = pg_query($query);

    $row = pg_fetch_assoc($queryResult);

    $name = $row['firstname'].' '.$row['lastname'];


    if ( $parseJSON[0]->address == 1){
        
        echo $name;

        $addressQuery = "SELECT * FROM HOMEID WHERE HOME_ID=".$row['home_id'];
        $addressQueryResult = pg_query($addressQuery);
        $addressQueryResult = pg_fetch_assoc($addressQueryResult);
        $address1 = $addressQueryResult['address1'];
        $address2 = $addressQueryResult['address2'];

        echo $addressQuery;


        $cityQuery = "SELECT CITY_NAME FROM CITY WHERE CITY_ID=".$addressQueryResult['city_id'];
        $cityQueryResult = pg_query($cityQuery);
        $cityQueryResult = pg_fetch_assoc($cityQueryResult);
        $cityName = $cityQueryResult['city_name'];

        $stateQuery = "SELECT STATE_CODE FROM STATE WHERE STATE_ID=".$addressQueryResult['state_id'];
        $stateQueryResult = pg_query($stateQuery);
        $stateQueryResult2 = pg_fetch_assoc($stateQueryResult);
        $personStateName = $stateQueryResult2['state_code'];

        $zipQuery = "SELECT ZIP_CODE FROM ZIP WHERE ZIP_ID=".$addressQueryResult['zip_id'];
        $zipQueryResult = pg_query($zipQuery);
        $zipQueryResult = pg_fetch_assoc($zipQueryResult);
        $zipCode = $zipQueryResult['zip_code'];


        $communityQuery = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$addressQueryResult['community_id'];
        $communityQueryResult = pg_query($communityQuery);
        $communityQueryResult = pg_fetch_assoc($communityQueryResult);

        $communityLegalName = $communityQueryResult['legal_name'];

        $communityMailingAddress = $communityQueryResult['mailing_address'];

        $communityMailingCity = $communityQueryResult['mailing_addr_city'];
        $communityMailingState = $communityQueryResult['mailing_addr_state'];
        $communityMailingZip = $communityQueryResult['mailing_addr_zip'];


        $communityCityQuery = "SELECT CITY_NAME FROM CITY WHERE CITY_ID=".$communityMailingCity;
        $communityCityQuery = pg_query($communityCityQuery);
        $communityCityQuery = pg_fetch_assoc($communityCityQuery);
        $communityCityName = $communityCityQuery['city_name'];

        $communityStateQuery = "SELECT STATE_CODE FROM STATE WHERE STATE_ID=".$communityMailingState;
        $communityStateQueryResult = pg_query($communityStateQuery);
        $communityStateName = pg_fetch_assoc($communityStateQueryResult);

        $communityStateName = $communityStateName['state_code'];

        $communityZipQuery = "SELECT ZIP_CODE FROM ZIP WHERE ZIP_ID=".$communityMailingZip;
        $communityZipQueryResult = pg_query($communityZipQuery);
        $communityZipCode = pg_fetch_assoc($communityZipQueryResult)['zip_code'];


        $handler = fopen('data.tab', 'w');
        fwrite($handler, "1"."\t".$name."\t".$address1." ".$address2."\t".$cityName." ".$personStateName." ".$zipCode."\t\t\t1\t".$number."\t".$parseJSON[0]->file_name."\t".$communityMailingAddress."\t".$communityCityName." ".$communityStateName." ".$communityZipCode."\t\t\t".$communityLegalName);
        fclose($handler);


        $url = 'https://content.dropboxapi.com/2/files/upload';
        $pdfFileContent = file_get_contents("data.tab");
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer xCCkLEFieJAAAAAAAAABUHpqfAcHsr24243JwXKp_A6jK_cKpN-9IFdm8QxGBjx9','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/data.tab","mode": "overwrite","autorename": false,"mute": false}'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $pdfFileContent); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);






    }
    else if ( $parseJSON[0]->address == 2 ){


        $addressQuery = "SELECT * FROM HOME_MAILING_ADDRESS WHERE HOME_ID=".$row['home_id'];
        echo $addressQuery;
        $addressQueryResult = pg_query($addressQuery);
        $addressQueryResult = pg_fetch_assoc($addressQueryResult);
        $address1 = $addressQueryResult['address1'];
        $address2 = $addressQueryResult['address2'];

        $cityQuery = "SELECT CITY_NAME FROM CITY WHERE CITY_ID=".$addressQueryResult['city_id'];
        $cityQueryResult = pg_query($cityQuery);
        $cityQueryResult = pg_fetch_assoc($cityQueryResult);
        $cityName = $cityQueryResult['city_name'];  

        if ( !($cityName) ){
            echo "Address incomplete. Please update address first";
            exit(0);
        }


        $stateQuery = "SELECT STATE_CODE FROM STATE WHERE STATE_ID=".$addressQueryResult['state_id'];
        $stateQueryResult = pg_query($stateQuery);
        $stateQueryResult = pg_fetch_assoc($stateQueryResult);
        $stateName = $stateQueryResult['state_code'];

        if ( !($stateName) ){
            echo "Address incomplete. Please update address first";
            exit(0);
        }

        $zipQuery = "SELECT ZIP_CODE FROM ZIP WHERE ZIP_ID=".$addressQueryResult['zip_id'];
        $zipQueryResult = pg_query($zipQuery);
        $zipQueryResult = pg_fetch_assoc($zipQueryResult);
        $zipCode = $zipQueryResult['zip_code'];

        if ( !($zipCode) ){
            echo "Address incomplete. Please update address first";
            exit(0);
        }

        $communityQuery = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$addressQueryResult['community_id'];
        $communityQueryResult = pg_query($communityQuery);
        $communityQueryResult = pg_fetch_assoc($communityQueryResult);

        $communityLegalName = $communityQueryResult['legal_name'];

        $communityMailingAddress = $communityQueryResult['mailing_address'];

        $communityMailingCity = $communityQueryResult['mailing_addr_city'];
        $communityMailingState = $communityQueryResult['mailing_addr_state'];
        $communityMailingZip = $communityQueryResult['mailing_addr_zip'];


        $communityCityQuery = "SELECT CITY_NAME FROM CITY WHERE CITY_ID=".$communityMailingCity;
        $communityCityQuery = pg_query($communityCityQuery);
        $communityCityQuery = pg_fetch_assoc($communityCityQuery);
        $communityCityName = $communityCityQuery['city_name'];

        $communityStateQuery = "SELECT STATE_CODE FROM STATE WHERE STATE_ID=".$communityMailingState;
        $communityStateQueryResult = pg_query($communityStateQuery);
        $communityStateName = pg_fetch_assoc($communityStateQueryResult)['state_code'];

        $communityZipQuery = "SELECT ZIP_CODE FROM ZIP WHERE ZIP_ID=".$communityMailingZip;
        $communityZipQueryResult = pg_query($communityZipQuery);
        $communityZipCode = pg_fetch_assoc($communityZipQueryResult)['zip_code'];


        $handler = fopen('data.tab', 'w');
        fwrite($handler, "1"."\t".$name."\t".$address1." ".$address2."\t".$cityName." ".$stateName." ".$zipCode."\t\t\t1\t".$number."\t".$parseJSON[0]->file_name."\t".$communityMailingAddress."\t".$communityCityName." ".$communityStateName." ".$communityZipCode."\t\t\t".$communityLegalName);
        fclose($handler);

    }


    }
    




//Deleting created file
unlink($parseJSON[0]->file_name);
?>
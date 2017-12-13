<?php

			date_default_timezone_set('America/Los_Angeles');
			$data = file_get_contents('php://input');
			$parsJSON = json_decode($data);
			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

            $hoaID = $parsJSON[0]->hoa_id;

            $fileID = $parsJSON[0]->pdf_id;


            //Download file from dropbox

            $accessToken = 'n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB';
            $url = 'https://content.dropboxapi.com/2/files/download';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$accessToken,'Dropbox-API-Arg: {"path": "'.$fileID.'"}'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch);
            
            $response23 = json_decode($response);

            if ( ($response23->error_summary)){
                echo "An error occured.";
            }

            else {
                $fileData = base64_decode($response);

                $query = "SELECT * FROM HOAID WHERE HOA_ID=".$hoaID;
                $queryResult = pg_query($query);

                $row = pg_fetch_assoc($queryResult);

                $communityID = $row['community_id'];

                $cquery  = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$communityID;

                $cqueryResult = pg_query($cquery);

                $row23 = pg_fetch_assoc($cqueryResult);

                echo $row23['email'];

                echo $row23['legal_name'];

                echo $row23['community_code'];

                
            }



            // $req = curl_init();
            // curl_setopt($req, CURLOPT_URL,$url);
            // curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
            // if(curl_exec($req) === false)
            // {
            //     $message =  "An error occured.";
            //     echo $message;
            //     exit(0);
            // }
            // else 
            // {   
            //     $message = "File uploaded to South Data.";
            //     echo $message;       
            // }       
            // $query = "INSERT INTO files_sent(hoa_id,file_tech_id,sent_date,file_name) VALUES(".$parsJSON[0]->hoa_id.",'".$parsJSON[0]->zip_id."','".date('Y-m-d H:i:s')."','Inspection Notice')";
            // pg_query($query);
?>
<?php

			date_default_timezone_set('America/Los_Angeles');
			$data = file_get_contents('php://input');
			$parsJSON = json_decode($data);
			pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

            $hoaID = $parsJSON[0]->hoa_id;

            $fileID = $parsJSON[0]->pdf_id;

            echo "An error occured.";

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
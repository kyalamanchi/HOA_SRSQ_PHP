<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$name = $_POST['name'];
	$hoa_id = $_POST['hoa_id'];
	$ocell_no = $_POST['ocell_no'];
	$community_id = $_POST['community_id'];
	$confirm_cell_no = $_POST['confirm_cell_no'];

	if($confirm_cell_no == "")
		echo "Please enter your phone number";
	else if($ocell_no == $confirm_cell_no)
	{

		if($community_id == 2)
		{

			//Getting telephone number of community

            $telnoassoc = pg_fetch_assoc(pg_query("SELECT telno FROM community_info WHERE community_id=".$community_id));
            $telno = $telnoassoc['telno'];

            $six_digit_random_number = mt_rand(100000, 999999);

            $date = date("Y-m-d H:i:s");

            $new_date = date("Y-m-d H:i:s", strtotime('+4 hours', strtotime($date)));

            $res = pg_query("UPDATE verification_code_sent SET is_valid='f' WHERE hoa_id=$hoa_id");

            $res = pg_query("SELECT * FROM verification_code_sent WHERE hoa_id=$hoa_id AND verification_code_type=4");

            if(pg_num_rows($res))
            {
            
            	$res = pg_query("UPDATE verification_code_sent SET verification_code=$six_digit_random_number, sent_on='$date', valid_until='$new_date', is_valid='t' WHERE hoa_id=$hoa_id AND verification_code_type=4");

        	}
        	else
        		$res = pg_query("INSERT INTO verification_code_sent (hoa_id, verification_code_type, verification_code, sent_on, valid_until, is_valid) VALUES ($hoa_id, 4, $six_digit_random_number, '$date', '$new_date', 't')");
            
            $body  = "$six_digit_random_number Hello ".$name.", OTP to view your HOA Annual Report is ".$six_digit_random_number.".";

            $key = 19255205003;

            //Sending request to twilio

            $url  = 'https://api.twilio.com/2010-04-01/Accounts/AC06019424f034503e8a7c67a8ddfcd490/Messages.json';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "Body=$body&To=%2B$key&From=%2B1$telno");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERPWD, "AC06019424f034503e8a7c67a8ddfcd490" . ":" . "a73768c36829436835653b51dd3c693c");
            $headers = array();
            $headers[] = "Content-Type: application/x-www-form-urlencoded";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);

            if (curl_errno($ch)) {

                echo 'Error:' . curl_error($ch);

            }

            curl_close ($ch);

            //print_r(nl2br("\n\n"));
            //print_r("Response is ".$result);

        }
		
		echo "sent";

	}
	else
		echo "Incorrect Phone Number.
Please verify the number and try again.";

?>
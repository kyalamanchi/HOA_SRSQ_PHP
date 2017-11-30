<?php

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


            $body  = "Twilio Testing Message";

            $key = 918686488809;

            //Sending request to twilio

            $url  = 'https://api.twilio.com/2010-04-01/Accounts/AC06019424f034503e8a7c67a8ddfcd490/Messages.json';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "Body=$body&To=%2B$key&From=%2B$telno");
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

            print_r(nl2br("\n\n"));
            print_r("Response is ".$result);

        }
		
		echo "sent";

	}
	else
		echo "Incorrect Phone Number.
Please verify the number and try again.";

?>
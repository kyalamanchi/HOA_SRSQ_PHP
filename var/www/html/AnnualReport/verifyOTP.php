<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$date = ("Y-m-d H:i:s");
	$enter_otp = $_POST['enter_otp'];
	$hoa_id = $_POST['hoa_id'];

	if($enter_otp == "")
		echo "OTP cannot be empty.";
	else{ 

		$res = pg_query("SELECT * FROM verification_code_sent WHERE hoa_id=$hoa_id AND is_valid='t' AND valid_until>='$date'");

		$res = pg_fetch_assoc($res);

		print_r("Result".$res);

		$sent_otp = $res['verification_code'];

		echo "$enter_otp - - - $sent_otp";

		if($enter_otp == $sent_otp)
			echo"correct";
		else
			echo "Incorrect OTP Entered.
Please check the OTP and try again.";

	}

?>
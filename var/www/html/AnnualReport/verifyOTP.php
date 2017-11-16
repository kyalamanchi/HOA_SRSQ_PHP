<?php

	$enter_otp = $_POST['enter_otp'];
	$hoa_id = $_POST['hoa_id'];

	if($enter_otp == "")
		echo "OTP cannot be empty.";
	else if($enter_otp == "5555")
		echo"correct";
	else
		echo "Incorrect OTP Entered.
Please check the OTP and try again.";

?>
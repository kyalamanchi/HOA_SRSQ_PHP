<?php

	$enter_otp = $_POST['enter_otp'];
	$hoa_id = $_POST['hoa_id'];

	if($enter_otp == "")
		echo "OTP cannot be empty.";
	else if($enter_otp == "0000")
	{	

		$hoa_id = base64_encode($hoa_id);
		
		header("Location: transactionPage1.php?hoa_id=$hoa_id");

	}
	else
		echo "Incorrect OTP Entered.
	Please verify the OTP and try again.";

?>
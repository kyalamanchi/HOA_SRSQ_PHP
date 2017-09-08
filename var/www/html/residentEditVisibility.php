<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $hoa_id = $_SESSION['hoa_hoa_id'];

    $change_mailing_address_visibility = $_POST['change_mailing_address_visibility'];
	$change_cell_visibility = $_POST['change_cell_visibility'];
	$change_email_visibility = $_POST['change_email_visibility'];
	$account_id = $_POST['account_id'];

	echo $change_mailing_address_visibility." - - - ".$change_cell_visibility." - - - ".$change_email_visibility;

	echo "<a href='https://hoaboardtime.com/residentDashboard.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.<script>setTimeout(function(){window.location.href='https://hoaboardtime.com/residentDashboard.php'},2000);</script>"

?>
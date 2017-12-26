<?php

	$id = $_POST['id'];

	pg_connect("host=srsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = 2;

	$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND hoa_id=$id");

	if(pg_num_rows($result) != 0)
		header("Location: https://hoaboardtime.com/paymentPageSRSQ.php?id=$id");
	else
	{
		echo "<br><br><br><br><center><h3>Invalid HOA Account Number.<br>Please check the HOA Account Number and try again.</h3></center><br><br><br><br><center><a href='paymentPage1.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.<script>setTimeout(function(){window.location.href='https://hoaboardtime.com/paymentPage1.php'},2000);</script>";
	}

?>
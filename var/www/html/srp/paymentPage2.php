<?php

	$id = $_POST['id'];

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = 1;

	$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND hoa_id=$id");

	if(pg_num_rows($result) != 0)
		header("Location: https://hoaboardtime.com/paymentPageSRP.php?id=$id");
	else
	{
		echo "<br><br><br><br><center><h3>Invalid HOA Account Number. Please check the HOA Account Number and try again.</h3></center><br><br><br><br><center><a href='paymentPage1.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.<script>setTimeout(function(){window.location.href='index.php'},1000);</script>";
	}

?>
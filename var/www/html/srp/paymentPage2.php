<?php

	ini_set("session.save_path","/var/www/html/session/");
	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	if(!$_SESSION['hoa_username'])
	{	
		$community_id = 1;
		$id = $_POST['id'];
	}
	else
	{	
		$community_id = $_SESSION['hoa_community_id'];
		$id = $_GET['id'];
	}

	$result = pg_query("SELECT * FROM hoaid WHERE community_id=$community_id AND hoa_id=$id");

	if(pg_num_rows($result) != 0)
	{	
		if($community_id == 1)
			header("Location: https://hoaboardtime.com/paymentPageSRP.php?id=$id");
		else if($community_id == 2)
			header("Location: https://hoaboardtime.com/paymentPageSRSQ.php?id=$id");
	}
	else
	{
		
		if(!$_SESSION['hoa_username'])
			echo "<br><br><br><br><center><h3>Invalid HOA Account Number.<br>Please check the HOA Account Number and try again.</h3></center><br><br><br><br><center><a href='paymentPage1.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.<script>setTimeout(function(){window.location.href='paymentPage1.php'},2000);</script>";
		else
			echo "<br><br><br><br><center><h3>Invalid HOA Account Number.<br>Please check the HOA Account Number and try again.</h3></center><br><br><br><br><center><a href='residentDashboard.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.<script>setTimeout(function(){window.location.href='residentDashboard.php'},2000);</script>";

	}

?>
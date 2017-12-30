<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$mailing_country = $_SESSION['mailing_country'];
	$mailing_state = $_SESSION['mailing_state'];

	echo "<option selected disabled value=''>Select State</option>";

	$result = pg_query("SELECT * FROM state WHERE country_id=$mailing_country");
	
	while($row = pg_fetch_assoc($result))
	{

		$state_id = $row['state_id'];
		$state_name = $row['state_name'];

		echo "<option value='$state_id'";

		if($state_id == $mailing_state)
			echo " selected";

		echo ">$state_name</option>";
	
	}

?>
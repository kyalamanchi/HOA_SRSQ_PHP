<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$mailing_district = $_SESSION['mailing_district'];
	$mailing_state = $_SESSION['mailing_state'];

	echo "<option selected disabled value=''>Select District</option>";

	$result = pg_query("SELECT * FROM district WHERE state_id=$mailing_state");
	
	while($row = pg_fetch_assoc($result))
	{

		$district_id = $row['district_id'];
		$district_name = $row['district_name'];

		echo "<option value='$district_id'";

		if($district_id == $mailing_district)
			echo " selected";

		echo ">$district_name</option>";
	
	}

?>
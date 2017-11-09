<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$state = $_POST['state_id'];

	$result = pg_query("SELECT * FROM district WHERE state_id=$state");

	$districts = "<option selected disabled value=''>Select District</option>";

	while($row = pg_fetch_assoc($result))
	{

		$district_id = $row['district_id'];
		$district_name = $row['district_name'];

		$districts .= "<option value='$district_id'>$district_name</option>";

	}

	echo $districts;

?>
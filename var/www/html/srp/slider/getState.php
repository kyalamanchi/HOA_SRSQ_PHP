<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$country = $_POST['country_id'];

	$result = pg_query("SELECT * FROM state WHERE country_id=$country");

	$states = "<option disabled selected value=''>Select State</option>";

	while($row = pg_fetch_assoc($result))
	{

		$state_id = $row['state_id'];
		$state_name = $row['state_name'];

		$states .= "<option value='$state_id'>$state_name</option>";

	}

	echo $states;

?>
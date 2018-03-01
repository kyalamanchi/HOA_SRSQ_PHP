<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
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
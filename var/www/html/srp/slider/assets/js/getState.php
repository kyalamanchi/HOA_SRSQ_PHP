<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$country = $_POST['country'];

	if($state == "")
		echo "empty";
	else
	{

		$result = pg_query("SELECT * FROM state WHERE country_id=$country");

		$states = "";

		while($row = pg_fetch_assoc($result))
		{

			$sid = $row['state_id'];
			$state_name = $row['state_name'];

			$state .= "<option value='$sid'>$state_name</option>";

		}

		echo $states;

	}

?>
<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$district = $_POST['district'];

	if($district == "")
		echo "empty";
	else
	{

		$result = pg_query("SELECT * FROM city WHERE district_id=$district");

		$cities = "<option disabled selected value=''>Select City</option>";

		while($row = pg_fetch_assoc($result))
		{

			$cid = $row['city_id'];
			$cname = $row['city_name'];

			$cities .= "<option value='$cid'>$cname</option>";

		}

		echo $cities;

	}

?>
<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
	$district = $_POST['district_id'];

	$result = pg_query("SELECT * FROM city WHERE district_id=$district");

	$cities = "<option disabled selected value=''>Select City</option>";

	while($row = pg_fetch_assoc($result))
	{

		$city_id = $row['city_id'];
		$city_name = $row['city_name'];

		$cities .= "<option value='$city_id'>$city_name</option>";

	}

	echo $cities;

?>
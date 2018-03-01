<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
	$mailing_district = $_SESSION['mailing_district'];
	$mailing_city = $_SESSION['mailing_city'];

	echo "<option selected disabled value=''>Select City</option>";

	$result = pg_query("SELECT * FROM city WHERE district_id=$mailing_district");
	
	while($row = pg_fetch_assoc($result))
	{

		$city_id = $row['city_id'];
		$city_name = $row['city_name'];

		echo "<option value='$city_id'";

		if($city_id == $mailing_city)
			echo " selected";

		echo ">$city_name</option>";
	
	}

?>
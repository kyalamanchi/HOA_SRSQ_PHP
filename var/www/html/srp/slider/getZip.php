<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$city = $_POST['city_id'];

	$result = pg_query("SELECT * FROM zip WHERE city_id=$city");

	$zips = "<option selected disabled value=''>Select Zip</option>";

	while($row = pg_fetch_assoc($result))
	{

		$zip_id = $row['zip_id'];
		$zip_code = $row['zip_code'];

		$zips .= "<option value='$zip_id'>$zip_code</option>";

	}

	echo $zips;

?>
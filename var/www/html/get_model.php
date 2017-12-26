<?php

	pg_connect("host=srsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$make = $_POST['make_id'];
	$output = "<option disabled>Select Model</option>";

	$result = pg_query("SELECT * FROM car_model WHERE car_make_id=$make");

	while($row = pg_fetch_assoc($result))
	{
		$id = $row['id'];
		$name = $row['name'];

		$output .= "<option value='$id'>$name - $id</option>";
	}

	echo $output;

?>
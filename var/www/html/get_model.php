<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$make = $_POST['make'];
	$output = "";

	$result = pg_query("SELECT * FROM car_model WHERE car_make_id=".$make);

	while($row = pg_fetch_assoc($result))
	{

		$id = $row['id'];
		$name = $row['name'];

		$output .= "<option id='".$id."'>".$name."</option>";
	}

	echo $output;

?>
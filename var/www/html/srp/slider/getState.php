<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$country = $_POST['country_id'];

	//$result = pg_query("SELECT * FROM state WHERE country_id=$country");

		$states = "<option value='' selected disabled>Geeth $country</option>";

	echo $states;

?>
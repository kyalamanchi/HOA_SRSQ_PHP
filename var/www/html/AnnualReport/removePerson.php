<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$person_id = $_POST['person_id'];

	$result = pg_query("UPDATE person SET is_active='f' WHERE id=$person_id");

	if($result)
		echo "Success";
	else
		echo "Some error occured. Please try again.";

?>
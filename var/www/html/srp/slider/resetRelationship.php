<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$relationship_type = $_POST['relationshipId'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM relationship WHERE id=$relationship_type"));

	echo $row['name'];

?>
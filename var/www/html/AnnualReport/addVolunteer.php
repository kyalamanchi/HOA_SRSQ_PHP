<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$person_id = $_POST['volunteer_person'];
	$task = $_POST['community_task'];
	$hoa_id = $_POST['hoa_id'];
	$home_id = $_POST['home_id'];
	$community_id = $_POST['community_id'];

	$result = pg_query("INSERT INTO volunteers (community_id, year, hoa_id, home_id, person_id, community_task_id) VALUES ($community_id, 2018, $hoa_id, $home_id, $person_id, $task)");

	//print_r($_POST);

	//echo $person_id." - - - ".$task;

	header("Location: volunteers.php");

?>
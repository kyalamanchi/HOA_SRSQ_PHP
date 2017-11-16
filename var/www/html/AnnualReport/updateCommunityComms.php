<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];

	$total_persons = $_POST['total_persons'];

	for($i = 1; $i <= $total_persons; $i++)
	{

		$person_id = $_POST[$i.'_person_id'];
		$board_meeting = $_POST[$i.'_board_meeting'];
		$payment_received = $_POST[$i.'_payment_received'];
		$landscape_repair = $_POST[$i.'_landscape_repair'];
		$landscape_maintenance = $_POST[$i.'_landscape_maintenance'];
		$late_payment_posted = $_POST[$i.'_late_payment_posted'];

		echo $person_id."G - - - ".$board_meeting."E - - - ".$payment_received."E - - - ".$landscape_repair."T - - - ".$landscape_maintenance."H - - - ".$late_payment_posted;

	}

?>
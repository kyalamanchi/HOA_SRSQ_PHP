<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$id = $_POST['id'];
	$date = $_POST['date'];
	$inspection_notice = $_POST['inspection_notice'];
	$initial_notice = $_POST['initial_notice'];
	$compliance_date = $_POST['compliance_date'];
	$viewed_from = $_POST['viewed_from'];
	$item = $_POST['item'];
	$observation = $_POST['observation'];
	$home = $_POST['home'];
	$owner = $_POST['owner'];
	$notice_summary = $_POST['notice_summary'];
	$status_requested = $_POST['status_requested'];

	echo $id." - - - ".$date." - - - ".$inspection_notice." - - - ".$initial_notice." - - - ".$compliance_date." - - - ".$viewed_from." - - - ".$item." - - - ".$observation." - - - ".$home." - - - ".$owner." - - - ".$notice_summary." - - - ".$status_requested;
?>
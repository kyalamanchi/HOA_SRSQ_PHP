<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$today = date('Y-m-d');

	$cell_number = $_POST['edit_cell_no'];

	$result = pg_query("UPDATE hoaid SET cell_no=$cell_number, updated_by=$user_id, updated_on='$today' WHERE hoa_id=$hoa_id");

	if($result)
		echo $cell_number;
	else
		echo "Some error occured. Please try again.";

?>
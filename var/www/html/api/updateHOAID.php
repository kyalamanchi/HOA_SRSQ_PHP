<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$today = date('Y-m-d');

	$cell_number = $_POST['edit_cell_no'];
	$email = $_POST['edit_email'];

	$result = pg_query("UPDATE hoaid SET email='$email', cell_no=$cell_number, updated_by=$user_id, updated_on='$today' WHERE hoa_id=$hoa_id");

	if($result)
	{	
		
		$_SESSION['hoa_alchemy_cell_no'] = $cell_number;
		$_SESSION['hoa_alchemy_email'] = $email;

		echo "success";
		
	}
	else
		echo "Some error occured. Please try again.";

?>
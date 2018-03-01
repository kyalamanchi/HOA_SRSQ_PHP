<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$today = date('Y-m-d');

	$cell_number = $_POST['edit_cell_no'];
	$cell_number = base64_encode($cell_number);
	$email = $_POST['edit_email'];

	$result = pg_query("UPDATE hoaid SET email='$email', cell_no='$cell_number', updated_by=$user_id, updated_on='$today' WHERE hoa_id=$hoa_id");

	if($result)
	{	

		echo "success";
		
	}
	else
		echo "Some error occured. Please try again.";

?>
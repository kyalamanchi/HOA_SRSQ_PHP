<?php

	session_start();

	$user_id = $_SESSION['hoa_alchemy_user_id'];

	$today = date('Y-m-d');

	$person_id = $_POST['personId'];
	$firstname = $_POST['personFirstname'];
	$lastname = $_POST['personLastname'];
	$email = $_POST['personEmail'];
	$cell_no = $_POST['personCellNo'];
	$role = $_POST['personRole'];
	$relationship = $_POST['personRelationship'];

	$result = pg_query("UPDATE person SET fname='$firstname', lname='$lastname', cell_no=$cell_no, email='$email', role_type_id=$role, relationship_id=$relationship, updated_by=$user_id, updated_on='$today' WHERE id=$person_id");

	if($result)
	{	

		echo "Success";

	}
	else
		echo "Some error occured. Please try again.";

?>
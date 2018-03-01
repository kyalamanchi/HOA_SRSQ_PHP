<?php

	session_start();

include 'includes/dbconn.php';
	$user_id = $_SESSION['hoa_alchemy_user_id'];

	$today = date('Y-m-d');

	$person_id = $_POST['personId'];
	$firstname = $_POST['personFirstname'];
	$lastname = $_POST['personLastname'];
	$email = $_POST['personEmail'];
	$cell_no = $_POST['personCellNo'];
	$role = $_POST['personRole'];
	$relationship = $_POST['personRelationship'];

	$cell_no = base64_encode($cell_no);

	if($person_id != '' && $firstname != '' && $lastname != '' && $email != '' && $cell_no != '' && $role != '' && $relationship != '')
	{

		$result = pg_query("UPDATE person SET fname='$firstname', lname='$lastname', cell_no='$cell_no', email='$email', role_type_id=$role, relationship_id=$relationship, updated_by=$user_id, updated_on='$today' WHERE id=$person_id");

		if($result)
		{	

			$_SESSION['person_$person_id_firstname'] = $firstname;
	        $_SESSION['person_$person_id_lastname'] = $lastname;
	        $_SESSION['person_$person_id_email'] = $email;
	        $_SESSION['person_$person_id_cell_no'] = $cell_no;
	        $_SESSION['person_$person_id_relationship'] = $relationship;
	        $_SESSION['person_$person_id_role'] = $role;

			echo $person_id;

		}
		else
			echo "Some error occured. Please try again.";
	}
	else
		echo "One or more fields are empty.";

?>
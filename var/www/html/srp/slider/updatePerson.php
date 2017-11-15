<?php

	session_start();

	$person_id = $_POST['edit_person_id'];

	$fname = $_POST['edit_person_firstname_$person_id'];

	echo $fname;

	//$result = pg_query("UPDATE person SET fname='', lname='', cell_no=, email='', role_type_id=, relationship_id= WHERE id=$person_id");

?>
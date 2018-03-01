<?php

	session_start();

include 'includes/dbconn.php';
	$person_id = $_POST['person_id'];

	$result = pg_query("UPDATE person SET is_active='f' WHERE id=$person_id");

	if($result)
		echo "Success";
	else
		echo "Some error occured. Please try again.";

	header("Location: persons.php");

?>
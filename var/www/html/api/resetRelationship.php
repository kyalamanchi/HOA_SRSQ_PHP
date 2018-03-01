<?php

	session_start();

include 'includes/dbconn.php';
	$relationship_type = $_POST['relationshipId'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM relationship WHERE id=$relationship_type"));

	echo $row['name'];

?>
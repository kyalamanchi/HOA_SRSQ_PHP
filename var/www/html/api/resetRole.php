<?php

	session_start();

include 'includes/dbconn.php';
	$role_type = $_POST['roleId'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM role_type WHERE role_type_id=$role_type"));

	echo $row['name'];

?>
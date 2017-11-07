<?php

	session_start();

	$hoa_id = $_SESSION['hoa_alchemy_hoa_id'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE hoa_id=$hoa_id"));

	$_SESSION['hoa_alchemy_username'] = $row['firstname']." ".$row['lastname'];

	echo $_SESSION['hoa_alchemy_hoa_id']." ".$_SESSION['hoa_alchemy_username'];

?>
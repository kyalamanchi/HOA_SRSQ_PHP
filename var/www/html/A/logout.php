<?php

	session_start();

	$_SESSION = array();

    session_unset();
    session_commit();
	session_destroy();
	session_write_close();
    session_regenerate_id(true);

	header("Location: index.php");

?>
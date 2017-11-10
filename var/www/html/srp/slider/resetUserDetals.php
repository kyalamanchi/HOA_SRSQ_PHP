<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	echo $_SESSION['hoa_alchemy_cell_no'];

?>
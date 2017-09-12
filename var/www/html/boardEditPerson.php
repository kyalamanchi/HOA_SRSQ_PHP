<?php

	session_start();

	echo $_POST['person_firstname']." - - - ".$_POST['person_lastname']." - - - ".$_POST['person_cell_no']." - - - ".$_POST['person_email']." - - - ".$_POST['role_type']." - - - ".$_POST['relationship']." - - - ".$_POST['person_id']." - - - ".$_SESSION['hoa_community_id'];

?>
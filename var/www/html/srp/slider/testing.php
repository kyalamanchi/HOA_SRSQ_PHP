<?php

	$ocell_no = $_POST['ocell_no'];
	$confirm_cell_no = $_POST['confirm_cell_no'];

	if($confirm_cell_no == "")
		echo "Please enter your phone number";
	else if($ocell_no == $confirm_cell_no)
		echo "sent";
	else
		echo "Invalid Phone Number";

?>
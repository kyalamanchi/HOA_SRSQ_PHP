<?php

	$cell_no = $_POST['confirm_cell_no'];

	if($cell_no == '')
		echo "Please enter your cell number";
	else
	{

		$ocell_no = $_POST['ocell_no'];

		if($ocell_no == $cell_no)
			echo "Correct";
		else
			echo "Incorrect Cell Number.
		Please check the entered number and try again.";

	}

?>
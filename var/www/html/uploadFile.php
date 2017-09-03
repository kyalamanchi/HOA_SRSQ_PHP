<?php

	$name = $_FILES['upload']['name'];
	$temp = $_FILES['upload']['tmp_name'];
	$type = $_FILES['upload']['type'];
	$size = $_FILES['upload']['size'];

	echo $name." - - - ".$temp." - - - ".$type." - - - ".$size;

	if($type == "application/json")
	{
		echo "<br>Success";
	}
	else
		echo "<br><br><br><center><h3>Invalid file format. Please use .JSON format files only.</h3></center>";

?>
<?php

	$name = $_FILES['upload']['name'];
	$temp = $_FILES['upload']['tmp_name'];
	$type = $_FILES['upload']['type'];
	$size = $_FILES['upload']['size'];

	echo $name." - - - ".$temp." - - - ".$type." - - - ".$size;

	if($type == "application/json")
	{
		move_uploaded_file($temp, $name);

		echo "<br>Success";
	}
	else
		echo "<br><br><br><center><h3>Invalid file format. Please use \".json\" format files only.</h3></center>";

?>
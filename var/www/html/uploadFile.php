<?php

	$name = $_FILES['upload']['name'];
	$temp = $_FILES['upload']['tmp_name'];
	$type = $_FILES['upload']['type'];
	$size = $_FILES['upload']['size'];

	echo $name." - - - ".$temp." - - - ".$type." - - - ".$size;

?>
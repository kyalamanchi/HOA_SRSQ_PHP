<?php

	$plate = $_POST['plate'];
	$hoa_id = $_POST['hoa_id'];

	$result = pg_query("SELECT * FROM home_tags WHERE hoa_id=$hoa_id AND type=1");

	while($row = pg_fetch_assoc($result))
	{

		$detail = $row['detail'];
	}
?>
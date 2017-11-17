<?php

	session_start();

	$community_id = $_SESSION['hoa_alchemy_community_id'];

	session_unset();
	session_destroy();
	session_regenerate_id(true);

	if($community_id == 1)
		header("Location: https://stoneridgeplace.com");
	else if($community_id == 2)
		header("Location: https://hoaboardtime.com");

?>
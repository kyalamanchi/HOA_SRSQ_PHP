<?php

	session_start();

	$name = $_POST['name'];
	$hoa_id = $_POST['hoa_id'];
	$living_in = $_POST['living_in'];
	$home_id = $_POST['home_id'];
	$email = $_POST['email'];
	$community_id = $_POST['community_id'];

	$agreement_type = $_POST['agreement_type'];

	if($community_id == 2) {

		switch ($agreement_type) {

			case 1:
				
				header("Location: https://hoaboardtime.com/srsqBoardEmailConsent.php?id=$hoa_id");
				
				break;

			case 2:

				header("Location: https://hoaboardtime.com/srsqBoardPool.php?id=$hoa_id");

				break;

			case 4:
				
				header("Location: https://hoaboardtime.com/srsqBoardCollectionPolicy.php?id=$hoa_id");
				
				break;
		}
		
	}
	else
		header("Location: https://hoaboardtime.com/boardCommunityAgreements.php");

?>
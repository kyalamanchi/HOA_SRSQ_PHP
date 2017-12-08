<?php

	ini_set("session.save_path","/var/www/html/session/");

  	session_start();

	$community_id = $_SESSION['hoa_community_id'];

	$to = $_POST['mail_email'];
	$body = nl2br($_POST['mail_body']);
	$subject = $_POST['mail_subject'];
	$token = $_POST['token'];

	echo "<br>".$community_id."<br>".$to."<br><br>".$subject."<br><br>".$body."<br><br>".$token;

	switch ($community_id) {

        case 1:
            $community = 'SRP';
            $cnote = "Stoneridgeplace HOA";
            $api_key = 'NRqC1Izl9L8aU-lgm_LS2A';
            $from = 'info@stoneridgeplace.org';
            break;

        case 2:
            $community = 'SRSQ';
            $cnote = "Stoneridge Square HOA";
            $api_key = 'MO3K0X3fhNe4qFMX6jOTOw';
            $from = 'info@stoneridgesquare.org';
            break;
    }

	//if($token == 1)
	//	header("Location: communityMailingList.php");

?>
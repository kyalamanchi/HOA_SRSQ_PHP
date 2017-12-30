<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	date_default_timezone_set('America/Los_Angeles');
	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$address1 = $_POST['edit_mailing_address'];
	$country_id = $_POST['edit_mailing_country'];
	$state_id = $_POST['edit_mailing_state'];
	$district_id = $_POST['edit_mailing_district'];
	$city_id = $_POST['edit_mailing_city'];
	$zip_id = $_POST['edit_mailing_zip'];
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$today = date('Y-m-d');

	$parseJSON = json_decode(file_get_contents('php://input'));

	if ( $parseJSON[0]->api == "dropbox" ){
		$key = base64_encode($parseJSON[0]->oauth2_token);
		// $community_id = 1;
		// $user_id = 2;
		$query = "INSERT INTO dropbox_api(community_id,oauth2_key,updated_by,updated_on) VALUES(".$community_id.",'".$key."',".$user_id.",'".date('Y-m-d H:i:s')."') ON CONFLICT(community_id) DO UPDATE SET oauth2_key ='".$key."',updated_by=".$user_id.",updated_on='".date('Y-m-d H:i:s')."'";
		if ( pg_query($query) ){
			echo "Success";
		}
		else {
			echo "Failed";
		}
	}

?>
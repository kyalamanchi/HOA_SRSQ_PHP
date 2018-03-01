<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
	$address1 = $_POST['edit_mailing_address'];
	$csz = $_POST['edit_mailing_csz'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$today = date('Y-m-d');
	$home_id = $_SESSION['hoa_alchemy_home_id'];
	$user_id = $_SESSION['hoa_alchemy_user_id'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

	if($address1 == $row['address1'])
	{

		$result = pg_query("UPDATE homeid SET living_status='t', address2='$csz', updated_on='$today', updated_by=$user_id WHERE home_id=$home_id");

		if($result)
			echo $address1;
		else
			echo "Some error occured. Please try again.";

	}
	else
	{

		$result = pg_query("UPDATE homeid SET living_status='f', updated_on='$today', updated_by=$user_id WHERE home_id=$home_id");

		if($result)
		{
			$result = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

			if($result)
			{

				$result = pg_query("UPDATE home_mailing_address SET address1='$address1', address2='$csz', updated_on='$today', updated_by=$user_id WHERE home_id=$home_id");

			}
			else
			{

				$result = pg_query("INSERT INTO home_mailing_address (home_id, address1, address2, community_id, updated_by, updated_on, valid_address)VALUES($home_id, '$address1', $csz, $community_id, $user_id, '$today', 't')");

			}

			if($result)
				echo $address1;
			else
				echo "Some error occured. Please try again.";

		}
		else
			echo "Some error occured. Please try again.";

	}

?>
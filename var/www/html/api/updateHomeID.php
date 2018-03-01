<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
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

	$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE home_id=$home_id"));

	if($address1 == $row['address1'])
	{

		$result = pg_query("UPDATE homeid SET living_status='t', address1='$address1', country_id=$country_id, state_id=$state_id, district_id=$district_id, city_id=$city_id, zip_id=$zip_id, updated_on='$today', updated_by=$user_id WHERE home_id=$home_id");

		if($result)
		{

			$_SESSION['mailing_address'] = $address1;
			$_SESSION['mailing_country'] = $country_id;
			$_SESSION['mailing_state'] = $state_id;
			$_SESSION['mailing_district'] = $district_id;
			$_SESSION['mailing_city'] = $city_id;
			$_SESSION['mailing_zip'] = $zip_id;

			echo $address1;

		}
		else
			echo "Some error occured. Plese try again.";

	}
	else
	{

		$result = pg_query("UPDATE homeid SET living_status='f', updated_on='$today', updated_by=$user_id WHERE home_id=$home_id");

		if($result)
		{
			$result = pg_num_rows(pg_query("SELECT * FROM home_mailing_address WHERE home_id=$home_id"));

			if($result)
			{

				$result = pg_query("UPDATE homeid SET living_status='t', address1='$address1', country_id=$country_id, state_id=$state_id, district_id=$district_id, city_id=$city_id, zip_id=$zip_id, updated_on='$today', updated_by=$user_id WHERE home_id=$home_id");

			}
			else
			{

				$result = pg_query("INSERT INTO home_mailing_address (home_id, address1, zip_id, city_id, district_id, state_id, country_id, community_id, updated_by, updated_on, valid_address)VALUES($home_id, '$address1', $zip_id, $city_id, $district_id, $state_id, $country_id, $community_id, $user_id, '$today', 't')");


			}

			if($result)
			{

				$_SESSION['mailing_address'] = $address1;
				$_SESSION['mailing_country'] = $country_id;
				$_SESSION['mailing_state'] = $state_id;
				$_SESSION['mailing_district'] = $district_id;
				$_SESSION['mailing_city'] = $city_id;
				$_SESSION['mailing_zip'] = $zip_id;

				echo $address1;

			}
			else
				echo "Some error occured. Please try again.";

		}
		else
			echo "Some error occured. Please try again.";

	}

?>
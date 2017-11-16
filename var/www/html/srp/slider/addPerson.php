<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$firstname = $_POST['add_person_firstname'];
	$lastname = $_POST['add_person_lastname'];
	$email = $_POST['add_person_email'];
	$cell_no = $_POST['add_person_cell_no'];
	$role = $_POST['add_person_role'];
	$relationship = $_POST['add_person_relationship'];
	$hoa_id = $_POST['hoa_id'];
	$home_id = $_POST['home_id'];

	$user_id = $_SESSION['hoa_alchemy_user_id'];
	$community_id = $_SESSION['hoa_alchemy_community_id'];
	$today = date('Y-m-d');
	$year = date('Y');
	$until = $year."-12-31";

	$result = pg_query("INSERT INTO person (role_type_id, relationship_id, hoa_id, valid_from, valid_until, is_active, email, cell_no, fname, lname, community_id, home_id, updated_by, updated_on) VALUES ($role, $relationship, $hoa_id, '$today', '$until', 't', '$email', $cell_no, '$firstname', '$lastname', $community_id, $home_id, $user_id, '$today')");

	if($result)
	{

			$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND home_id=$home_id AND email='$email' AND cell_no=$cell_no AND fname='$firstname' AND lname='$lastname'"));
			
			echo $row['id'];

	}
	else
		echo "Some error occured. Please try again.";

?>
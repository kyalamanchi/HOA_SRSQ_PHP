<?php

	ini_set("session.save_path","/var/www/html/session/");

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$fname = $_POST['person_firstname'];
	$lname = $_POST['person_lastname'];
	$cell_no = $_POST['person_cell_no'];
	$email = $_POST['person_email'];
	$role_type = $_POST['role_type'];
	$relationship = $_POST['relationship'];
	$home_id = $_POST['home_id'];
	$hoa_id = $_POST['hoa_id'];
	$community_id = $_SESSION['hoa_community_id'];

	$date = date("Y-m-d");
	$year = date("Y");

	print_r($result);

	$result = pg_query("INSERT INTO person(fname, lname, cell_no, email, hoa_id, home_id, community_id, is_active, role_type_id, relationship_id, valid_from, valid_until) VALUES ('$fname', '$lname', $cell_no, '$email', $hoa_id, $home_id, $community_id, 't', $role_type, $relationship, '$date', '12-31-$year')");

	if($result)
		echo "<br><br><br><br><center><h3>Person added successfully.</h3></center>";
	else
		echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

	echo "<br><br><br><center><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/residentProfile.php'},1000);</script>";

?>
<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$fname = $_POST['person_firstname'];
	$lname = $_POST['person_lastname'];
	$cell_no = $_POST['person_cell_no'];
	$email = $_POST['person_email'];
	$role_type = $_POST['role_type'];
	$relationship = $_POST['relationship'];
	$person_id = $_POST['person_id'];
	$hoa_id = $_POST['hoa_id'];

	$result = pg_query("UPDATE person SET fname='$fname', lname='$lname', email='$email', cell_no=$cell_no, role_type=$role_type, relationship=$relationship WHERE id=$person_id");

	if($result)
		echo "<br><br><br><br><center><h3>Person details updated successfully.</h3></center>";
	else
		echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

	echo "<br><br><br><center><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$hoa_id'},1000);</script>";

?>
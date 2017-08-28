<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$car_id = $_POST['car_id'];
	$make = $_POST['edit_make'];
	$model = $_POST['edit_model'];
	$color = $_POST['edit_color'];
	$year = $_POST['edit_year'];
	$plate = $_POST['edit_plate'];

	$result = pg_query("UPDATE car_detail SET car_make_id=$make, car_model_id=$model, car_color_id=$color, year=$year, notes=$plate WHERE id=$car_id");

	if($result)
		echo "<br><br><br><center><h3>Car details updated.</h3></center>";
	else
		echo "<br><br><br><center><h3>Some error occured. Please try again later.</h3></center>";

	echo "<br><br><center><a href='https://hoaboardtime.com/residentParkingTags.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/residentParkingTags.php'},2000);</script>";

?>
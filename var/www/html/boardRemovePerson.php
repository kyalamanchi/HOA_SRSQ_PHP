<?php

	ini_set("session.save_path","/var/www/html/session/");

	session_start();

	$community_id = $_SESSION['hoa_community_id'];

	if($community_id == 1)
        pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
    else if($community_id == 2)
        pg_connect("host=srsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$person_id = $_POST['person_id'];
	$hoa_id = $_POST['hoa_id'];

	$ehoa_id = base64_encode($hoa_id);

	$result = pg_query("UPDATE person SET is_active='f' WHERE id=$person_id");

	if($result)
		echo "<br><br><br><br><center><h3>Person removed.</h3></center>";
	else
		echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

	echo "<br><br><br><center><a href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$ehoa_id'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardUserDashboard2.php?hoa_id=$ehoa_id'},1000);</script>";

?>
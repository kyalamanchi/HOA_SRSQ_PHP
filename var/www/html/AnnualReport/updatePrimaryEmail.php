<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$pid = $_POST['change_primary_email'];
	$hoa_id = $_POST['hoa_id'];

	echo $pid;

	if($pid == '')
		echo "null";
	else
	{

		$result = pg_query("UPDATE person SET is_primary_email='t' WHERE id=$pid");

		if($result)
		{

			$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE id=$pid"));

			$email = $row['email'];

			echo $email;

		}
		else
			echo "Some error occured. Please try again.";
	
	}

?>
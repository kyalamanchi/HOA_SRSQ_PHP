<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$pid = $_POST['change_primary_email'];
	$hoa_id = $_POST['hoa_id'];

	if($pid == '')
		echo "<script type='text/javascript'> alert('Please select an email.');  window.location = 'primaryEmail.php'; </script>";
	else
	{

		$result = pg_query("UPDATE person SET is_primary_email='f' WHERE hoa_id=$hoa_id");

		$result = pg_query("UPDATE person SET is_primary_email='t' WHERE id=$pid");

		if($result)
		{

			$row = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE id=$pid"));

			$email = $row['email'];

			echo "<script type='text/javascript'> alert('Updated.');  window.location = 'primaryEmail.php'; </script>";

		}
		else
			echo "<script type='text/javascript'> alert('Some error occured. Please try again.');  window.location = 'primaryEmail.php'; </script>";
	
	}

?>
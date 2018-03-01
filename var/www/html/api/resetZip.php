<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

include 'includes/dbconn.php';
	$mailing_zip = $_SESSION['mailing_zip'];
	$mailing_city = $_SESSION['mailing_city'];

	echo "<option selected disabled value=''>Select Zip</option>";

	$result = pg_query("SELECT * FROM zip WHERE city_id=$mailing_city");
	
	while($row = pg_fetch_assoc($result))
	{

		$zip_id = $row['zip_id'];
		$zip_code = $row['zip_code'];

		echo "<option value='$zip_id'";

		if($zip_id == $mailing_zip)
			echo " selected";

		echo ">$zip_code</option>";
	
	}

?>
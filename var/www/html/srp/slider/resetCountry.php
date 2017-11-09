<?php

	session_start();

	if(!$_SESSION['hoa_alchemy_hoa_id'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$mailing_country = $_SESSION['mailing_country'];

	echo "<option selected disabled value=''>Select Country</option>";

	$result = pg_query("SELECT * FROM country");
	
	while($row = pg_fetch_assoc($result))
	{

		$country_id = $row['country_id'];
		$country_name = $row['country_name'];

		echo "<option value='$country_id'";

		if($country_id == $mailing_country)
			echo " selected";

		echo ">$country_name</option>";
	
	}

?>
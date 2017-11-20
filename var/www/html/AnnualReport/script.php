<?php
	
	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$result = pg_query("SELECT * FROM hoaid");

	while($row = pg_fetch_assoc($result))
	{

		$hoa_id = $row['hoa_id'];
		$home_id = $row['home_id'];

		$res = pg_query("INSERT INTO community_annual_report_visited (hoa_id, home_id) VALUES ($hoa_id, $home_id)");

		if($res)
			echo "$hoa_id - - - $home_id inserted.<br><br>"

	}

?>
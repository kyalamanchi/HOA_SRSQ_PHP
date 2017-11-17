<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$result = pg_query("SELECT * FROM hoaid");

	while($row = pg_fetch_assoc($result))
	{

		$hoa_id = $row['hoa_id'];

		$res = pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t'");

		$num_rows = pg_num_rows($res);

		echo $hoa_id." - - - ".$num_rows."<br>";

		if($num_rows == 1)
			$r = pg_fetch_assoc($res);
		else if($num_rows > 1)
			$r = pg_fetch_assoc(pg_query("SELECT * FROM person WHERE hoa_id=$hoa_id AND is_active='t' AND role_type_id=1 AND relationship_id=1"));

		$pid = $r['id'];

		pg_query("UPDATE person SET is_primary_email='t' WHERE id=$pid");

	}

?>
<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$result = pg_query("SELECT * FROM person ORDER BY id");

	while($row = pg_fetch_assoc($result))
	{

		$id = $row['id'];
		$cell_no = $row['cell_no'];

		$encrypted_cell_no = base64_encode($cell_no);

		echo $id." - - - ".$cell_no." - - - ".$encrypted_cell_no."<br>";

		$res = pg_query("UPDATE person SET cell_no='$encrypted_cell_no' WHERE id=$id");

		echo $res."<br><br>";

	}

?>
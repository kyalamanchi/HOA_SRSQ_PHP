<?php
	
include 'includes/dbconn.php';
	$res = pg_query("SELECT * FROM hoaid");

	while($row = pg_fetch_assoc($res))
	{

		$cell_no = $row['cell_no'];
		$hoa_id = $row['hoa_id'];

		if($cell_no != '')
		{

			$ecell_no = base64_encode($cell_no);

			$result = pg_query("UPDATE hoaid SET cell_no='$ecell_no' WHERE hoa_id=$hoa_id");

			echo "<br>".$hoa_id." - - - ".$cell_no." - - - ".$ecell_no." - - - ".$result;

		}
	}

?>
<?php
$data = file_get_contents('php://input');
error_reporting(E_ERROR | E_PARSE);
try{
if ($connection = pg_pconnect("host=srsq-only.crsa3tdmtcll.ussrsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database")){
		$query  = "SELECT * FROM INSPECTION_SUB_CATEGORY WHERE INSPECTION_CATEGORY_ID = (SELECT ID FROM INSPECTION_CATEGORY WHERE NAME='".$data."')";
		$queryResult = pg_query($query);
		$returnData = array();
		while ($row = pg_fetch_assoc($queryResult)) {
				$data2 = array();
				array_push($data2, $row['id']);
				array_push($data2,$row['name']);
				array_push($returnData, $data2);
		}
		echo json_encode($returnData);
	}
else {
	throw new Exception("Error Processing Request", 1);
}
}
catch(Exception  $e){
	echo $e->getMessage();
}
?>
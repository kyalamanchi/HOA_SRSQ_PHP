<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);
$hoaID = $parseJSON[0]->member_id;
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$query = "SELECT HOME_ID FROM HOAID WHERE HOA_ID = ".$hoaID;
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$homeID = $row['home_id'];

$query = "SELECT * FROM HOMEID WHERE HOME_ID=".$homeID;
$queryResult = pg_query($query);
$row  = pg_fetch_assoc($queryResult);

echo $row['living_status'];


// try{
// if ($connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database")){
// $personQuery = "SELECT DISTINCT relationship_id,EMAIL,role_type_id FROM PERSON WHERE HOA_ID=".$data."";
// if(  $personResult = pg_query($personQuery) ){
// 	$emailsData = array();
// 	while ($row = pg_fetch_assoc($personResult)) {
// 		$data2 = array();
// 		$data2['relation'] =  $row['relationship_id'];
// 		$data2['email'] =  $row['email'];
// 		$data2['role_id'] =  $row['role_type_id'];
// 		array_push($emailsData, $data2);
// 	}
// 	$emailsData  = json_encode($emailsData);
// 	print_r($emailsData);

// }
// else {
// 	echo "An error occured";
// }
// }
// else {
// 	throw new Exception("Error Processing Request", 1);
// }
// }
// catch(Exception  $e){
// 	echo $e->getMessage();
// }
?>
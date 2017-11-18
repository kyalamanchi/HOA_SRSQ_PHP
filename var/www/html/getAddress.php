<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

echo "Message";
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
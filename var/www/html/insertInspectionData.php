<?php
// error_reporting(E_ERROR | E_PARSE);

$jsonData = json_decode(file_get_contents('php://input'));

try{
if ($connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database")){
	$hoaID = $jsonData[0]->hoa_id;
	$homeID = $jsonData[0]->home_id;
	$category = $jsonData[0]->category;
	$subCategory = $jsonData[0]->subCategory;
	$location = $jsonData[0]->location;
	$description = $jsonData[0]->description;
	$noticeType = $jsonData[0]->noticeType;
	$status = $jsonData[0]->status;
	$complianceDate = $jsonData[0]->compliance_date;
	$fileData = $jsonData[0]->file_data;
	$fileName = $jsonData[0]->file_name;
	$legalDocument = $jsonData[0]->legal_document;
	$techID = "";
	if ( $fileData != ""){
		//Upload to dropbox
		$url = 'https://content.dropboxapi.com/2/files/upload';
		$fileContents = base64_decode($fileData);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/Inspection_Attachments/'.date('Y').'/'.$fileName.'","mode": "add","autorename": false,"mute": false}'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContents); 
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		$decodeData = json_decode($response);
		$fileID  = $decodeData->id;
		print_r($fileID);
		$query = "INSERT INTO DOCUMENT_MANAGEMENT(\"active\",\"description\",\"month_of_upload\",\"uploaded_date\",\"url\",\"year_of_upload\",\"community_id\",\"member_id\",\"hoa_id\",\"tech_id\") VALUES('TRUE','".$fileName."','".date('M')."','".date('Y-m-d H:i:s')."','/Inspection_Attachments/".date('Y')."/',".date('Y').",(SELECT COMMUNITY_ID FROM HOAID WHERE HOA_ID=".$hoaID."),(SELECT MEMBER_ID FROM MEMBER_INFO WHERE HOA_ID=".$hoaID."),".$hoaID.",'".$fileID."') RETURNING document_id";
		echo $query;

	}

}
}
catch(Exception  $e){
	echo $e->getMessage();
}
// // $personQuery = "SELECT DISTINCT relationship_id,EMAIL,role_type_id FROM PERSON WHERE HOA_ID=".$data."";
// // if(  $personResult = pg_query($personQuery) ){
// // 	$emailsData = array();
// // 	while ($row = pg_fetch_assoc($personResult)) {
// // 		$data2 = array();
// // 		$data2['relation'] =  $row['relationship_id'];
// // 		$data2['email'] =  $row['email'];
// // 		$data2['role_id'] =  $row['role_type_id'];
// // 		array_push($emailsData, $data2);
// // 	}
// // 	$emailsData  = json_encode($emailsData);
// // 	print_r($emailsData);


// // }
// 	$data2  = array();
// 	$query = "SELECT * FROM HOAID WHERE HOA_ID=".$data."";
// 	if ( $queryResult = pg_query($query) ){
// 		while($row = pg_fetch_assoc($queryResult)){
// 			$data2['home_id'] =  $row['home_id'];
// 			$data2['community_id'] = $row['community_id'];
// 		}
// 		echo json_encode($data2);
// 	}
// 	else {
// 	echo "An error occured";
// 	}
// }
// else {
// 	throw new Exception("Error Processing Request", 1);
// }
// }
// catch(Exception  $e){
// 	echo $e->getMessage();
// }
?>
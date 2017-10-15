<?php
error_reporting(E_ERROR | E_PARSE);
$jsonData = json_decode(file_get_contents('php://input'));
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$hoaID =  $jsonData->hoa_id;
$noticeName =  $jsonData->notice_name;
if ( $noticeName == 'Trash Can' ){
	$category = 9;
	$subCategory = 35;
	$description = "Trash Can";
	$location = 8;
	$legalDocs  = 3;
}
else if ( $noticeName == 'Basketball' ){
	$category = 11;
	$subCategory = 8;
	$description = "Basketball";
	$location = 8;
	$legalDocs  =  3;
}
else if  ( $noticeName == 'Unsightly Items' ){
	$category = 12;
	$subCategory = 32;
	$description = "Unsightly Item";
	$location = 8;
}
else if ( $noticeName == 'RV' ){
	$category = 13;
	$subCategory = 34;
	$description = "RV";
	$location = 8;

}
else if ( $noticeName == 'Garage Use' ){
	$category = 2;
	$subCategory = 6;
	$description = "Improper Garage Use";
	$location = 8;
	$legalDocs  = 3;
}
$query  = "SELECT * FROM HOAID WHERE HOA_ID = ".$hoaID;
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$homeID = $row['home_id'];
$communityID = $row['community_id'];
$inspectionNoticeType = 1;
$inspectionStatus = 1;

$query  = "INSERT INTO INSPECTION_NOTICES(\"inspection_date\",\"description\",\"community_id\",\"home_id\",\"date_of_upload\",\"location_id\",\"inspection_category_id\",\"inspection_sub_category_id\",\"hoa_id\",\"inspection_notice_type_id\",\"inspection_status_id\",\"compliance_date\",\"updated_date\",\"updated_by\",\"legal_docs_id\",\"item\") VALUES('".date('Y-m-d')."','".$description."',".$communityID.",".$homeID.",'".date('Y-m-d')."',".$location.",".$category.",".$subCategory.",".$hoaID.",".$inspectionNoticeType.",".$inspectionStatus.",'".date('Y-m-d')."','".date('Y-m-d')."',401,".$legalDocs.",'".$description."') RETURNING id";
echo $query;
?>
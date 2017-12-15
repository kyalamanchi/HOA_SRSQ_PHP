<?php

include 'password.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('America/Los_Angeles');
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");

$query  = "SELECT * FROM USR WHERE EMAIL='".$_GET['email']."'";

$queryResult = pg_query($query);

$row = pg_fetch_assoc($queryResult);

$result = array();

if ( password_verify($_GET['pwd'], $row['password']) ){
	$userData = array();

	$subQuery = "SELECT * FROM member_info WHERE member_id=".$row['member_id'];
	$subQueryResult = pg_query($subQuery);

	$subRow = pg_fetch_assoc($subQueryResult);
	$userData['hoa_id'] = $subRow['hoa_id'];
	$userData['first_name'] = $row['first_name'];
	$userData['last_name'] = $row['last_name'];
	$userData['login_email'] = $_GET['email'];
	$userData['house_number'] = $subRow['house_number'];
	$userData['address'] = $subRow['address'];


	$hoaquery = "SELECT * FROM HOAID WHERE HOA_ID=".$subRow['hoa_id'];
	$hoaqueryResult = pg_query($hoaquery);
	$hoarow = pg_fetch_assoc($hoaqueryResult);
	$userData['user_cellno'] = $hoarow['cell_no'];
	$userData['user_home_id'] = $hoarow['home_id'];



	$communityQuery = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$subRow['community_id'];
	$communityQueryResult = pg_query($communityQuery);
	$communityRow = pg_fetch_assoc($communityQueryResult);

	$userData['user_community_id'] = $subRow['community_id'];
	$userData['user_community_code'] = $communityRow['community_code'];
	$userData['user_community_legal_name'] = $communityRow['legal_name'];
	$userData['user_community_telno'] = '+1'.$communityRow['telno'];


	$boardMemberQuery = "SELECT * FROM BOARD_COMMITTEE_DETAILS WHERE USER_ID=".$row['id'];
	$boardMemberQueryResult = pg_query($boardMemberQuery);
	$boardMemberRow = pg_fetch_assoc($boardMemberQueryResult);

	if ( isset($boardMemberRow['board_member_id'])){
		$userData['is_board_member'] = "true";
	}
	else {
		$userData['is_board_member'] = "false";
	}

	$result["result"] = "success";

	$result["user_data"] = $userData;

}
else {
	$result["result"] = "error";
}

print_r(json_encode($result));

?>
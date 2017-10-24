<?php
date_default_timezone_set('America/Los_Angeles');
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$lastRanTime = "SELECT * FROM BACKGROUND_JOBS WHERE \"JOB_CATEGORY_ID\" = 5 AND \"COMMUNITY_ID\"=2 ORDER BY \"START_TIME\" DESC";
$lastRanTimeResult = pg_query($lastRanTime);
$time = pg_fetch_assoc($lastRanTimeResult)['START_TIME'];
if  ( $time ){ 
$lastRanMonth =  date('m',strtotime($time));
$lastRanYear = date('Y',strtotime($time));
if ( $lastRanMonth == date('m') ){
	echo "Charges cannot  be added more than once per month";
}
else if ( date('d') < 25 ){
	echo "Charges cannot be added until 25th";
}
else 
{
		$value = 0;
		$assessmentQuery = "SELECT AMOUNT FROM ASSESSMENT_AMOUNTS WHERE COMMUNITY_ID = 2 AND ASSESSMENT_RULE_TYPE_ID = 1";
		$assessmentQueryResult = pg_query($assessmentQuery);
		$row = pg_fetch_assoc($assessmentQueryResult);
		$assessmentAmount = $row['amount'];

		$query = "SELECT HOA_ID,HOME_ID FROM HOAID WHERE COMMUNITY_ID = 2 ORDER BY HOME_ID";
		$queryResult = pg_query($query);
		$hoaIDS = array();
		while ($row = pg_fetch_assoc($queryResult)) {
			$hoaIDS[$row['hoa_id']] = $row['home_id'];
		}
		$nextDate =  date('Y-m-1', strtotime('+1 month'));
		$nextMonth  = date('m',strtotime($nextDate));
		$nextDay  = date('d',strtotime($nextDate));
		$nextYear = date('Y',strtotime($nextDate));


		foreach ($hoaIDS as $hoaID => $homeID) {
			$value = $value + 1;
			$query = "INSERT INTO CURRENT_CHARGES(\"home_id\",\"hoa_id\",\"amount\",\"assessment_rule_type_id\",\"assessment_year\",\"assessment_month\",\"assessment_date\",\"community_id\") VALUES(".$homeID.",".$hoaID.",".$assessmentAmount.",1,".$nextYear.",".$nextMonth.",'".$nextDate."',2)";
			pg_query($query);
		}
		$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"START_TIME\") VALUES(2,5,'".date('Y-m-d H:i:s')."')";
		pg_query($query);
		print_r("CHARGES ADDED");
}
}
else {
		if ( date('d') < 25 ){
	echo "Charges cannot be added until 25th ";
	exit(0);
}
		$value = 0;
		$assessmentQuery = "SELECT AMOUNT FROM ASSESSMENT_AMOUNTS WHERE COMMUNITY_ID = 2 AND ASSESSMENT_RULE_TYPE_ID = 1";
		$assessmentQueryResult = pg_query($assessmentQuery);
		$row = pg_fetch_assoc($assessmentQueryResult);
		$assessmentAmount = $row['amount'];
		$query = "SELECT HOA_ID,HOME_ID FROM HOAID WHERE COMMUNITY_ID = 2 ORDER BY HOME_ID";
		$queryResult = pg_query($query);
		$hoaIDS = array();
		while ($row = pg_fetch_assoc($queryResult)) {
			$hoaIDS[$row['hoa_id']] = $row['home_id'];
		}
		$nextDate =  date('Y-m-1', strtotime('+1 month'));
		$nextMonth  = date('m',strtotime($nextDate));
		$nextDay  = date('d',strtotime($nextDate));
		$nextYear = date('Y',strtotime($nextDate));
		foreach ($hoaIDS as $hoaID => $homeID) {
			$value = $value + 1;
			$query = "INSERT INTO CURRENT_CHARGES(\"home_id\",\"hoa_id\",\"amount\",\"assessment_rule_type_id\",\"assessment_year\",\"assessment_month\",\"assessment_date\",\"community_id\") VALUES(".$homeID.",".$hoaID.",".$assessmentAmount.",1,".$nextYear.",".$nextMonth.",'".$nextDate."',2)";
				pg_query($query);
		}
		$query = "INSERT INTO BACKGROUND_JOBS(\"COMMUNITY_ID\",\"JOB_CATEGORY_ID\",\"START_TIME\") VALUES(2,5,'".date('Y-m-d H:i:s')."')";
		pg_query($query);
		print_r("CHARGES ADDED");
}
?>
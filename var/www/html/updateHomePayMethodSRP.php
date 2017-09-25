<?php
date_default_timezone_set('America/Los_Angeles');
$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");

$homeidquery = "SELECT * FROM hoaid WHERE community_id = 1";
$homeresult = pg_query($homeidquery);
$homeIDSARRAY = array();

while ($row = pg_fetch_assoc($homeresult)) {
	$homeIDSARRAY[$row['hoa_id']] = $row['home_id'];
}

$url = "https://api.forte.net/v3/schedules?page_size=1000";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json','x-forte-auth-organization-id: org_335357','authorization: Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
$failedScheduleIDS = array();
$completedSchedules = array();
if ( $result->number_results <= 1000){
foreach ($result->results as $schedule) {
	if ( $schedule->schedule_summary->schedule_remaining_quantity == 0){
		$completedSchedules[$schedule->schedule_id] = 0;
	}
	if ( $schedule->schedule_summary->schedule_remaining_quantity > 1){
		$remainingMonth = $schedule->schedule_summary->schedule_remaining_quantity;
		$rm = "+".$remainingMonth." months";
		$day = date('d',strtotime($schedule->schedule_start_date));
		$scheduleExpiry = date('Y-m-d', strtotime($rm,strtotime(date('Y-m-'.$day))));
		$updateQuery = "UPDATE home_pay_method SET payment_type_id=1,community_id=1,hoa_id=".$schedule->customer_id.",clientid='".$schedule->customer_token."',sch_start='".date('Y-m-d',strtotime($schedule->schedule_start_date))."',sch_end='".$scheduleExpiry."',sch_expires='".$scheduleExpiry."',next_sch='".date('Y-m-d',strtotime($schedule->schedule_summary->schedule_next_date))."',sch_create_date='".date('Y-m-d',strtotime($schedule->schedule_created_date))."',schedule_qty='".$schedule->schedule_quantity."',no_sch_succ_compltd='".$schedule->schedule_summary->schedule_successful_quantity."',sch_amt=".$schedule->schedule_amount.",sch_status='".$schedule->schedule_status."',sch_frequency='".$schedule->schedule_frequency."',updated_on='".date('Y-m-d H:i:s')."',updated_by=401 WHERE home_id=".$homeIDSARRAY[$schedule->customer_id];
		pg_query($updateQuery);
		print_r($updateQuery.nl2br("\n\n"));
	}
	else if ( $schedule->schedule_summary->schedule_remaining_quantity == 1) {
		$failedScheduleIDS[$schedule->schedule_id] = 1;
	}
}
}
else {
	print_r("Number of schedules greater than 1000".nl2br("\n").$failedScheduleIDS);
}
	print_r(nl2br("\n\n\n"));
foreach ($failedScheduleIDS as $key => $value) {
	$url = "https://api.forte.net/v3/schedules/";
	$url = $url.$key."/";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json','x-forte-auth-organization-id: org_335357','authorization: Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	curl_close($ch);
	$schedule = json_decode($result);
	if ( $schedule->schedule_summary->schedule_next_date){
	$remainingMonth = $schedule->schedule_summary->schedule_remaining_quantity;
		$rm = "+".$remainingMonth." months";
		$day = date('d',strtotime($schedule->schedule_start_date));
		$scheduleExpiry = date('Y-m-d', strtotime($rm,strtotime(date('Y-m-'.$day))));
		if ( $schedule->customer_id){
			$finalHoaID  = $schedule->customer_id;
		}
		if ( !$finalHoaID ){
			$finalHoaID = $schedule->xdata->xdata_1;
		}
		$updateQuery = "UPDATE home_pay_method SET payment_type_id=1,community_id=1,hoa_id=".$finalHoaID.",clientid='".$schedule->customer_token."',sch_start='".date('Y-m-d',strtotime($schedule->schedule_start_date))."',sch_end='".$scheduleExpiry."',sch_expires='".$scheduleExpiry."',next_sch='".date('Y-m-d',strtotime($schedule->schedule_summary->schedule_next_date))."',sch_create_date='".date('Y-m-d',strtotime($schedule->schedule_created_date))."',schedule_qty='".$schedule->schedule_quantity."',no_sch_succ_compltd='".$schedule->schedule_summary->schedule_successful_quantity."',sch_amt=".$schedule->schedule_amount.",sch_status='".$schedule->schedule_status."',sch_frequency='".$schedule->schedule_frequency."',updated_on='".date('Y-m-d H:i:s')."',updated_by=401 WHERE home_id=".$homeIDSARRAY[$finalHoaID];
		pg_query($updateQuery);
		print_r($updateQuery.nl2br("\n\n"));
	}
	else{
		print_r($url.nl2br("\n"));
	}
}
     function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
        $scheduleUpdateQuery = "INSERT INTO SCHEDULED_JOBS(\"JOB_TITLE\",\"START_TIME\",\"RUN_BY\",\"IP_ADDRESS\") VALUES('HOME PAY METHOD SRP','".date('Y-m-d H:i:s')."','MANUAL','".get_client_ip()."')";
        pg_query($scheduleUpdateQuery);
?>
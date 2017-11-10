<?php
	
	date_default_timezone_set('America/Los_Angeles');
	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
	$ch = curl_init('https://us14.api.mailchimp.com/3.0/lists/');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey eecf4b5c299f0cc2124463fb10a6da2d-us14'));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	$result = json_decode($result);
	foreach ($result->lists as $list) {

		if ( $list->stats->campaign_last_sent == "" ){
			$cLastSent = "NULL";

		}

		else {
			$cLastSent = "'".$list->stats->campaign_last_sent."'";
		}


		if ( $list->stats->last_unsub_date == "" ){
			$cLastUnsub = "NULL";
		}

		else {
			$cLastUnsub = "'".$list->stats->last_unsub_date."'";
		}

		if ( $list->stats->last_sub_date == "" ){
			$cLastSub = "NULL";
		}

		else {
			$cLastSub = "'".$list->stats->last_unsub_date."'";
		}


		$query = "INSERT INTO community_campaigns_lists(list_id,community_id,list_name,date_created,list_rating,member_count,unsubscribe_count,cleaned_count,member_count_since_send,unsubscribe_count_since_send,cleaned_count_since_send,campaign_count,campaign_last_sent,merge_field_count,avg_sub_rate,avg_unsub_rate,target_sub_rate,open_rate,click_rate,last_sub_date,last_unsub_date,update_date,updated_by) VALUES('".$list->id."',1,'".$list->name."','".$list->date_created."',".$list->list_rating.",".$list->stats->member_count.",".$list->stats->unsubscribe_count.",".$list->stats->cleaned_count.",".$list->stats->member_count_since_send.",".$list->stats->unsubscribe_count_since_send.",".$list->stats->cleaned_count_since_send.",".$list->stats->campaign_count.",".$cLastSent.",".$list->stats->merge_field_count.",".round($list->stats->avg_sub_rate*100,2).",".round($list->stats->avg_unsub_rate*100,2).",".round($list->stats->target_sub_rate*100,2).",".round($list->stats->open_rate*100,2).",".round($list->stats->click_rate*100,2).",".$cLastSub.",".$cLastUnsub.",'".date('Y-m-d H:i:s')."',401) ON CONFLICT(list_id) DO UPDATE SET list_rating=".round($list->list_rating*100,2).",member_count=".$list->stats->member_count.",unsubscribe_count=".$list->stats->unsubscribe_count.",cleaned_count=".$list->stats->cleaned_count.",member_count_since_send=".$list->stats->member_count_since_send.",unsubscribe_count_since_send=".$list->stats->unsubscribe_count_since_send.",cleaned_count_since_send=".$list->stats->cleaned_count_since_send.",campaign_count=".$list->stats->campaign_count.",campaign_last_sent=".$cLastSent.",merge_field_count=".$list->stats->merge_field_count.",avg_sub_rate=".round($list->stats->avg_sub_rate*100,2).",avg_unsub_rate=".round($list->stats->avg_unsub_rate*100,2).",target_sub_rate=".round($list->stats->target_sub_rate*100,2).",open_rate=".round($list->stats->open_rate*100,2).",click_rate=".round($list->stats->click_rate*100,2).",last_sub_date=".$cLastSub.",last_unsub_date=".$cLastUnsub.",update_date='".date('Y-m-d H:i:s')."',updated_by=401";
		if ( !pg_query($query)){
			print_r($query);
		print_r(nl2br("\n\n"));
	}
	}
?>

		
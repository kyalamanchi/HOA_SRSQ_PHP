<?php
	
	date_default_timezone_set('America/Los_Angeles');
	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
	$ch = curl_init('https://us14.api.mailchimp.com/3.0/campaigns/');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey eecf4b5c299f0cc2124463fb10a6da2d-us14'));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	$result = json_decode($result);

	foreach ($result->campaigns as $campaigns) {


		if ( isset($campaigns->report_summary) ){

			if ( (($campaigns->send_time) == "") ){
				$sendTime = "NULL";
				print_r("YES");
			}
			else {
				$sendTime = "'".$campaigns->send_time."'";
			}

		$query = "INSERT INTO COMMUNITY_CAMPAIGNS (campaign_id,community_id,create_time,status,emails_sent,send_time,content_type,recipients_list_id,opens,unique_opens,open_rate,clicks,subscriber_clicks,click_rate,title,reply_to,updated_on,updated_by) VALUES('".$campaigns->id."',1,'".$campaigns->create_time."','".$campaigns->status."',".$campaigns->emails_sent.",".$sendTime.",'".$campaigns->content_type."','".$campaigns->recipients->list_id."',".$campaigns->report_summary->opens.",".$campaigns->report_summary->unique_opens.",".round($campaigns->report_summary->open_rate,2).",".$campaigns->report_summary->clicks.",".$campaigns->report_summary->subscriber_clicks.",".round($campaigns->report_summary->click_rate,2).",'".$campaigns->settings->title."','".$campaigns->settings->reply_to."','".date('Y-m-d H:i:s')."',401) ON CONFLICT(campaign_id) DO UPDATE SET opens=".$campaigns->report_summary->opens.",unique_opens=".$campaigns->report_summary->unique_opens.",open_rate=".round($campaigns->report_summary->open_rate,2).",clicks=".$campaigns->report_summary->clicks.",subscriber_clicks=".$campaigns->report_summary->subscriber_clicks.",click_rate=".round($campaigns->report_summary->click_rate,2).",updated_on='".date('Y-m-d H:i:s')."',updated_by=401"	;
		}
		else {
			if ( (($campaigns->send_time) == "") ){
				$sendTime = "NULL";
				print_r("YES");
			}
			else {
				$sendTime = "'".$campaigns->send_time."'";
			}
			$query = "INSERT INTO COMMUNITY_CAMPAIGNS (campaign_id,community_id,create_time,status,emails_sent,send_time,content_type,recipients_list_id,opens,unique_opens,open_rate,clicks,subscriber_clicks,click_rate,title,reply_to,updated_on,updated_by) VALUES('".$campaigns->id."',2,'".$campaigns->create_time."','".$campaigns->status."',".$campaigns->emails_sent.",".$sendTime.",'".$campaigns->content_type."','".$campaigns->recipients->list_id."',0,0,0,0,0,0,'".$campaigns->settings->title."','".$campaigns->settings->reply_to."','".date('Y-m-d H:i:s')."',401) ON CONFLICT(campaign_id) DO UPDATE SET opens=0,unique_opens=0,open_rate=0,clicks=0,subscriber_clicks=0,click_rate=0,updated_on='".date('Y-m-d H:i:s')."',updated_by=401"	;

		}
		if ( !(pg_query($query))){
			print_r($query);
		}
	}
?>

		
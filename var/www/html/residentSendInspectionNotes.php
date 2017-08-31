<?php

	session_start();

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = $_SESSION['hoa_community_id'];

	$id = $_POST['id'];
	$date = $_POST['date'];
	$inspection_notice = $_POST['inspection_notice'];
	$initial_notice = $_POST['initial_notice'];
	$compliance_date = $_POST['compliance_date'];
	$viewed_from = $_POST['viewed_from'];
	$item = $_POST['item'];
	$observation = $_POST['observation'];
	$home = $_POST['home'];
	$owner = $_POST['owner'];
	$notice_summary = $_POST['notice_summary'];
	$status_requested_id = $_POST['status_requested'];

	$row = pg_fetch_assoc(pg_query("SELECT * FROM inspection_status WHERE id=".$status_requested_id));
	$status_requested = $row['inspection_status'];

	$result = pg_query("INSERT INTO inspection_notes (inspection_notices_id, notes_date, detail, status_requested_id) VALUES ($id, '$date', '$notice_summary', $status_requested_id)");

	if($result)
	{

		$to = "geethchadalawada@gmail";#"project-13225888-c32e66904296f8f2b2f5c19f@basecamp.com";

		switch ($community_id) {
	        case 1:
	            $community = 'SRP';
	            $cnote = "Stoneridgeplace HOA";
	            $api_key = 'NRqC1Izl9L8aU-lgm_LS2A';
	            $from = 'info@stoneridgeplace.org';
	            break;

	        case 2:
	            $community = 'SRSQ';
	            $cnote = "Stoneridge Square HOA";
	            $api_key = 'MO3K0X3fhNe4qFMX6jOTOw';
	            $from = 'info@stoneridgesquare.org';
	            break;
	    }

	                
	                
	    $content = 'Date : '.$date.'<br>Inspection Notice : '.$inspection_notice.'<br>Inspection Initial Notice : '.$initial_notice.'<br>Compliance Date : '.$compliance_date.'<br>Viewed From : '.$viewed_from.'<br>Item : '.$item.'<br>Observation : '.$observation.'<br>Home : '.$home.'<br>Owner : '.$owner.'<br>Inspection Notes Summary : '.$notice_summary.'.';
	    $subject = $home.' requesting '.$status_requested;
	    $uri = 'https://mandrillapp.com/api/1.0/messages/send.json';
	    $content_text = strip_tags($content);


	    $params = array(
	        "key" => $api_key,
	        "message" => array(
	            "html" => $content,
	            "text" => $content_text,
	            "subject" => $subject,
	            "from_email" => $from,
	            "from_name" => $from,
	            "to" => array(
	                array("email" => $to, "name" => $to)
	            ),
	            "track_opens" => true,
	            "track_clicks" => true,
	            "auto_text" => true,
	            "url_strip_qs" => true,
	            "preserve_recipients" => true
	        ),
	        "async" => false
	   	);

	    if($to)
	    {
	        $ch = curl_init();
	        $postString = json_encode($params);

	        curl_setopt($ch, CURLOPT_URL, $uri);
	        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

	        $result = curl_exec($ch);

	        echo "<br><br><center><h3>Email Sent.</h3></center>";
	    }
	    else
		{
			$result = pg_query("DELETE FROM inspection_notes WHERE inspection_notices_id=$id AND notes_date='$date' AND status_requested_id=$status_requested_id");

			echo "<br><br><center><h3>Some error occured. Please try again.</h3></center>";
		}

	}
	else
		echo "<br><br><center><h3>Some error occured. Please try again.</h3></center>";

	echo "<center><a href='https://hoaboardtime.com/residentViolationCitation.php'>Click here</a> if this page doesnot redirect automatically within 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/residentViolationCitation.php'},3000);</script>";
?>
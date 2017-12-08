<?php

	ini_set("session.save_path","/var/www/html/session/");

  	session_start();

	$community_id = $_SESSION['hoa_community_id'];

	$to = "geethchadalawada@gmail.com";//$_POST['mail_email'];
	$body = nl2br($_POST['mail_body']);
	$subject = $_POST['mail_subject'];
	$token = $_POST['token'];

	//echo "<br>".$community_id."<br>".$to."<br><br>".$subject."<br><br>".$body."<br><br>".$token;

	switch ($community_id) {

        case 1:
            //$community = 'SRP';
            //$cnote = "Stoneridgeplace HOA";
            $api_key = 'NRqC1Izl9L8aU-lgm_LS2A';
            $from = 'info@stoneridgeplace.org';
            break;

        case 2:
            //$community = 'SRSQ';
            //$cnote = "Stoneridge Square HOA";
            $api_key = 'MO3K0X3fhNe4qFMX6jOTOw';
            $from = 'info@stoneridgesquare.org';
            break;
    }

    $content = $body;
    //$subject = 'HOA Payment Received for Account - '.$hoa_id;
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

        echo "<br><br><br><br><center><h3>Email Sent</h3></center>";

    }

	if($token == 1)
		header("Location: communityMailingList.php");

?>
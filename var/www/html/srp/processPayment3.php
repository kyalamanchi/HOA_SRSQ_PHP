<?php

	session_start();

	if(!$_SESSION['hoa_username'])
		header("Location: logout.php");

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$community_id = $_SESSION['hoa_community_id'];
	$mode = $_SESSION['hoa_mode'];

	if($mode == 2)
		header('Location: residentDashboard.php');

	$hoa_id = $_POST['hoa_id'];
	$home_id = $_POST['home_id'];
	$name = $_POST['name'];
	$id = $_POST['id'];
	$payment_id = $_POST['payment_id'];
	$payment_type_id = $_POST['payment_type_id'];
	$amount = $_POST['amount'];
	$process_date = $_POST['process_date'];
	$document_num = $_POST['document_num'];

	$dt = date('Y-m-d');

	$num = pg_num_rows(pg_query("SELECT * FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND document_num='$document_num'"));

    if($num == 0)
    {
                
        $result = pg_query("INSERT INTO current_payments (id, payment_id, home_id, payment_type_id, amount, process_date, document_num, community_id, hoa_id, referred_to_attorney, payment_status_id, last_updated_on, email_notification_sent) VALUES ($id, '$payment_id', $home_id, $payment_type_id, $amount, '".date("Y-m-d", strtotime($process_date))."', '$document_num', $community_id, $hoa_id, FALSE, 1, '$dt', FALSE)");

        echo "<br><br><center><h3>Payment processed successfully for Home ID ".$home_id."</h3></center><br><br>";
                
        echo "<center>Home ID : ".$home_id."<br><br>HOA ID : ".$hoa_id."<br><br>Amount : ".$amount."<br><br>Document Number : ".$document_num."</center>";

        $result = pg_query("SELECT * FROM hoaid WHERE home_id=".$home_id." AND hoa_id=".$hoa_id);

        if($result)
        {
            $row = pg_fetch_assoc($result);

            $to = $row['email'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }

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

                
                
        $content = 'We received your HOA Payment ($'.$amount.') for account '.$hoa_id.' on '.date('m/d/Y', strtotime($process_date)).' and here is the confirmation code'.$document_num.'.';
        $subject = 'HOA Payment Received for Account - '.$hoa_id;
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

            echo "<br><br><center><h3>Email Notification Sent</h3></center>";

        }
        else
            echo "<br><br><center><h3>Email Notification Not Sent</h3></center>";
            
    }
    else
	    echo "<br><br><center><h3>Payment already exist with Home ID : ".$home_id." and Document number : ".$document_num."</h3></center><br><br>";

   echo "<br><br><center><a href='processPayment2.php?hoa_id=$hoa_id&home_id=$home_id&name=$name'>Click here</a> if this doesn't redirect in 5 seconds.</center><script>setTimeout(function(){window.location.href='processPayment2.php?hoa_id=$hoa_id&home_id=$home_id&name=$name'},1000);</script>";

?>
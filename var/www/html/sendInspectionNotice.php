<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: text/event-stream\n\n");
date_default_timezone_set('America/Los_Angeles');
$message  = "Mailing Statement...Please Wait...";
  echo 'data: '.$message."\n\n";  
  ob_end_flush();
  flush();
$connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
$hoaID = $_GET['id'];
$documentID = $_GET['doc_id'];
if ( $hoaID ){
$query = "SELECT * FROM HOAID WHERE HOA_ID=".$hoaID;
$queryResult  = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$homeID  = $row['home_id'];
$name = $row['firstname'].' '.$row['lastname'];
$email = $row['email'];
$query = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=1";
$queryResult  = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$legalName  = $row['legal_name'];
$query = "SELECT * FROM HOMEID WHERE HOME_ID=".$homeID;
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$address = $row['address1'];
$subject ='Inspection Notice - '.$address.'('.$hoaID.')';
$url = 'https://content.dropboxapi.com/2/files/download';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Dropbox-API-Arg: {"path": "'.$documentID.'"}'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	curl_close($ch);
$fileContents = $response;
$fileContents = base64_encode($fileContents);
$communityLogo = file_get_contents("srsq.jpg");
$communityLogo  =base64_encode($communityLogo);
if ( $homeID < 287 ){
$mailingData = array("key" => "cYcxW-Z8ZPuaqPne1hFjrA", "message" => array("html" => "<center><img src=\"cid:srsq\" alt=\"Community Logo\"></center><br><b>Inspection Notice for  ".$address."</b><br><br>Hello ".$name.",<br><br>Here is your inspection notice.<br><br>If you feel that your are not getting timely responses to your inspection  inquiries please escalate to board@stoneridgeplace.org<br><br>Update your contact your information <a href=\"https://hoaboardtime.com\">here.</a><br><br>In case you missed it, here is recent <a href=\"https://hoaboardtime.com/bloggy.php\">communication</a>","subject" => $subject,"from_email" => "billing@stoneridgesquare.org","from_name" => $legalName,"to" => array(array("email"=>"dhivysh@gmail.com","name"=>$name)),"improtant"=>"true","track_opens" => "true","track_clicks" => "true","attachments" => array(array("type" => "application/pdf","name" => "inspection_notice.pdf","content" => $fileContents)),"images"=>array( array("type" => "image/jpg","name" => "srsq","content" => $communityLogo) ),"send_at"=>"2000-01-01 00:00:00"));
}
else if ( $homeID < 144 ) {
	$mailingData = array("key" => "NRqC1Izl9L8aU-lgm_LS2A", "message" => array("html" => "<center><img src=\"cid:srsq\" alt=\"Community Logo\"></center><br><b>Inspection Notice for  ".$address."</b><br><br>Hello ".$name.",<br><br>Here is your inspection notice.<br><br>If you feel that your are not getting timely responses to your inspection  inquiries please escalate to board@stoneridgeplace.org<br><br>Update your contact your information <a href=\"https://hoaboardtime.com\">here.</a><br><br>In case you missed it, here is recent <a href=\"https://hoaboardtime.com/bloggy.php\">communication</a>","subject" => $subject,"from_email" => "billing@stoneridgeplace.org","from_name" => $legalName,"to" => array(array("email"=>"dhivysh@gmail.com","name"=>$name)),"improtant"=>"true","track_opens" => "true","track_clicks" => "true","attachments" => array(array("type" => "application/pdf","name" => "inspection_notice.pdf","content" => $fileContents)),"images"=>array( array("type" => "image/jpg","name" => "srsq","content" => $communityLogo) ),"send_at"=>"2000-01-01 00:00:00"));
}
else {
	exit(0);
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://mandrillapp.com/api/1.0/messages/send.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mailingData));
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);
	$result  = json_decode($result);
	$message  = $result;
  	echo 'data: '.$message."\n\n";  
  	ob_end_flush();
  	flush();
	if ( $result[0]->status == 'error'){
	$message  = $result[0]->name;
  	echo 'data: '.$message."\n\n";  
  	ob_end_flush();
  	flush();
  	}
  	else if ( ($result[0]->status == 'sent' ) || ($result[0]->status == 'queued') ){
	$message  = "Mail sent successfully";
  	echo 'data: '.$message."\n\n";  
  	ob_end_flush();
  	flush();
  	}
}
else {
	$message  = "Failed to mail statement. Error: No HOA ID provided.";
  	echo 'data: '.$message."\n\n";  
  	ob_end_flush();
  	flush();
}
?>
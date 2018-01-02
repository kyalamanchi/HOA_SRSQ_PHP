<?php
header("Content-Type: text/event-stream\n\n");
$someJSON = file_get_contents('php://input');
$parsedJSON = json_decode($someJSON);
$hoaID = $parsedJSON[0]->hoaid;

if ($hoaID){	

$req = curl_init();
curl_setopt($req, CURLOPT_URL,"https://hoaboardtime.com/singleBillingStatementGeneration.php?id=".$hoaID);
curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
curl_exec($req);

	$url = 'https://content.dropboxapi.com/2/files/download';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Dropbox-API-Arg: {"path": "/Billing_Statements/SRSQ/'.date('Y').'/ZIP/'.$hoaID.'.zip"}'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	if ( strpos($response, "Error in call to API function") !== false ) {
		$message =  "An error occured. Please try again.";
		echo $message."\n\n";
		exit(0);
	}
	else {
		$fileContent = base64_encode($response);
		$req = curl_init();
		curl_setopt($req, CURLOPT_URL,"http://southdata.us-west-2.elasticbeanstalk.com/TestOrderMailing.aspx?id=".$fileContent."&hoaid=".$hoaID);
		curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
		if(curl_exec($req) === false)
		{
    			$message =  "An error occured. Please try again.";
    			echo $message."\n\n";
				exit(0);
		}
		else 
		{	
				$message = "File uploaded to South Data.";
				echo $message."\n\n";  		
		}		
	}

}
else {
	$message =  "An error occured. Invalid HOAID.";
	echo $message."\n\n";  
	
	
	exit(0);
}

?>
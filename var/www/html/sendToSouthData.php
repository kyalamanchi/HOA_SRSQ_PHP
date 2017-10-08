<?php
header("Content-Type: text/event-stream\n\n");

if ($_GET['data']){	
	$url = 'https://content.dropboxapi.com/2/files/download';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Dropbox-API-Arg: {"path": "'.$_GET['data'].'"}'));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	if ( strpos($response, "Error in call to API function") !== false ) {
		$message =  "An error occured. Please try again.";
		echo 'data: '.$message."\n\n";  
		ob_end_flush();
		flush();
		exit(0);
	}
	else {
		$fileContent = base64_encode($response);
		$req = curl_init();
		curl_setopt($req, CURLOPT_URL,"http://southdata.us-west-2.elasticbeanstalk.com/TestOrderMailing.aspx?id=".$fileContent."&hoaid=".$_GET['data1']);
		curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
		if(curl_exec($req) === false)
		{
    			$message =  "An error occured. Please try again.";
    			echo 'data: '.$message."\n\n";  
				ob_end_flush();
				flush();
				exit(0);
		}
		else 
		{	
				$message = "File uploaded to South Data.";
				echo 'data: '.$message."\n\n";  
				ob_end_flush();
				flush();
		}
		
	}
}
else {
	$message =  "An error occured. Please try again.";
	echo 'data: '.$message."\n\n";  
	ob_end_flush();
	flush();
	exit(0);
}

?>
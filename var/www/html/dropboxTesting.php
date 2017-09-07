<!DOCTYPE html>
<html>
<head>
	<title>Unprocessed HOA Docs</title>
</head>
<body>

	<br><br>

	<center><h3>UNPROCESSED HOA DOCS</h3></center>

	<br><br>

	<?php

		$cheaders = array('Authorization: Bearer QwUjEm5GAkAAAAAAAAAADocHK4CgCJoBl2A8-fe9Fs42E06qkDqJA2S9YPwGbZyF',
                    'Content-Type: application/octet-stream',
                    'Dropbox-API-Arg: {"path":"/'.$path.'", "mode":"add"}');

		$ch = curl_init('https://api.dropboxapi.com/2/files/list_folder');

		curl_setopt($ch, CURLOPT_HTTPHEADER, $cheaders);
		curl_setopt($ch, CURLOPT_PUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		echo $response;

	    $json_decode = json_decode($response,TRUE);

	?>

</body>
</html>
<?php
// // echo phpinfo();
// $url = 'https://content.dropboxapi.com/2/files/download';
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer QwUjEm5GAkAAAAAAAAAAN-KemUHI72QOlDsQxtH6H9JlRixSoi1fqq7D7BCHrNFm','Dropbox-API-Arg: {"path": "/SRSQ_HOA/Documents/Minutes/SRSQ_Minutes_1999_October__Board_Signed.pdf"}'));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
// $response = curl_exec($ch);
// // header('Content-type: application/pdf'); header('Content-Disposition: inline; filename="a.pdf"'); 
// echo $response;
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
//  $consumer_key     = 'qyprdRAm244oPXhP3miXslnVdpDfWF';
//             $consumer_secret  = 'i3EglyzIw5eIUBXRttNUd7xBc5zqyxZxguHlYtdo';
//             $access_token     = 'qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v';
//             $access_secret    = '1XKRXuoXJeSKp84LmA1SF6aPFrywn4tOsUpB0Sn5';

//             $oauth = new OAuth($consumer_key,$consumer_secret,OAUTH_SIG_METHOD_HMACSHA1,OAUTH_AUTH_TYPE_AUTHORIZATION);
//             print_r($oauth);

include 'includes/dbconn.php';

$query = "ALTER TABLE community_invoices ALTER COLUMN document_id TYPE text";

if ( !pg_query($query)) {
	print_r("TABLE TYPE CHANGED");
}
else {
	print_r("failed to change type");
}


?>

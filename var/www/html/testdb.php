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

$query = "SELECT * FROM COMMUNITY_LEGAL_DOCS WHERE legal_docs_type_id=(SELECT ID FROM legal_docs_type WHERE name='Voting & Election Rules' and community_id=2) AND COMMUNITY_ID=2 and valid_from='2017-01-01' and valid_until='2018-12-31'";
$queryResult = pg_query($query);

while ($row = pg_fetch_assoc($queryResult)) {
	print_r($row);
}

?>

<?php
// echo phpinfo();
$url = 'https://content.dropboxapi.com/2/files/download';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer QwUjEm5GAkAAAAAAAAAAN-KemUHI72QOlDsQxtH6H9JlRixSoi1fqq7D7BCHrNFm','Dropbox-API-Arg: {"path": "/SRSQ_HOA/Documents/Minutes/SRSQ_Minutes_1999_October__Board_Signed.pdf"}'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
// header('Content-type: application/pdf'); header('Content-Disposition: inline; filename="a.pdf"'); 
echo $response;
 $consumer_key     = 'qyprdRAm244oPXhP3miXslnVdpDfWF';
            $consumer_secret  = 'i3EglyzIw5eIUBXRttNUd7xBc5zqyxZxguHlYtdo';
            $access_token     = 'qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v';
            $access_secret    = '1XKRXuoXJeSKp84LmA1SF6aPFrywn4tOsUpB0Sn5';

            $oauth = new OAuth($consumer_key,$consumer_secret,OAUTH_SIG_METHOD_HMACSHA1,OAUTH_AUTH_TYPE_AUTHORIZATION);
            print_r($oauth);
            
?>

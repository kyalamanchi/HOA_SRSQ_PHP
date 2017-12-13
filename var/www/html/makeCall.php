<?php

require 'twilio/Twilio/autoload.php';

use Twilio\Rest\Client;

$sid = 'AC9370eeb4b1922b7dc29d94c387b3ab56';
$token = '3b29450d9ce0e5ec7ba6b328f05525a2';
$client = new Client($sid, $token);


    try {
        $call = $client->account->calls->create(

            "+919603923649",
            "+19253996642",
            array("url" => "http://demo.twilio.com/welcome/voice/")
        );
        echo "Started call: " . $call->sid;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

// $client->messages->create(
//     '+919603923649',
//     array(
//         'from' => '+19253996642',
//         'body' => "Sample message using twilio SDK."
//     )
// );


?>
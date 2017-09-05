<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$ch = curl_init('https://us12.api.mailchimp.com/3.0/lists/09692e90bd/members');

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: apikey af5b50b9f714f9c2cb81b91281b84218-us12'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            
    $result = curl_exec($ch);
    $json_decode = json_decode($result,TRUE);

    #print_r($json_decode);

    print_r($json_decode['members'][0]['email_address']);

    echo "<br>";

    print_r($json_decode['members'][0]['FNAME']);

    echo "<br>";

    print_r($json_decode['members'][0]['LNAME']);

    echo "<br>";

    print_r($json_decode['members'][0]['LINKID']);

    echo "<br>";

    $json_decode = json_encode($result,TRUE);

    print_r($json_decode['members'][0]);

?>
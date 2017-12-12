<?php

date_default_timezone_set('America/Los_Angeles');
$data = file_get_contents('php://input');
$parsJSON = json_decode($data);
pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

echo $parsJSON[0];
?>
<?php
$someJSON = file_get_contents('php://input');
$parsedJSON = json_decode($someJSON);
echo $parsedJSON[0]->customer_id;
echo $parsedJSON[0]->auth_amount;
echo $parsedJSON[0]->first_name;
echo $parsedJSON[0]->last_name;
echo $parsedJSON[0]->routing_number;
echo $parsedJSON[0]->account_number;
?>
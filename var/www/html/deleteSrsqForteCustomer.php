<?php
$someJSON = file_get_contents('php://input');
$parsedJSON = json_decode($someJSON);
$customerToken = $parsedJSON[0]->customer_token;
echo $customerToken;
?>
<?php
$parsedJSON = json_decode(file_get_contents('php://input'));
echo $parsedJSON;
echo $parsedJSON[0]->id;
?>
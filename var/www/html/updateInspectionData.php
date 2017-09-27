<?php
$parsedJSON = json_decode(file_get_contents('php://input'));
echo $parsedJSON[0]->inspection_id;

?>
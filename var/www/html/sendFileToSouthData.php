<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

echo $parseJSON[0]->file_data;

?>
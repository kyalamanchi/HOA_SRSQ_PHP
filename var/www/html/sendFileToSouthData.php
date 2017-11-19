<?php
$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

echo $parseJSON[0]->file_data;
echo $parseJSON[0]->file_name;
echo $parseJSON[0]->hoa_id;
echo $parseJSON[0]->address;

?>
<?php
// error_reporting(E_ERROR | E_PARSE);
$jsonData = json_decode(file_get_contents('php://input'));
$hoaID =  $jsonData->hoa_id;
$noticeName =  $jsonData->notice_name;
if ( $noticeName == 'Trash Can' ){
	echo "Trash Can";
}
else if ( $noticeName == 'Basketball' ){
	echo "Basketball";
}
else if  ( $noticeName == 'Unsightly Items' ){
	echo "Unsightly Items";
}
else if ( $noticeName == 'RV' ){
	echo "Rv";
}
else if ( $noticeName == 'Garage Use' ){
	echo "Garage Use";
}
?>
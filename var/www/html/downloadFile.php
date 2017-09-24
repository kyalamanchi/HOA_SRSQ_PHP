<?php
if ( $_GET['id'] ){
$file_url = $_GET['id'].'.zip';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url);
unlink($_GET['id'].'.zip');
}
else {
	echo "Cannot find file";
}
?>
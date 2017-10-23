<?php
$dir    = '/var/www/html';
$files1 = scandir($dir);
$files2 = scandir($dir, 1);

print_r($files1);
// print_r($files2);
print_r("\n\n\n");

// $fileNames = array("createInspectionNoticeTest.php","loginTest.php");
// foreach ($fileNames as $key) {
// 	print_r($key);
// 	print_r(nl2br("\n"));
// 	if ( file_exists($key) ){
// 	print_r($key."File Found");
// 	unlink($key);
// 	}
// 	print_r(nl2br("\n"));
// 	if ( file_exists($key) ){
// 		print_r("File found".$key);
// 		print_r(nl2br("\n"));
// 	}
// 	else {
// 		print_r($key."File removed");
// 	}
// 	print_r(nl2br("\n"));
// }
?>
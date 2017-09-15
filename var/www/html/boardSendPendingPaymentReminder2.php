<?php

$mes = $_POST['message'];

echo $_POST['no_of_recipients']."<br><br>";
echo $mes."<br><br><br><br>";

nl2br($mes."\n"."Ravindra");

for($i = 0; $i < $_POST['no_of_recipients']; $i++)
	echo $_POST['home_id_'.$i]."<br>";
?>
<?php

echo $_POST['no_of_recipients']."<br><br>";
echo $_POST['message']."<br><br><br><br>";

for($i = 0; $i < $_POST['no_of_recipients']; $i++)
	echo $_POST['home_id_'.$i]."<br>";
?>
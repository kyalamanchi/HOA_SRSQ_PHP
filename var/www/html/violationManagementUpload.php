<?php

	$jsonData = file_get_contents("HOAView.json");
	$json = json_decode($jsonData, true);

	echo $json['Inspection_Data_Input_Form'][0]['Viewed_From'];

?>
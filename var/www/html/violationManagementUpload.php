<?php

	$jsonData = file_get_contents("HOAView.json");
	$json = json_decode($jsonData, true);

	#echo $json['Inspection_Data_Input_Form'][0]['Viewed_From'];

	$count = sizeof($json['Inspection_Data_Input_Form']);

	for($i = 0; $i < $count; $i++)
	{
		$home = $json['Inspection_Data_Input_Form'][$i]['Address1'];
		$item = $json['Inspection_Data_Input_Form'][$i]['Lookup_1'];
		$category = $json['Inspection_Data_Input_Form'][$i]['Category'];
		$compliance_date = $json['Inspection_Data_Input_Form'][$i]['Compliance_Date'];

		echo $home." - - - ".$item." - - - ".$category." - - - ".$compliance_date;
	}

?>
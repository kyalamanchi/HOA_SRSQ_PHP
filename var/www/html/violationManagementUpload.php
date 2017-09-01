<?php

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$jsonData = file_get_contents("HOAView.json");
	$json = json_decode($jsonData, true);

	#echo $json['Inspection_Data_Input_Form'][0]['Viewed_From'];

	$count = sizeof($json['Inspection_Data_Input_Form']);

	for($i = 0; $i < $count; $i++)
	{
		
		$home = $json['Inspection_Data_Input_Form'][$i]['Address1'];
		$item = $json['Inspection_Data_Input_Form'][$i]['Lookup_1'];
		$category = $json['Inspection_Data_Input_Form'][$i]['Category'];
		$inspection_date = $json['Inspection_Data_Input_Form'][$i]['Filed_Date'];
		$description = $json['Inspection_Data_Input_Form'][$i]['Item_Notes'];
		$location = $json['Inspection_Data_Input_Form'][$i]['Viewed_From'];
		$status = $json['Inspection_Data_Input_Form'][$i]['Status'];
		$compliance_date = $json['Inspection_Data_Input_Form'][$i]['Compliance_Date'];

		if($compliance_date != "")
			$compliance_date = date('Y-m-d', strtotime($compliance_date));

		if($inspection_date != "")
			$inspection_date = date('Y-m-d', strtotime($inspection_date));

		$row = pg_fetch_assoc(pg_query("SELECT * FROM homeid WHERE address1='$home'"));
		$home_id = $row['home_id'];

		echo ($i+1)." - - - ".$home." - - - ".$home_id." - - - ".$item." - - - ".$category." - - - ".$compliance_date." - - - ".$description." - - - ".$inspection_date." - - - ".$status." - - - ".$location."<br><br><br><br><br>";

	}

?>
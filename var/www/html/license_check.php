<?php

	$license_plate = $_POST['license_plate'];
	$license_enc = base64_encode($license_plate);

	ini_set('max_execution_time', 180);


	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	$query = "SELECT * FROM car_details WHERE notes='".$license_enc."'";
	$result = pg_query($query);
	$num_row = pg_num_rows($result);

	if($num_row == 0)
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("License Plate doesnot exist.");'; 
		echo 'window.location.href = "https://hoaboardtime.com/";';
		echo '</script>';
	}
	else
	{
		$row =pg_fetch_assoc($result);
		$car_detail_id = $row['id'];
		$car_make = $row['car_make'];
		$car_model = $row['car_model'];
		$car_color = $row['car_color'];
		$car_year = $row['car_year'];
				
		$query1 = "SELECT * FROM home_tags WHERE detail='".$car_detail_id."'";
		
		$result1 = pg_query($query1);
		$num_row1 = pg_num_rows($result1);
		
		if($num_row == 0){
			echo '<script type="text/javascript">'; 
		echo 'alert("Associated Hoa Id not found");'; 
		echo 'window.location.href = "https://hoaboardtime.com/";';
		echo '</script>';
		}
		else{
			$row1 =pg_fetch_assoc($result1);
			$hoa_id = $row1['hoa_id'];
			
			$query2 = "SELECT * FROM hoaid WHERE hoa_id='".$hoa_id."'";
			$result2 = pg_query($query2);
			$row2 = pg_fetch_assoc($result2);
			
			$first = $row2['firstname'];
			$last = $row2['lastname'];
			$email = $row2['email'];	
			$cell = $row2['cell'];		
			
			
		echo "<html><head></head><body>"; 
		echo "This car belongs to $first $last, Email at $email"; 
		echo "<br>";
		echo "Car Details are $car_color $car_make $car_model $car_year";
		echo "</body></html>";
			
		}
		
		
	}
?>
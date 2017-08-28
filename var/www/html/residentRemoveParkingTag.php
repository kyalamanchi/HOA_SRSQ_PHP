<?php

	function decrypt_string($input)
    {
                          
        $input_count = strlen($input);
                                                                                             
        $dec = explode(".", $input);// splits up the string to any array
        $x = count($dec);
        $y = $x-1;// To get the key of the last bit in the array 
                                                                                             
        $calc = $dec[$y]-50;
        $randkey = chr($calc);// works out the randkey number
                                                                                             
        $i = 0;
                                                                                             
        while ($i < $y)
        {
                                                                                             
            $array[$i] = $dec[$i]+$randkey; // Works out the ascii characters actual numbers
            @$real .= chr($array[$i]); //The actual decryption
                                                                                             
            $i++;

        };
                                                                                             
        @$input = $real;
        return $input;

    }

	$delete_plate = $_POST['plate'];
	$hoa_id = $_POST['hoa_id'];
	$flag = 0;

	echo "POST : ".$delete_plate." - - - ".$hoa_id."<br>";

	$result = pg_query("SELECT * FROM home_tags WHERE hoa_id=".$hoa_id." AND type=1");

	echo pg_num_rows($result);

	while($row = pg_fetch_assoc($result))
	{

		$detail = $row['detail'];
		$id = $row['id'];

		echo "Detail : ".$detail." - - - ".$id."<br>";

		$row1 = pg_fetch_assoc(pg_query("SELECT * FROM car_detail WHERE id=$detail"));

		$plate = $row1['plate'];
		$plate = base64_decode($plate);
        $plate = decrypt_string($plate);

        echo "Plate : ".$plate."<br>";

        if($plate == $delete_plate)
        {

        	$flag = 1;
        	break;

        }
	}

	if($flag == 1)
	{
		echo "Found";
	}
	else
	{
		echo "Not found";
	}

	echo "<script>setTimeout(function(){window.location.href='https://hoaboardtime.com/residentParkingTags.php'},3000);</script>";

?>
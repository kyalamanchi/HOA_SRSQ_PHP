<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $community_id = $_SESSION['hoa_community_id'];
    $hoa_id = $_POST['select_hoa'];
    $vendor_id = $_POST['select_vendor'];
	$document_to = $_POST['document_to'];
	$id = $_POST['id'];

	if($vendor_id != "" && $hoa_id != "")
	{

		echo "<br><br><br><br><h3><center>Select either user or vendor only.</center></h3>";

	}
	else if($vendor_id == "" && $hoa_id != "")
	{
		
		$result = pg_query("UPDATE community_sign_agreements SET hoa_id=$hoa_id WHERE id=$id");

		if($result)
			echo "<br><br><br><br><center><h3>HOA ID added successfully.</h3></center>";
		else
			echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

	}
	else if($vendor_id != "" && $hoa_id == "")
	{
		
		$result = pg_query("UPDATE community_sign_agreements SET vendor_id=$vendor_id WHERE id=$id");

		if($result)
			echo "<br><br><br><br><center><h3>HOA ID added successfully.</h3></center>";
		else
			echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

	}
	else if($vendor_id == "" && $hoa_id == "")
	{

		echo "<br><br><br><br><h3><center>No user or vendor selected.</center></h3>";

	}

	echo "<br><br><br><center><a href='https://hoaboardtime.com/boardCommunitySignedAgreements.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardCommunitySignedAgreements.php'},1000);</script>"
?>
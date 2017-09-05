<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $community_id = $_SESSION['hoa_community_id'];
    $hoa_id = $_POST['select_hoa'];
	$document_to = $_POST['document_to'];

	$result = pg_query("UPDATE community_sign_agreements SET hoa_id=$hoa_id WHERE community_id=$community_id AND document_to='$document_to'");

	if($result)
		echo "<br><br><br><br><center><h3>HOA ID added successfully.</h3></center>";
	else
		echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

	echo "<br><br><br><a href='https://hoaboardtime.com/boardCommunitySignedAgreements.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.<script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardCommunitySignedAgreements.php'},1000);</script>"
?>
<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $disclosure_id = $_POST['disclosure_id'];
    $edit_disclosure_type = $_POST['edit_disclosure_type'];
    $edit_actual_date = $_POST['edit_actual_date'];
    $edit_notes = $_POST['edit_notes'];

    
    $result = pg_query("UPDATE community_disclosures SET type_id=$edit_disclosure_type WHERE id=$disclosure_id");
    $result = pg_query("UPDATE community_disclosures SET actual_date='$edit_actual_date' WHERE id=$disclosure_id");
    $result = pg_query("UPDATE community_disclosures SET notes='$edit_notes' WHERE id=$disclosure_id");

    echo "<br><br><br><br><center><h3>Disclosure Updated.</h3></center>";

    echo "<br><br><center><a href='https://hoaboardtime.com/boardCommunityDisclosures.php'>Click here</a> if this page doenot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardCommunityDisclosures.php'},1000);</script>";

?>
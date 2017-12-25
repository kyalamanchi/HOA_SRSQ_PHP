<?php

	ini_set("session.save_path","/var/www/html/session/");

	session_start();

    $community_id = $_SESSION['hoa_community_id'];

    if($community_id == 1)
        pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
    else if($community_id == 2)
        pg_connect("host=srsq-only.crsa3tdmtcll.ussrsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $reminder_id = $_POST['reminder_id'];

    $result = pg_query("UPDATE reminders SET reminder_status_id=3 WHERE id=$reminder_id");

    if($result)
    	echo "<br><br><br><br><center><h3>Reminder Closed.</h3></center>";
    else
    	echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

    echo "<br><br><center><a href='https://hoaboardtime.com/viewReminders.php'>Click here</a> if this page doenot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/viewReminders.php'},1000);</script>";
?>
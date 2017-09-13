<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $reminder_id = $_POST['reminder_id'];

    $result = pg_query("DELETE FROM reminders WHERE id=$reminder_id");

    if($result)
    	echo "<br><br><br><br><center><h3>Reminder Deleted.</h3></center>";
    else
    	echo "<br><br><br><br><center><h3>Some error occured. Please try again.</h3></center>";

    echo "<br><br><center><a href='https://hoaboardtime.com/boardViewReminders.php'>Click here</a> if this page doenot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardViewReminders.php'},1000);</script>";
?>
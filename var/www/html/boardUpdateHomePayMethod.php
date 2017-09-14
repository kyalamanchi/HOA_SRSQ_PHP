<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $home_id = $_POST['home_id'];
    $hoa_id = $_POST['hoa_id'];
    $home_pay_method = $_POST['edit_home_pay_method'];

    $result = pg_query("UPDATE home_pay_method SET payment_type_id=$home_pay_method WHERE home_id=$home_id AND hoa_id=$hoa_id");

    if($result)
    	echo "<br><br><br><center><h3>Home Pay Method Updated.</h3></center>";
    else
    	echo "<br><br><br><center><h3>Some error occured. Please try again.</h3></center>";


    echo "<center><a href='https://hoaboardtime.com/boardHOAHomeInfo.php'>Click here</a> if this page doesnot redirect automatically in 5 seconds.</center><script>setTimeout(function(){window.location.href='https://hoaboardtime.com/boardHOAHomeInfo.php'},1000);</script>";

?>
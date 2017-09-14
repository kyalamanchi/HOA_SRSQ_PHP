<?php

	session_start();

    pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

    $home_id = $_POST['home_id'];
    $hoa_id = $_POST['hoa_id'];
    $home_pay_method = $_POST['edit_home_pay_method'];

    echo $home_id." - - - ".$hoa_id." - - - ".$home_pay_method;

?>
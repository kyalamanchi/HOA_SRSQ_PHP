<?php

	session_start();

	$community_id = $_SESSION['hoa_community_id'];

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	header ( "Content-Type: application/vnd.x-pdf" );
    header ( "Content-disposition: attachment; filename=".$_SESSION['hoa_community_code']."-Mailing_List-_".date('m-d-Y H:i:s').".pdf" );
    header ( "Content-Type: application/force-download" );
    header ( "Content-Transfer-Encoding: binary" );
    header ( "Pragma: no-cache" );
    header ( "Expires: 0" );

    echo ('Hello World');

?>
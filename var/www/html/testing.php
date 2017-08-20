<?php

	
    session_start();

	$community_id = $_SESSION['hoa_community_id'];

	pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");

	
	$year = date("Y");
    $month = date("m");
    $end_date = date("t");

    $home_id = $_REQUEST['home_id'];#$_SESSION['hoa_home_id'];
    $hoa_id = $_REQUEST['hoa_id'];#$_SESSION['hoa_hoa_id'];

    $row = pg_fetch_assoc(pg_query("SELECT * FROM community_info WHERE community_id=$community_id"));

    $city = $row['payment_city'];
    $c_name = $row['legal_name'];
    $pobox = $row['remit_payment_address'];
    $state = $row['payment_addr_state'];
    $zip = $row['payment_addr_zip'];
    $tax_id = $row['taxid'];
    $c_email = $row['email'];
    $c_website = $row['community_website_url'];


    $result = pg_query("SELECT * FROM current_charges WHERE home_id=".$home_id." ORDER BY assessment_date DESC LIMIT 1");

    $row = pg_fetch_assoc($result);
    $adate = $row['assessment_date'];

    $adate = date("m-d-y", strtotime($adate));

    if(date("m", strtotime($adate)) == date("m"))
    	$month = date("m"); 
    else if(date("m", strtotime($adate)) < date("m")) 
    	$month = date("m")-1; 
    else if(date("m", strtotime($adate)) > date("m")) 
    	$month = date("m")+1; 

    $ddate = $month."-15-".date("y");
    $ddate = date("d-m-y", strtotime($ddate));


    require("fpdf/fpdf.php");


    header ( "Content-Type: application/vnd.x-pdf" );
    header ( "Content-disposition: attachment; filename=Testing_PDF-_".date('m-d-Y H:i:s').".pdf" );
    header ( "Content-Type: application/force-download" );
    header ( "Content-Transfer-Encoding: binary" );
    header ( "Pragma: no-cache" );
    header ( "Expires: 0" );


    $pdf = new FPDF();
    $pdf->AddPage();


    $pdf->SetFont("Arial", "", 12);


    $pdf->Cell(100, 6, "From :", 0, 1, L);


    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(100, 6, "Stoneridge Square Association", 0, 0, L);
    $pdf->SetFont("Arial", "", 12);
    $pdf->Cell(85, 6, "Invoice No : ".$community_id."-".$home_id."-".$hoa_id."-".$year, 0, 1, R);


    $pdf->Cell(100, 6, "PO Box 101901", 0, 0, L);
    $pdf->Cell(85, 6, "Invoice Date : ".$adate, 0, 1, R);


    $pdf->Cell(100, 6, "Pasadena, CA 91189", 0, 0, L);
    $pdf->Cell(85, 6, "Due Date : ".$ddate, 0, 1, R);


    $pdf->Cell(189, 6, " ", 0, 1);
    $pdf->Cell(189, 6, " ", 0, 1);
    $pdf->Cell(189, 6, " ", 0, 1);


    $pdf->Cell(100, 6, "To :", 0, 1, L);


    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(100, 6, "Krishna Yalamanchi", 0, 1, L);
    $pdf->SetFont("Arial", "", 12);


    $pdf->Cell(100, 6, "2751 Chocolate Street", 0, 1, L);
    $pdf->Cell(100, 6, "Pleasanton, CA 94588", 0, 1, L);


    $pdf->Cell(189, 6, " ", 0, 1);
    $pdf->Cell(189, 6, " ", 0, 1);
    $pdf->Cell(189, 6, " ", 0, 1);


    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(40, 6, "Month", 0, 0);
    $pdf->Cell(40, 6, "Description", 0, 0);
    $pdf->Cell(40, 6, "Charge", 0, 0);
    $pdf->Cell(40, 6, "Payment", 0, 0);
    $pdf->Cell(40, 6, "Balance", 0, 1);
    $pdf->SetFont("Arial", "", 12);


    $pdf->output();


?>
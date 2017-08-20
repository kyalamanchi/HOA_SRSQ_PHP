<?php

	
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
    $pdf->Cell(85, 6, "Invoice No : 2-254-1259-2017", 0, 1, R);


    $pdf->Cell(100, 6, "PO Box 101901", 0, 0, L);
    $pdf->Cell(85, 6, "Invoice Date : 08-20-2017", 0, 1, R);


    $pdf->Cell(100, 6, "Pasadena, CA 91189", 0, 0, L);
    $pdf->Cell(85, 6, "Due Date : 08-15-17", 0, 1, R);


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
    $pdf->Cell(20, 6, "Month", 0, 0);
    $pdf->Cell(20, 6, "Description", 0, 0);
    $pdf->Cell(20, 6, "Charge", 0, 0);
    $pdf->Cell(20, 6, "Payment", 0, 0);
    $pdf->Cell(20, 6, "Balance", 0, 1);
    $pdf->SetFont("Arial", "", 12);


    $pdf->output();


?>
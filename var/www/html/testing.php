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

    $pdf->SetFont("Arial", "B", 16);

    $pdf->Cell(185, 6, "Invoice 2-1234123", 0, 1, C);
    $pdf->Cell(185, 6, " ", 0, 1, C);
    $pdf->Cell(185, 6, "Good?", 1, 1, C);

    $pdf->output();

?>
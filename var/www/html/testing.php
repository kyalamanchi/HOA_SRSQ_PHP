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

    $pdf->Cell(185, 6, "Invoice 2-1234123-2017", 0, 1, C);

    $pdf->SetFont("Arial", "", 12);

    $pdf->Cell(185, 6, " ", 0, 1, C);
    $pdf->Cell(100, 6, "Krishna Yalamanchi", 0, 0, L);
    $pdf->Cell(80, 6, "Date : 08-20-2017", 0, 1, R);
    $pdf->Cell(100, 6, "2751 Chocolate Street", 0, 1, L);

    $pdf->output();

?>
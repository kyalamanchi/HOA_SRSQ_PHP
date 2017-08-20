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

    $pdf->Cell(10, 10, "Hello world", 0, 0, C);

    $pdf->output();

?>
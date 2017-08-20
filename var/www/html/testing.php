<?php

	
    require("fpdf/fpdf.php");

    header ( "Content-Type: application/vnd.x-pdf" );
    header ( "Content-Type: application/force-download" );

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->output();

?>
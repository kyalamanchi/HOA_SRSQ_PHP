<?php

	
    require("fpdf/fpdf.php");


    $pdf = new FPDF();
    $pdf->AddPage('p', 'mm', 'A4');


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


    $pdf->Cell(85, 6, " ", 0, 1, R);
    $pdf->Cell(85, 6, " ", 0, 1, R);
    $pdf->Cell(85, 6, " ", 0, 1, R);


    $pdf->Cell(100, 6, "To :", 0, 1, L);


    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(100, 6, "Krishna Yalamanchi", 0, 1, L);
    $pdf->SetFont("Arial", "", 12);


    $pdf->Cell(100, 6, "2751 Chocolate Street", 0, 1, L);
    $pdf->Cell(100, 6, "Pleasanton, CA 94588", 0, 1, L);


    $pdf->Cell(85, 6, " ", 0, 1, R);
    $pdf->Cell(85, 6, " ", 0, 1, R);
    $pdf->Cell(85, 6, " ", 0, 1, R);


    $pdf->SetFont("Arial", "B", 12);
    $pdf->Cell(20, 5, "Month", 0, 0);
    $pdf->Cell(20, 5, "Document ID", 0, 0);
    $pdf->Cell(20, 5, "Description", 0, 0);
    $pdf->Cell(20, 5, "Charge", 0, 0);
    $pdf->Cell(20, 5, "Payment", 0, 0);
    $pdf->Cell(20, 5, "Balance", 0, 1);
    $pdf->SetFont("Arial", "", 12);


    $pdf->output();


?>
<?php
    if( file_get_contents('mc_table.php') ){
        echo "Found file";
    }
    else{
        echo "Could not load file";
    }
    // require('mc_table.php');
    // $pdf = new PDF_MC_Table();
    // $pdf->AddPage();
    // $pdf->MultiCell(0,6,'Looooooooong messasasasasasas',0,'0',false);
    // $pdf->SetFont("Arial", "", 12);


    // $pdf->Cell(100, 6, "From :", 0, 1, L);


    // $pdf->SetFont("Arial", "B", 12);
    // $pdf->Cell(100, 6, $c_name, 0, 0, L);
    // $pdf->SetFont("Arial", "", 12);
    // $pdf->Cell(85, 6, "Invoice No : ".$community_id."-".$home_id."-".$hoa_id."-".$year, 0, 1, R);


    // $pdf->Cell(100, 6, $pobox, 0, 0, L);
    // $pdf->Cell(85, 6, "Invoice Date : ".$adate, 0, 1, R);


    // $pdf->Cell(100, 6, $city.", ".$state." ".$zip, 0, 0, L);
    // $pdf->Cell(85, 6, "Due Date : ".$ddate, 0, 1, R);


    // $pdf->Cell(189, 6, " ", 0, 1);
    // $pdf->Cell(189, 6, " ", 0, 1);
    // $pdf->Cell(189, 6, " ", 0, 1);


    // $pdf->Cell(100, 6, "To :", 0, 1, L);


    // $pdf->SetFont("Arial", "B", 12);
    // $pdf->Cell(100, 6, $cus_name, 0, 1, L);
    // $pdf->SetFont("Arial", "", 12);


    // $pdf->Cell(100, 6, $cus_addr, 0, 1, L);
    // $pdf->Cell(100, 6, $cus_city.", ".$cus_state." ".$cus_zip, 0, 1, L);


    // $pdf->Cell(189, 6, " ", 0, 1);


    // $pdf->SetFont("Arial", "B", 10);
    // $pdf->Cell(20, 6, "Month", 0, 0);
    // $pdf->Cell(30, 6, "Document ID", 0, 0);
    // $pdf->Cell(80, 6, "Description", 0, 0);
    // $pdf->Cell(20, 6, "Charge", 0, 0);
    // $pdf->Cell(20, 6, "Payment", 0, 0);
    // $pdf->Cell(40, 6, "Total", 0, 1);
    // $pdf->SetFont("Arial", "", 10);


    // for($m = 1; $m <= 12; $m++)
    // {

    //     $last_date = date("Y-m-t", strtotime("$year-$m-1"));
                          
    //     $charges_results = pg_query("SELECT * FROM current_charges WHERE home_id=$home_id AND hoa_id=$hoa_id AND assessment_date>='$year-$m-1' AND assessment_date<='$last_date' ORDER BY assessment_date");

    //     $payments_results = pg_query("SELECT * FROM current_payments WHERE home_id=$home_id AND hoa_id=$hoa_id AND process_date>='$year-$m-1' AND process_date<='$last_date' ORDER BY process_date");

    //     $pdf->SetFillColor(247,248,249);
    //     $pdf->SetTextColor(0);

    //     $month_charge = 0.0;

    //     while($charges_row = pg_fetch_assoc($charges_results))
    //     {

    //         $month_charge += $charges_row['amount'];
    //         $tdate = $charges_row['assessment_date'];
    //         $desc = $charges_row['assessment_rule_type_id'];

    //         $r = pg_fetch_assoc(pg_query("SELECT * FROM assessment_rule_type WHERE assessment_rule_type_id=$desc"));
    //         $desc = $r['name'];

    //         $pdf->Cell(20, 5, date('F', strtotime($tdate)), 0, 0, 'L');
    //         $pdf->Cell(30, 5, $charges_row['id']."-".$charges_row['assessment_rule_type_id'], 0, 0, 'L');
    //         $pdf->Cell(80, 5, date('m-d-y', strtotime($tdate))." | ".$desc, 0, 0, 'L');
    //         $pdf->Cell(20, 5, "$ ".$charges_row['amount'], 0, 0, 'L');
    //         $pdf->Cell(20, 5, " ", 0, 0, 'L');
    //         $pdf->Cell(40, 5, "$ ".$month_charge, 0, 1, 'L');

    //     }       
        
    //     $month_payment = 0.0;
    //     $fill = true;

    //     while($payments_row = pg_fetch_assoc($payments_results))
    //     {

    //         $month_payment += $payments_row['amount'];
    //         $tdate = $payments_row['process_date'];

    //         $pdf->Cell(20, 5, date('F', strtotime($tdate)), 0, 0, 'L');
    //         $pdf->Cell(30, 5, $payments_row['id']."-".$payments_row['payment_type_id'], 0, 0, 'L');
    //         $pdf->Cell(80, 5, date('m-d-y', strtotime($tdate))." | Payment Received # ".$payments_row['document_num'], 0, 0, 'L');
    //         $pdf->Cell(20, 5, " ", 0, 0, 'L');
    //         $pdf->Cell(20, 5, "$ ".$payments_row['amount'], 0, 0, 'L');
    //         $pdf->Cell(40, 5, "$ ".$month_payment, 0, 1, 'L');
    //     }

    // }

    // $pdf->SetFont("Arial", "B", 10);
    // $pdf->Cell(20, 6, "", 0, 0);
    // $pdf->Cell(30, 6, "", 0, 0);
    // $pdf->Cell(80, 6, "Total", 0, 0);
    // $pdf->Cell(20, 6, "$ ".$total_charges, 0, 0);
    // $pdf->Cell(20, 6, "$ ".$total_payments, 0, 0);
    // $pdf->Cell(40, 6, "$ ".$total, 0, 1);
    // $pdf->SetFont("Arial", "", 10);


    // $pdf->Cell(189, 6, " ", 0, 1);


    // $pdf->SetFont("Arial", "B", 10);
    // $pdf->Cell(100, 6, "Note", 0, 1, L);
    // $pdf->SetFont("Arial", "", 10);


    // $pdf->Cell(100, 6, "BillPay Address : ", 0, 1, L);
    // $pdf->SetFont("Arial", "B", 10);
    // $pdf->Cell(100, 6, $c_name, 0, 1, L);
    // $pdf->SetFont("Arial", "", 10);
    // $pdf->Cell(100, 6, $pobox, 0, 1, L);
    // $pdf->Cell(100, 6, $city.", ".$state." ".$zip, 0, 1, L);
    // $pdf->Cell(100, 6, "EIN : ".$tax_id, 0, 1, L);


    // $pdf->Cell(189, 6, " ", 0, 1);
    

    // $pdf->Cell(100, 6, "Send an email to ".$c_email." for HOA related queries", 0, 1, L);
    // $pdf->Cell(100, 6, "All updates will be posted at ".$c_website, 0, 1, L);


    // $pdf->output();


?>
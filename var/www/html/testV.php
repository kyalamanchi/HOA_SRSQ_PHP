<?php
date_default_timezone_set('America/Los_Angeles');
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
try{
if ( $connection ){
    $inspectionNoticeQuery= "SELECT * FROM INSPECTION_NOTICES WHERE ID=".$_GET['id'];
    $inspectionNoticeQueryResult = pg_query($inspectionNoticeQuery);
    while ($row = pg_fetch_assoc($inspectionNoticeQueryResult)) {
        $insideData = array();
        array_push($insideData, $row);  
    }
    $inspectionTypeDetails = array();
    $inspectionTypeQuery = "SELECT * FROM INSPECTION_NOTICE_TYPE";
    $inspectionTypeQueryResult = pg_query($inspectionTypeQuery);
    while ($row = pg_fetch_assoc($inspectionTypeQueryResult)) {
        $inspectionTypeDetails[$row['id']] = $row['name'];
    }
    $homeQuery = "SELECT * FROM HOMEID";
    $homeQueryResult = pg_query($homeQuery);
    $homeDetails = array();
    while ($row = pg_fetch_assoc($homeQueryResult)) {
        $homeDetails[$row['home_id']] = $row['address1'];
        $livingStatus = $row['living_status'];
    }
    $inspectionNoticeInfo = array("InspectionData"=>$insideData);
    $inspectionNoticeInfo = json_encode($inspectionNoticeInfo);
    $inspectionNoticeInfo = json_decode($inspectionNoticeInfo);
    foreach ($inspectionNoticeInfo->InspectionData as $key) {
        $accountNumber = $key->hoa_id;
        $communityID = $key->community_id;
        $propertyAddress = $homeDetails[$key->home_id];
        $violationID = $key->id;
        $homeIDValue = $key->home_id;
        $inspectionType = $inspectionTypeDetails[$key->inspection_notice_type_id];
        $inspectionDoneDate = $key->inspection_date;
        $locationFound = $key->location_id;

    }
    $homeIDQuery = "SELECT * FROM HOMEID WHERE HOME_ID=".$homeIDValue;
    $homeIDQueryResult = pg_query($homeIDQuery);

    while ($row = pg_fetch_assoc($homeIDQueryResult)) {
        $homeAddress1 = $row['address1'];
        $homeAddress2 = $row['city_id'];
        $homeAddress3 = $row['state_id'];
        $homeAddress4 = $row['zip_id'];
    }
    $hoaIDQuery = "SELECT * FROM HOAID WHERE HOA_ID=".$accountNumber;
    $hoaIDQueryResult = pg_query($hoaIDQuery);
    while ($row = pg_fetch_assoc($hoaIDQueryResult)) {
        $firstName  = $row['firstname'];
        $lastName = $row ['lastname'];
    }
    $communityQuery = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$communityID;
    $communityQueryResult = pg_query($communityQuery);
    $cityInfoQuery = "SELECT * FROM CITY";
    $cityInfoQueryResult = pg_query($cityInfoQuery);
    $cityDetails = array();
    while ($row = pg_fetch_assoc($cityInfoQueryResult)) {
        $cityDetails[$row['city_id']] = $row['city_name'];
    }
    $stateDetails = array();
    $stateQuery= "  SELECT * FROM STATE";
    $stateQueryResult = pg_query($stateQuery);
    while ($row = pg_fetch_assoc($stateQueryResult)) {
        $stateDetails[$row['state_id']] =  $row['state_code'];
    }
    $zipDetails = array();
    $zipQuery = "SELECT * FROM ZIP";
    $zipQueryResult = pg_query($zipQuery);
    while ($row = pg_fetch_assoc($zipQueryResult)) {
        $zipDetails[$row['zip_id']] = $row['zip_code'];
    }
    while ($row = pg_fetch_assoc($communityQueryResult)) {
        $communityCode = $row['community_code'];
        $communityLegalName = $row['legal_name'];
        $communityMailingAddress = $row['mailing_address'];
        $communityMailingAddress2 = $cityDetails[$row['mailing_addr_city']];
        $communityMailingAddress3 = $stateDetails[$row['mailing_addr_state']];
        $communityMailingAddress4 = $zipDetails[$row['mailing_addr_zip']];
    }
    $locationQuery = "SELECT * FROM LOCATIONS_IN_COMMUNITY ";
    $locationQueryResult = pg_query($locationQuery);
    $locationDetails = array();
    while ($row = pg_fetch_assoc($locationQueryResult)) {
            $locationDetails[$row['location_id']] = $row['location'];
    }
    $inspectionSubjectQuery = "SELECT * FROM INSPECTION_NOTICE_SUBJECT WHERE ID=1";
    $inspectionSubjectQueryResult = pg_query($inspectionSubjectQuery);
    $row = pg_fetch_assoc($inspectionSubjectQueryResult);
    $inspectionSubjectFinal =$row['desc'];
    if( file_get_contents('mc_table.php') ){
        require('mc_table.php');
        $pdf = new PDF_MC_Table();
        $pdf->AddPage();
        $pdf->SetTextColor(0,0,128);
        $pdf->Ln();
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',8);
        try{
        $pdf->MultiCell(0,6,'Place name',0,'0',false);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(0,3,$communityMailingAddress."\n".$communityMailingAddress2."\n".$communityMailingAddress3." ".$communityMailingAddress4,0,'0',false);
        $pdf->Ln();
        }
         catch(Exception $ex)   {
            print_r($ex->getMessage());
        }
        $pdf->output();
    }
    else{
        echo "Could not load file";
    }

}
else {
    echo "Failed to connect to database";
}
}
catch (Exception $exe){
    print_r($exe->getMessage());
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
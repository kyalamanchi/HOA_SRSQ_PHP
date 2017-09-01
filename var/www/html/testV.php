<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
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
        $pdf->MultiCell(0,6,$communityLegalName,0,'0',false);
        $pdf->SetFont('Arial','',8);
        $pdf->MultiCell(0,3,$communityMailingAddress."\n".$communityMailingAddress2."\n".$communityMailingAddress3." ".$communityMailingAddress4,0,'0',false);
        $pdf->Ln();
        $pdf->SetX(113);
$pdf->SetWidths(array(40,50));
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Row(array('Account Number',$accountNumber));
$pdf->SetX(113);
$pdf->Row(array('Community ID',$communityCode));
$pdf->SetX(113);
$pdf->Row(array('Property Address',$propertyAddress));
$pdf->SetX(113);
$pdf->Row(array('Violation Notice ID',$violationID));
$pdf->SetX(113);
$pdf->Row(array('Notice Type', $inspectionType));
$pdf->Ln();
$pdf->SetY(52.5);
$pdf->MultiCell(0,6,$firstName." ".$lastName." OR Current Resident",0,'0',false);
$pdf->SetFont('','',9);
$pdf->MultiCell(0,3.5,$homeAddress1."\n".$cityDetails[$homeAddress2].", ".$stateDetails[$homeAddress3].",".$zipDetails[$homeAddress4]."\n\n\n".date('M d,Y',strtotime($inspectionDoneDate))."",0,'0',false);
$pdf->SetFont('','B',9);
$pdf->MultiCell(0,3.5,"\n\nRE: ".$inspectionSubjectFinal." ",0,'0',false);
$pdf->SetFont('','',9);
$pdf->MultiCell(0,3.5,"\n\nDear ".$firstName." ".$lastName." OR Current Resident:\n\n".$communityLegalName." is a planned community governed by covenants, conditions and restrictions. Compliance with these rules benefits the entire community and all property owners are responsible for protecting the aesthetics and harmony of the neighborhood.
\n\nBy now you have probably already corrected the following issue at ".$homeAddress1.". If not, then this is a courtesy reminder from Stoneridge Square.\n\nIt has been reported or observed during a routine site inspection on ".date('m/d/y',strtotime($inspectionDoneDate))." that the property was out of compliance with the community rules and regulations.",0,'0',false);
$pdf->WriteHTML("<br><b> This violation specifically regards the following item(s): ".$inspectionSubjectFinal."</b>. It was noted that this violation occurred in the following location: ".$locationDetails[$locationFound].".<br><br>The Governing Documents, specifically<b> Rules and Regulations, Section 5.13 (3) </b>of the Declaration of Covenants, Conditions, and Restrictions (Deed Restrictions) for Stoneridge Square Association states, in part:");
$pdf->Ln();
$pdf->WriteHTML('<br><i>Trash cans, refuse containers and recycling containers shall be stored within the garage or screened from view by an appropriate fence in a side yard area except on pick-up day when such containers may be relocated to pick-up areas designated by the City for such purposes. All such containers shall be removed from public view by the end of the day of refuse pick-up provided by the waste disposal service company.</i><br><br>If you have already corrected the issue noted above, please disregard this courtesy notice, since no further action is required.<br><br>Thank you for your cooperation in maintaining the appearance and value of Stoneridge Square. If you have any questions, please contact us via our Resident Portal at <a href="https://hoaboardtime.com">https://hoaboardtime.com</a><br><br>'.$communityLegalName);
        }
         catch(Exception $ex)   {
            print_r($ex->getMessage());
        }
        // $pdf->output();
        $pdf->Output('data.pdf','F');
        if (file_get_contents('data.pdf')){

        }
        else {
            echo "File not found";
        }
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
   

?>
<br>
<br>
<center>
<div>
<button type="button" class="btn btn-primary" onclick="generateForSouthData();">Generate for South Data</button><br><br>
</div>
</center>
<embed src="data.pdf" width="100%" height="100%"></embed>
</body>
</html>

<?php
header("Content-Type: text/event-stream\n\n");
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('fpdf/fpdf.php');
$pageNumber = -1;
$finalHOAID = -1;
$finalHOMEID = -1;
$finalAddress1= "";
$finalAddress2= "";
$finalAddress3 = "";
$finalAddress4 = "";
$finalAddress5 = "";
$finalreturnAddress1 = "";
$finalreturnAddress2 = "";
$finalreturnAddress3 = "";
$finalreturnAddress4 = "";
$finalPayee = "";
ini_set('memory_limit', '-1');
date_default_timezone_set('America/Los_Angeles');
$currentChargesTotal  = 0;
$currentPaymentsTotal = 0;
$lastData  = array();
$connection = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy")
or die("Failed to connect to database");
$cityInfo = array();
$stateInfo = array();
$zipInfo = array();
$cityQ = "SELECT * FROM CITY";
$cityR = pg_query($cityQ);
$stateQ = "SELECT * FROM STATE";
$stateR = pg_query($stateQ);
$zipQ = "SELECT * FROM ZIP";
$zipR = pg_query($zipQ);
while( $row = pg_fetch_assoc($cityR)){
$cityInfo[$row['city_id']] = $row['city_name'];
}
while ($row = pg_fetch_assoc($stateR)) {
    $stateInfo[$row['state_id']] = $row['state_code'];
}
while($row = pg_fetch_assoc($zipR)){
$zipInfo[$row['zip_id']] = $row['zip_code'];
}
class PDF extends FPDF
{
function ImprovedTable($header, $data,$currentChargesTotal2,$currentPaymentsTotal2,$homeID,$connection,$zipInfo,$stateInfo,$cityInfo,$commID)
{
    global $pageNumber,$finalHOAID,$finalHOMEID,$finalAddress1,$finalAddress2,$finalAddress3,$finalAddress4,$finalAddress5,$finalreturnAddress1,$finalreturnAddress2,$finalreturnAddress3,$finalreturnAddress4,$finalPayee;
    if( $homeID < 144){
        $commID = 1;
    }
    else if ( $homeID > 287 ){
        $commID = 2;
    }
    $z = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID = ".$commID;
    $g = pg_query($z);
    
    while ($row = pg_fetch_assoc($g)) {
        $communityLegalName =  $row['legal_name'];
        $communityRemitPaymentAddress = $row['remit_payment_address'];
        $communityPaymentCity = $row['payment_city'];
        $communityPaymentState = $row['payment_addr_state'];
        $communityPaymentZip = $row['payment_addr_zip'];
        $communityFinalReturnAddress = $row['legal_name'];
        $communityFinalReturnAddress2 = $row['mailing_address'];
        $communityFinalReturnAddress3 = $row['mailing_addr_city'];
        $communityFinalReturnAddress4 = $row['mailing_addr_state'];
        $communityFinalReturnAddress5 = $row['mailing_addr_zip'];
    }

    $q = "SELECT * FROM HOAID WHERE HOME_ID=".$homeID;
    $r = pg_query($connection,$q);
    $status = true;
    while($row = pg_fetch_assoc($r)){
        $hoaID = $row['hoa_id'];
        $fname = $row['firstname'];
        $lname = $row['lastname'];
    }
    $q2 = "SELECT * FROM HOMEID WHERE HOME_ID=".$homeID."";
    $r2 = pg_query($connection,$q2);
    while ($row = pg_fetch_assoc($r2)) {
        $status = $row['living_status'];
        if ( ($status == 'true') || ($status == 'TRUE') || ($status == 't') ){
            $address = $row['address1'];
            $cityId = $row['city_id'];
            $stateId = $row['state_id'];
            $zipId = $row['zip_id'];
        }
        else {
        $q3 = "SELECT * FROM HOME_MAILING_ADDRESS WHERE HOME_ID=".$homeID;
        $r3 = pg_query($connection,$q3);
        if ( $r3 ){
            while ($row = pg_fetch_assoc($r3)) {
            $address = $row['address1'];
            $cityId = $row['city_id'];
            $stateId = $row['state_id'];
            $zipId = $row['zip_id'];
            }
        }
    }
    }
    
    $finalHOAID = $hoaID;
    $finalHOMEID  = $homeID;
    $finalAddress1 = $fname.' '.$lname;
    $finalAddress2 = $address;
    $finalAddress3 = $cityInfo[$cityId];
    $finalAddress4 = $stateInfo[$stateId].' '.$zipInfo[$zipId];
    $finalAddress5 ="";
    $finalreturnAddress1 = $communityFinalReturnAddress;
    $finalreturnAddress2 = $communityFinalReturnAddress2;
    $finalreturnAddress3 = $cityInfo[$communityFinalReturnAddress3];
    $finalreturnAddress4 = $stateInfo[$communityFinalReturnAddress4]." ".$zipInfo[$communityFinalReturnAddress5];
    $finalPayee = $communityFinalReturnAddress;
    $this->Multicell(0,4,"Invoice No : 1-".$homeID."-".$hoaID."-".date('Y')."\nInvoice Date : ".date('Y-m-d')."\nDue Date : ".date('Y-m-'.'15')."\n\n",0,"R");
    $this->Multicell(80,4,"From:\n".$communityLegalName."\n".$communityRemitPaymentAddress."\n".$cityInfo[$communityPaymentCity].", ".$stateInfo[$communityPaymentState]." ".$zipInfo[$communityPaymentZip]."\n\n",0,"LRTB");
    $this->Multicell(80,4,"To:\n".$fname." ".$lname."\n".$address."\n".$cityInfo[$cityId].", ".$stateInfo[$stateId]." ".$zipInfo[$zipId]."\n",0,"LRTB");
    $f = array(0,0);
    $this->Ln();
	$this->SetLineWidth(.0);
	$this->SetFont('','B');
    $w = array(15,25,75, 25,25,25);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],0,0,'L');
    $this->Ln();
    $this->SetFillColor(247,248,249);
    $this->SetTextColor(0);
    $this->SetFont('');
    $fill  = true;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],0,0,'L',$fill);
        $this->Cell($w[1],6,$row[1],0,0,'L',$fill);
        $this->Cell($w[2],6,($row[2]),0,0,'L',$fill);
        $this->Cell($w[3],6,($row[3]),0,0,'L',$fill);
        $this->Cell($w[4],6,($row[4]),0,0,'L',$fill);
        $this->Cell($w[5],6,($row[5]),0,0,'L',$fill);
        $this->Ln();
        $fill  = !$fill;
    }
    $this->Cell(array_sum($w),0,'','T');
    $this->Ln();
    $this->SetFont('','B');
    $data3 = array();
    $data2 = array();
    array_push($data2, '');
    array_push($data2, '');
    array_push($data2, 'Total');
    array_push($data2, '$ '.$currentChargesTotal2);
    array_push($data2, '$ '.$currentPaymentsTotal2);
    array_push($data2, '$ '.($currentChargesTotal2-$currentPaymentsTotal2));
    array_push($data3, $data2);
    $fill = false;
    foreach ($data3 as $row) {
        $this->Cell($w[0],6,$row[0],0,0,'L',$fill);
        $this->Cell($w[1],6,$row[1],0,0,'L',$fill);
        $this->Cell($w[2],6,($row[2]),0,0,'L',$fill);
        $this->Cell($w[3],6,($row[3]),0,0,'L',$fill);
        $this->Cell($w[4],6,($row[4]),0,0,'L',$fill);
        $this->Cell($w[5],6,($row[5]),0,0,'L',$fill);
        $this->Ln();
    }
    $this->Ln();
     $pageNumber = $this->PageNo();
}
}
$assesmentRuleTypeQurey = "SELECT * FROM ASSESSMENT_RULE_TYPE";
$assesmentRuleTypeQureyResult = pg_query($assesmentRuleTypeQurey);
$assesmentsRuleArray =  array();
while ($row = pg_fetch_assoc($assesmentRuleTypeQureyResult)) {
    $assesmentsRuleArray[$row['assessment_rule_type_id']] =  $row['name'];
}
$currentChargesTotal = 0;
$currentPaymentsTotal = 0;
$pdf = new PDF();
$header = array('Month', 'Document ID', 'Description', 'Charge','Payment','Balance');
$data = array();
$message  = "Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$query = "SELECT HOME_ID FROM HOMEID WHERE COMMUNITY_ID = 1 OR COMMUNITY_ID = 2 ORDER BY HOME_ID";
$queryResult = pg_query($query);
while ( $row = pg_fetch_assoc($queryResult)) {
$homeDS = $row['home_id'];
$query = "SELECT HOME_ID FROM HOAID WHERE HOA_ID=".$homeDS;
$queryResult = pg_query($query);
$row = pg_fetch_assoc($queryResult);
$homeDS = $row['home_id'];
$currentChargesQuery  = "SELECT * FROM CURRENT_CHARGES WHERE HOME_ID=".$homeDS." ORDER BY assessment_month , assessment_date";
$currentChargesQueryResult = pg_query($currentChargesQuery);
$monthsArray = array();
$currentChargesList = array();
array_push($monthsArray, 1);
array_push($monthsArray, 2);
array_push($monthsArray, 3);
array_push($monthsArray, 4);
array_push($monthsArray, 5);
array_push($monthsArray, 6);
array_push($monthsArray, 7);
array_push($monthsArray, 8);
array_push($monthsArray, 9);
array_push($monthsArray, 10);
array_push($monthsArray, 11);
array_push($monthsArray, 12);
while ($row = pg_fetch_assoc($currentChargesQueryResult)) {
	array_push($currentChargesList, $row);
}
$message  = "Fetching Payment Details...Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$currentPaymentsQuery = "SELECT * FROM CURRENT_PAYMENTS WHERE HOME_ID=".$homeDS." AND (payment_status_id=1 OR payment_status_id=6) ORDER BY process_date";
$currentPaymentsQueryResult = pg_query($currentPaymentsQuery);
$currentPaymentsArray = array();
while ($row = pg_fetch_assoc($currentPaymentsQueryResult)) {
    array_push($currentPaymentsArray, $row);	
}
foreach ($monthsArray as $key ) {
    $currentChoosenMonth = date('F', mktime(0, 0, 0, $key, 10));
    foreach ($currentChargesList as $key2 => $value2) {
        if ( (date('m',strtotime($value2['assessment_date']))) == $key ){
            $data2 = array();
            array_push($data2, $currentChoosenMonth);
            array_push($data2,$value2['id']-$value2['assesment_rule_type']);
            array_push($data2,$value2['assessment_date'].' | '.$assesmentsRuleArray[$value2['assessment_rule_type_id']]);
            array_push($data2,'$ '.$value2['amount']);
            array_push($data2,'');
            array_push($data2,'$ '.$value2['amount']);
            array_push($data,$data2);
            $currentChargesTotal = $currentChargesTotal + $value2['amount'];
        }
    }
    foreach ($currentPaymentsArray as $key2 => $value2) {
        if ( (date('m',strtotime($value2['process_date'])) == $key)  ){
            $data2 = array();
            array_push($data2, $currentChoosenMonth);
            array_push($data2,$value2['id']-$value2['payment_type_id']);
            array_push($data2,$value2['process_date'].' | '.'Payment Received #'.$value2['document_num']);
            array_push($data2,'');
            array_push($data2,'$ '.$value2['amount']);
            array_push($data2,'$ '.$value2['amount']);
            array_push($data,$data2);
            $currentPaymentsTotal = $currentPaymentsTotal + $value2['amount'];
        }
    }
}
$pdf->SetFont('Arial','',6);
$pdf->AddPage();
if ( $homeDS < 144 ){
    $commID  = 1;
}
else if( $homeDS < 287 ){
    $commID = 2;
}
$message  = "Generating Statement...Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
$pdf->ImprovedTable($header,$data,$currentChargesTotal,$currentPaymentsTotal,$homeDS,$connection,$zipInfo,$stateInfo,$cityInfo,$commID);
$pdf->Output($finalHOAID.'.pdf','F');
$handler = fopen($finalHOAID.'.tab', 'w');
$finalWriteData = "1"."\t".$finalAddress1."\t".$finalAddress2."\t".$finalAddress3." ".$finalAddress4." ".$finalAddress5."\t\t\t1\t".$pageNumber."\t".$finalHOAID.".pdf\t".$finalreturnAddress1."\t".$finalreturnAddress2." ".$finalreturnAddress3." ".$finalreturnAddress4."\t\t\t".$finalPayee;

fwrite($handler, $finalWriteData);
fclose($handler);
$zip = new ZipArchive;
if ($zip->open($finalHOAID.'.zip',  ZipArchive::CREATE)) {
$zip->addFile($finalHOAID.'.pdf', $finalHOAID.'.pdf');
$zip->addFile($finalHOAID.'.tab', $finalHOAID.'.tab');
$zip->close();
$message  = "Uploading Statement to Dropbox...Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
if ( $homeDS < 144 ){
$url = 'https://content.dropboxapi.com/2/files/upload';
$fileContents = file_get_contents($finalHOAID.'.pdf');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/Billing_Statements/SRP/'.date('Y').'/PDF/'.$finalHOAID.'.pdf'.'","mode": "overwrite","autorename": false,"mute": false}'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContents); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);
print('PDF Response'.$response.nl2br("\n"));
unlink($finalHOAID.'.pdf');
unlink($finalHOAID.'.tab');
}
else if ( $homeDS < 287 ){
    $url = 'https://content.dropboxapi.com/2/files/upload';
$fileContents = file_get_contents($finalHOAID.'.pdf');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/Billing_Statements/SRSQ/'.date('Y').'/PDF/'.$finalHOAID.'.pdf'.'","mode": "overwrite","autorename": false,"mute": false}'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContents); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);
print('PDF Response'.$response.nl2br("\n"));
unlink($finalHOAID.'.pdf');
unlink($finalHOAID.'.tab');

}
$message  = "Uploading Statement ZIP file to Dropbox...Please Wait...";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
if ( $homeDS < 144){
$url = 'https://content.dropboxapi.com/2/files/upload';
$fileContents = file_get_contents($finalHOAID.'.zip');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/Billing_Statements/SRP/'.date('Y').'/ZIP/'.$finalHOAID.'.zip'.'","mode": "overwrite","autorename": false,"mute": false}'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContents); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);
}
else if ( $homeDS < 287 ){
    $url = 'https://content.dropboxapi.com/2/files/upload';
$fileContents = file_get_contents($finalHOAID.'.zip');
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer n-Bgs_XVPEAAAAAAAAEQYgvfkzJWzxx59jqgvKQeXbtsYt-eXdZ6BNRYivEGKVGB','Content-Type:application/octet-stream','Dropbox-API-Arg: {"path": "/Billing_Statements/SRSQ/'.date('Y').'/ZIP/'.$finalHOAID.'.zip'.'","mode": "overwrite","autorename": false,"mute": false}'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fileContents); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);

}
print_r($response.nl2br("\n"));
unlink($finalHOAID.'.zip');
}
pg_close($connection);

$response = json_decode($response);

if ( $response ->id ){
$message  = "Upload Successful. Download will begin shortly.";
$id = $response ->id;
echo "id: $id\n";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}
else {
$message  = "An error occured. Please try again.";
echo 'data: '.$message."\n\n";  
ob_end_flush();
flush();
}
}
?>
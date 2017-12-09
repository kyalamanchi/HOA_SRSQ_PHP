<?php 

pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");

$srsqkey = "cYcxW-Z8ZPuaqPne1hFjrA";

$srpkey = "NRqC1Izl9L8aU-lgm_LS2A";

$query = "SELECT * FROM COMMUNITY_EMAILS_SENT WHERE COMMUNITY_ID = 1 AND API_MAIL_ID IS NOT NULL";

$queryResult = pg_query($query);

while ($row = pg_fetch_assoc($queryResult)) {

print_r($row['API_MAIL_ID']);
print_r(nl2br("\n\n"));
$sendData = array("key" => "NRqC1Izl9L8aU-lgm_LS2A","id" => $row['API_MAIL_ID']);

$sendData = json_encode($sendData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://mandrillapp.com/api/1.0/messages/content.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$sendData);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$result2  = json_decode($result);
if ( $result2->status == "error" ){
  print_r("An error ocuured");
}
else {
  print_r($result);
}
print_r($result);
  print_r(nl2br("\n\n"));
}




$query = "SELECT * FROM COMMUNITY_EMAILS_SENT WHERE COMMUNITY_ID = 2 AND API_MAIL_ID IS NOT NULL";

$queryResult = pg_query($query);

while ($row = pg_fetch_assoc($queryResult)) {

print_r($row['API_MAIL_ID']);
print_r(nl2br("\n\n"));

$sendData = array("key" => "cYcxW-Z8ZPuaqPne1hFjrA","id" => $row['API_MAIL_ID']);

$sendData = json_encode($sendData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://mandrillapp.com/api/1.0/messages/content.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$sendData);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
$result2  = json_decode($result);
if ( $result2->status == "error" ){
  print_r("An error ocuured");
}
else {
  print_r($result);
}
print_r($result);
  print_r(nl2br("\n\n"));
}





?>
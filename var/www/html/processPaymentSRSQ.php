<?php
$someJSON = file_get_contents('php://input');
$parsedJSON = json_decode($someJSON);
$customerID = $parsedJSON[0]->customer_id;
$authAmount = $parsedJSON[0]->auth_amount;
$name = $parsedJSON[0]->account_holder;
$names = explode(' ', $name);
$fname = $names[0];
$lname  = $names[1];
$rnumber = $parsedJSON[0]->routing_number;
$anumber =  $parsedJSON[0]->account_number;
$data = array("action" => "sale","customer_id" => $customerID ,"authorization_amount" => $authAmount,"billing_address" => array("first_name"=>$fname,"last_name" =>$lname),"echeck" => array( "sec_code" => "WEB","routing_number"=> $rnumber,"account_number" => $anumber,"account_holder" => $name));
$data_string = json_encode($data); 
$url = "https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Content-Length: ' . strlen($data_string),'X-Forte-Auth-Organization-Id:org_332536','Authorization:Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU='));
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);
if ( $result->response->response_desc){
	echo $result->response->response_desc;
}
else {
echo $result;
}

?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('America/Los_Angeles');

pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");


$data = file_get_contents('php://input');
$parseJSON = json_decode($data);

if ( $parseJSON[0]->type == "legal" ){
     $query = "SELECT * FROM DOC_MAPPING WHERE COMMUNITY_ID=".$parseJSON[0]->community_id." AND TABLE_NAME='legal_docs_type' AND SUB_CATEGORY='".$parseJSON[0]->sub_category."'";
     $queryResult = pg_query($query);   
     $row = pg_fetch_assoc($queryResult);

     $result = $row['name'].'@'.$row['short_desc'].'@'.date('m/d/Y',strtotime($row['valid_from'])).'@'.date('m/d/Y',strtotime($row['valid_until']));
     echo $result;

}
else if ( $parseJSON[0]->type == "disclosure" ){
     $query = "SELECT * FROM DOC_MAPPING WHERE COMMUNITY_ID=".$parseJSON[0]->community_id." AND TABLE_NAME='disclosure_type' AND SUB_CATEGORY='".$parseJSON[0]->sub_category."'";
     $queryResult = pg_query($query);   
     $row = pg_fetch_assoc($queryResult);
     $result = $row['name'].'@'.$row['short_desc'].'@'.date('m/d/Y',strtotime($row['valid_from'])).'@'.date('m/d/Y',strtotime($row['valid_until']));
     echo $result;

     $secondQuery = "SELECT * FROM community_disclosures where type_id=(select id from disclosure_type where name = '".$parseJSON[0]->sub_category."' and community_id=".$parseJSON[0]->community_id.") and community_id =".$parseJSON[0]->community_id;
     $secondQueryResult = pg_query($secondQuery);
     $row  = pg_fetch_assoc($secondQueryResult);
     if ( $row['id'] ){
          if ( $row['document_id'] ){
               echo "A file found".$row['document_id'];
          }
          else {
               echo "Not found";
          }
     }
}

?>
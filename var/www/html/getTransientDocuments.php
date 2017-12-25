<?php
$data = file_get_contents('php://input');
$connection = pg_pconnect("host=srsq-only.crsa3tdmtcll.ussrsq-only.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
$hoaidquery = "SELECT * FROM community_transient_documents WHERE community_id=2";
$query = pg_query($hoaidquery);
$libraryDocuments = array();
while ($row = pg_fetch_assoc($query)) {
	array_push($libraryDocuments, $row['document_name']);
}
echo json_encode($libraryDocuments);
?>
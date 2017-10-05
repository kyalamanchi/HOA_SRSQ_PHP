<?php
$connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");

if ( $connection){
    
    if ( $_GET['id'] == 1 ){
        echo "Message";
    $url = 'https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions?filter=customer_id+eq+1259&page_size=100000';
    $url = $url.$startDate;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json','x-forte-auth-organization-id: org_332536','authorization: Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU='));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     $result = curl_exec($ch);
     echo $result;
    }

    // $query = "SELECT   * FROM LOCATIONS_IN_COMMUNITY";
    // $queryRes = pg_query($query);
    // $locationsArray = array();
    // while ($row = pg_fetch_assoc($queryRes)) {
    //     $locationsArray[$row['location_id']] = $row['location'];
    // }
    // $categoryArray  = array();

    // $query = "SELECT * FROM INSPECTION_CATEGORY";
    // $queryRes  = pg_query($query);

    // while ($row = pg_fetch_assoc($queryRes)) {
    //     $categoryArray[$row['id']] = $row['name'];
    // }

    // $inspectionStatusArray = array();
    // $query = "SELECT * FROM INSPECTION_STATUS";
    // $queryRes  = pg_query($query);
    // while ($row = pg_fetch_assoc($queryRes)) {
    //     $inspectionStatusArray[$row['id']] = $row['inspection_status'];
    // }
    // $inspectionSubCategoryArray  = array();
    // $query = "SELECT * FROM INSPECTION_SUB_CATEGORY";
    // $queryResult = pg_query($query);
    // while ($row = pg_fetch_assoc($queryResult)) {
    //     $inspectionSubCategoryArray[$row['id']] = $row['name'];
    // }

    // if( $_GET['id']){
    //     $query =  "SELECT * FROM INSPECTION_NOTICES WHERE INSPECTION_STATUS_ID=".$_GET['id'];
    //     $queryResult = pg_query($query);
    //     $sendData = array();
    //     while ($row = pg_fetch_assoc($queryResult)) {
    //         $data = array();
    //         $data['id']  = $row['id'];
    //         $data['inspection_date'] = $row['inspection_date'];
    //         $data['description'] = $row['description'];
    //         $data['community_id'] = $row['community_id'];
    //         $data['home_id'] = $row['home_id'];
    //         $data['location_id'] = $locationsArray[$row['location_id']];
    //         $data['inspection_category_id'] = $categoryArray[$row['inspection_category_id']];
    //         $data['inspection_sub_category_id'] = $inspectionSubCategoryArray[$row['inspection_sub_category_id']];
    //         $data['hoa_id'] = $row['hoa_id'];
    //         $data['inspection_notice_type_id'] = $row['inspection_notice_type_id'];
    //         $data['inspection_status'] = $inspectionStatusArray[$row['inspection_status_id']];
    //         array_push($sendData, $data);
    //     }
    // }
    // else {
    //     $query =  "SELECT * FROM INSPECTION_NOTICES WHERE INSPECTION_STATUS_ID != 2 AND INSPECTION_STATUS_ID != 6 AND INSPECTION_STATUS_ID != 9 AND INSPECTION_STATUS_ID != 13 AND INSPECTION_STATUS_ID != 14";
    //     $queryResult = pg_query($query);
    //     $sendData = array();
    //     while ($row = pg_fetch_assoc($queryResult)) {
    //         $data = array();
    //         $data['id']  = $row['id'];
    //         $data['inspection_date'] = $row['inspection_date'];
    //         $data['description'] = $row['description'];
    //         $data['community_id'] = $row['community_id'];
    //         $data['home_id'] = $row['home_id'];
    //         $data['location_id'] = $locationsArray[$row['location_id']];
    //         $data['inspection_category_id'] = $categoryArray[$row['inspection_category_id']];
    //         $data['inspection_sub_category_id'] = $inspectionSubCategoryArray[$row['inspection_sub_category_id']];
    //         $data['hoa_id'] = $row['hoa_id'];
    //         $data['inspection_notice_type_id'] = $row['inspection_notice_type_id'];
    //         $data['inspection_status'] = $inspectionStatusArray[$row['inspection_status_id']];
    //         array_push($sendData, $data);
    //     }
    // }
}
echo json_encode($sendData);
?>
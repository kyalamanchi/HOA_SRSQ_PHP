<!DOCTYPE html>
<html>
    <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
        <title>Inspection Notices</title>
  <style >     
      .btn:hover {
        background-position: 0px;
    }
     input[type="radio"], input[type="radio"]+label img {
    vertical-align: middle;
  }
  </style>
  <script type="text/javascript">
//   window.onload = function(){
// var xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function() {
//     if (xhr.readyState == XMLHttpRequest.DONE) {
//         var jsonRespons = JSON.parse(xhr.responseText);
//        alert(jsonRespons);
//     }
//   }
//   xhr.open('GET', 'http://localhost/CA/getBoardEmails.php', true);
//   xhr.send(null);
//   }
  
  </script>
    </head>
    <body>
    <?php
  include 'includes/dbconn.php';
    if ( 1 == 1 ){
        $inspectionNoticeTypeQuery = "SELECT * FROM INSPECTION_NOTICE_TYPE";
        $inspectionNoticeTypeQueryResult = pg_query($inspectionNoticeTypeQuery);
        $inspectionNoticeTypeArray = array();
        while ($row = pg_fetch_assoc($inspectionNoticeTypeQueryResult)) {
            $inspectionNoticeTypeArray[$row['id']] = $row['name'];
        }
        $locationQuery = "SELECT * FROM LOCATIONS_IN_COMMUNITY";
        $locationQueryResult = pg_query($locationQuery);
        $locationArray = array();
        while ($row = pg_fetch_assoc($locationQueryResult)) {
            $locationArray[$row['location_id']] = $row['location'];
        }
        $inspectionCategory = "SELECT * FROM INSPECTION_CATEGORY";
        $inspectionSubCategory = "SELECT * FROM INSPECTION_SUB_CATEGORY";
        $inspectionCategoryResult = pg_query($inspectionCategory);
        $inspectionSubCategoryResult = pg_query($inspectionSubCategory);
        $inspectionCategoryArray = array();
        $inspectionSubCategoryArray = array();
        while ($row = pg_fetch_assoc($inspectionCategoryResult)) {
            $inspectionCategoryArray[$row['id']] = $row['name'];
        }
        while ($row = pg_fetch_assoc($inspectionSubCategoryResult)) {
            $inspectionSubCategoryArray[$row['id']] = $row['name'];
        }
        $hoaIDQuery = "SELECT * FROM HOAID WHERE COMMUNITY_ID = 2";
        $homeIDQuery = "SELECT * FROM HOMEID WHERE COMMUNITY_ID =2";
        $hoaIDQueryResult = pg_query($hoaIDQuery);
        $homeIDQueryResult = pg_query($homeIDQuery);
        $inspectionQuery = "SELECT * FROM INSPECTION_NOTICES WHERE COMMUNITY_ID=2";
        $inspectionQueryResult = pg_query($inspectionQuery);
        $insideData = array();
        while ($row = pg_fetch_assoc($inspectionQueryResult)) {
            
            array_push($insideData, $row);
        }
        $inspectionData = array("InspectionData"=>$insideData);
        $inspectionData = json_encode($inspectionData);
        $hoaIDArray = array();
        $namesArray = array();
        while ($row = pg_fetch_assoc($hoaIDQueryResult)) {
            $hoaIDArray[$row['hoa_id']] = $row['home_id'];
            $namesArray[$row['hoa_id']] = $row['firstname'].' '.$row['lastname'];
        }
        $homeIDArray = array();
        while ($row = pg_fetch_assoc($homeIDQueryResult)) {
            $homeIDArray[$row['home_id']] = $row['address1'];
        }
    }
  ?>
        <div class='splash'> 
            <div class='color-line'></div>
            <div class='splash-title'>
                <h1></h1>
                <div class='spinner'> 
                    <div class='rect1'></div>
                    <div class='rect2'></div>
                    <div class='rect3'></div> 
                    <div class='rect4'></div>
                    <div class='rect5'></div>
                </div>
            </div>
        </div>
        <h1> Inspection Notices</h1>
<hr>
<div class="container"> 
        <table id="example" class="table table-striped" cellspacing="0" width="100%" >
                                <thead>
                                    <tr>
                                       <center>
                                       <th>AccountNumber</th>
                                        <th>OwnerName</th>
                                        <th>PropertyAddress</th>
                                        <th>InspectDate</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Location</th>
                                        <th> Type </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                       </center>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                date_default_timezone_set('America/Los_Angeles');
                                $inspectionData = json_decode($inspectionData);
                                foreach ($inspectionData->InspectionData as $key) {
                                echo '<tr>';
                                echo '<td>';
                                echo $key->hoa_id;
                                echo '</td>';
                                echo '<td>';
                                echo $namesArray[$key->hoa_id];
                                echo '</td>';
                                echo '<td>';
                                echo $homeIDArray[$hoaIDArray[$key->hoa_id]];
                                echo '</td>';
                                echo '<td>';
                                if ($key->inspection_date )
                                echo date('Y-M-d',strtotime($key->inspection_date));
                                echo '</td>';
                                echo '<td>';
                                echo $inspectionCategoryArray[ $key->inspection_category_id];
                                echo '</td>';
                                echo '<td>';
                                echo $inspectionSubCategoryArray[$key->inspection_sub_category_id];
                                echo '</td>';
                                echo '<td>';
                                echo $locationArray[$key->location_id];
                                echo '</td>';
                                echo '<td>';
                                echo $inspectionNoticeTypeArray[$key->inspection_notice_type_id];
                                echo '</td>';
                                echo '<td>';
                                echo '<a href="http://localhost/testV.php?id='.$key->id.'"><input type="button" id="'.$key->id.'" value="Generate PDF" ></a>';
                                echo '</td>';
                                echo '<td>';
                                echo '</td>';
                                echo '<td>';
                                echo '</td>';
                                echo '</tr>';
                            }
                                ?>
        </tbody>
        </table>
        <br><br>
        <script type="text/javascript">
        $(document).ready(function() {
              $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'My button',
                action: function ( e, dt, node, config ) {
                    alert( 'Button activated' );
                }
            }
            ]
            } ); 
            var table = $('#example').DataTable({
            dom: 'l<"toolbar">frtip',
            initComplete: function(){
            $('.datatable').dataTable({
                "sPaginationType": "bs_four_button"
            }); 
            $('.datatable').each(function(){
                var datatable = $(this);
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.addClass('form-control input-sm');
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.addClass('form-control input-sm');
            });
        </script>
        <script src='vendor/slimScroll/jquery.slimscroll.min.js'></script>
        <script src='vendor/metisMenu/dist/metisMenu.min.js'></script>
        <script src='scripts/homer.js'></script>
        <script src='//code.jquery.com/jquery-1.12.4.js'></script>
        <script src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js'></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();
            } );
        </script> 
<script type="text/javascript">
    function changeState(el) {
        if (el.readOnly) el.checked=el.readOnly=false;
        else if (!el.checked) el.readOnly=el.indeterminate=true;
    }
</script>
    <script src='scripts/homer.js'></script>
          <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forte Mange Customers</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js'></script>





  <script type="text/javascript">
  function showPleaseWait() {
    var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false role="dialog">\
        <div class="modal-dialog">\
            <div class="modal-content">\
                <div class="modal-header">\
                    <h4 class="modal-title">Please wait...</h4>\
                </div>\
                <div class="modal-body">\
                    <div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}

function modifyCustomer(button){
  window.alert(button.id);
}

function deleteCustomer(button){
  jsonObj = [];
  item = {};
  item["customer_token"] = button.id;
  jsonObj.push(item);
  lol =  JSON.stringify(jsonObj);
  var request= new XMLHttpRequest();
  request.open("POST", "https://hoaboardtime.com/deleteSrsqForteCustomer.php", true);
  request.setRequestHeader("Content-type", "application/json");
  request.send(lol);
  showPleaseWait();
  request.onreadystatechange = function () {
        if (request.readyState == XMLHttpRequest.DONE) {
            hidePleaseWait();
            alert(request.responseText);
        }
        }

}

</script>
</head>
<body>
<div class="container">
  <h2>Forte Mange Customers</h2>
</div>
<div class="container"> 
        <table id="example" class="table table-striped" cellspacing="0" width="100%" >
                                <thead>
                                    <tr>
                                       <center>
                                       <th>Customer ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th></th>
                                       </center>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
          error_reporting(E_ALL);
          ini_set('display_errors', 1);
          $url = "https://api.forte.net/v3/organizations/org_332536/customers?page_size=1000";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','X-Forte-Auth-Organization-Id:org_332536','Authorization:Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU='));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);
        $jsonResult = json_decode($result);
          foreach ($jsonResult->results as $customer) {
          $customerToken = $customer->customer_token;
          echo '<tr>';
          echo '<td>';
          echo $customer->customer_id;
          echo '</td>';
          echo '<td>';
          echo $customer->display_name;
          echo '</td>';
          echo '<td>';
          if ($customer->addresses[0]->email){
          echo $customer->addresses[0]->email;
          }
          else {
          echo "";
          }
          echo '</td>';
          echo '<td>';
          if ($customer->addresses[0]->physical_address->street_line1){
          echo $customer->addresses[0]->physical_address->street_line1;
          }
          else {
          echo "";
          }
          echo '</td>';
          echo '<td>';
          echo $customer->status;
          echo '</td>';
          echo '<td>';
          echo '<input type="button" id="'.$customerToken.'" value="Modify" onclick="modifyCustomer(this);">';
          echo '<input type="button" id="'.$customerToken.'" value="Delete" onclick="deleteCustomer(this);">';
          echo '</td>';
          echo '</tr>';
        }
          ?>
</tbody>
</table>
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
</div>
</body>
</html>
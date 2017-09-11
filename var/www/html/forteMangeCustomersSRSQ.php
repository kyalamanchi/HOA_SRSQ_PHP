<html>
  <head>
  <title>Forte Mange Customers - SRSQ</title>
  <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <style>

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #2196F3;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<script type="text/javascript">
<?php
  
?>
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
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 100%">\
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
function deleteCustomer(obj){
  var customerToken = obj.id;
  window.alert(customerToken);
  jsonObj = [];
  item = {};
  item['customer_token']  = customerToken;
  jsonObj.push(item);
  jsonString = JSON.stringify(jsonObj);
  var request = new XMLHttpRequest();
  request.open("POST","https://hoaboardtime.com/deleteSrsqForteCustomer.php",true);
  request.setRequestHeader("Content-type","application/json");
  request.send(jsonString);
  // showPleaseWait();
  request.onreadystatechange = function(){
    if(request.readyState == XMLHttpRequest.DONE){
      hidePleaseWait();
      alert(request.responseText);
    }
  }
}
function modifyCustomer(obj){
  showPleaseWait();
  window.alert(obj.id);
}

</script>
  </head>
  <div class="container">
    <div class="row">
      <h2 style="text-align: left;float: left;">Forte Manage Customers</h2>
      <h2 style="text-align: right;float: right;">SRSQ</h2>
      <hr style="clear: both;">
    </div>
    <div>
      <table id="myTable" class="table table-striped" style="font-size: 14">  
        <thead>  
          <tr>  
            <th>Customer ID</th>  
            <th>Name</th>  
            <th>Email</th>  
            <th>Address</th> 
            <th>Status</th>
            <th></th>
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
          echo $customer->addresses[0]->email;
          echo '</td>';
          echo '<td>';
          echo $customer->addresses[0]->physical_address->street_line1;
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

      <script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
    </div>
  </div>
</html>
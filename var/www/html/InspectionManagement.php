<!DOCTYPE html>
<html>
    <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src='https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
    <script src="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"></script>
    <title>Inspeciton Management</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 100px">\
                      </div>\
                    </div>\
                </div>\
            </div>\
        </div>\
    </div>';
    $(document.body).append(modalLoading);
    $("#pleaseWaitDialog").modal("show");
}

function changeOptions2(){
    showPleaseWait();
    $('#example').dataTable().fnClearTable();
    var request = new XMLHttpRequest();
    request.open("POST","https://hoaboardtime.com/getInspectionData.php?id="+(document.getElementById("status").selectedIndex),true);
    request.send(null);
    request.onreadystatechange = function(){
    hidePleaseWait();
    if (request.readyState == XMLHttpRequest.DONE){
    let data = request.responseText;
    let data2 = JSON.parse(data);
    var dataSet = new Array();
    for (var i = 0; i < data2.length; i++) {
        var dataSet2 = new Array();
        dataSet2.push(data2[i]['id']);
        dataSet2.push(data2[i]['home_id']);
        dataSet2.push(data2[i]['hoa_id']);
        dataSet2.push(data2[i]['description']);
        dataSet2.push(data2[i]['inspection_category_id']);
        dataSet2.push(data2[i]['inspection_sub_category_id'])
        dataSet2.push(data2[i]['location_id']);
        dataSet2.push(data2[i]['inspection_notice_type_id']);
        dataSet2.push(data2[i]['inspection_status']);
        dataSet2.push('<input type="button" id="'+data2[i]['id']+'" value="Generate Notice" onclick="generateNotice(this)"></input>');
        dataSet.push(dataSet2);
    }
    if (dataSet.length > 0){
    $('#example').dataTable().fnAddData(dataSet);
    }
    else {
        alert("Data not found");
    }
}
} 
}
function sleep(miliseconds) {
   var currentTime = new Date().getTime();
   while (currentTime + miliseconds >= new Date().getTime()) {
   }
}
function generateNotice(button){
    var fieldData =     '<h4 class="modal-title">Generating Notice...Please Wait...</h4>';
    $("#pleaseWaitDialog2").modal("show");
    $("#pleaseWaitDialog2").find('.modal-header').html(fieldData);
    var pleaseWaitData = '<div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                      </div>\
                    </div>';
    $("#pleaseWaitDialog2").find('.modal-body').html(pleaseWaitData);
var source = new EventSource("https://hoaboardtime.com/genericNotice.php?id="+button.id);
source.onmessage = function(event) {
    $("#pleaseWaitDialog2").find('.modal-header').html('<h4 class="modal-title">'+event.data+'</h4>');
    if ( (event.data == "Uploaded to Dropbox Successfully") || (event.data == "Failed to upload to Dropbox. Please try agin.") ){
        source.close();
        $("#pleaseWaitDialog2").find('.modal-body').html('<button type="button" class="btn btn-primary" onclick="closeModal();">Close</button>');
    } 

};
}
function closeModal(){
    $("#pleaseWaitDialog2").modal("hide");
}
function loadData(){
    showPleaseWait();
    var request = new XMLHttpRequest();
    request.open("POST","https://hoaboardtime.com/getInspectionData.php",true);
    request.send(null);
    request.onreadystatechange = function(){
    if (request.readyState == XMLHttpRequest.DONE){
    let data = request.responseText;
    let data2 = JSON.parse(data);
    var dataSet = new Array();
    for (var i = 0; i < data2.length; i++) {
        var dataSet2 = new Array();
        dataSet2.push(data2[i]['id']);
        dataSet2.push(data2[i]['home_id']);
        dataSet2.push(data2[i]['hoa_id']);
        dataSet2.push(data2[i]['description']);
        dataSet2.push(data2[i]['inspection_category_id']);
        dataSet2.push(data2[i]['inspection_sub_category_id'])
        dataSet2.push(data2[i]['location_id']);
        dataSet2.push(data2[i]['inspection_notice_type_id']);
        dataSet2.push(data2[i]['inspection_status']);
        dataSet2.push('<input type="button" id="'+data2[i]['id']+'" value="Generate Notice" onclick="generateNotice(this)"></input>');
        dataSet.push(dataSet2);
}
$(document).ready(function() {
    $('#example').DataTable( {
        data: dataSet,
        columns: [
            { title: "ID" },
            { title: "HomeID" },
            { title: "HoaID" },
            { title: "Description" },
            { title: "Category" },
            { title: "SubCategory" },
            { title: "Location" },
            { title: "Type" },
            { title: "Status"},
            { title: ""}
        ]
    } );
} );
hidePleaseWait();
}
}
}
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}
  </script>
  <style >     
      .btn:hover {
        background-position: 0px;
    }
     input[type="radio"], input[type="radio"]+label img {
    vertical-align: middle;
  }
  </style>
    </head>
    <body onload="loadData();">
<h1>Inspection Management</h1>
<hr>
<div class="container"> 
        <div>
      <h4>Display:</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="status" onchange="changeOptions2();">
        <option disabled="disabled" selected="selected">Select Status</option>
        <option data-subtext="">Open Inspections</option>
        <option data-subtext="">Closed Inspections</option>
        <option>Board Review</option>
        <option>Archived</option>
        <option>Vendor Review</option>
        <option>Closed By Vendor</option>
        <option>Due From First Notice</option>
        <option>Due From Second Notice</option>
        <option>Closed By Member</option>
        <option>Request Board Review</option>
        <option>Request Vendor Review </option>
        <option>Past Due from First Notice</option>
        <option>Resolved</option>
        <option>Closed by CIS</option>
      </select>
        </div>
        <br>
        <div id="tableContent" onload="changeOptions();">
        <table id="example" class="table table-striped" cellspacing="0" width="100%"></table>   
        </div>
        <br><br>
  </div>

  <div class="modal" id="pleaseWaitDialog2" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                </div>
                <div class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>
    </body>
</html>

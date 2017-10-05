<!DOCTYPE html>
<html>
    <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
    <title>Inspeciton Management</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

function changeOptions3(){
    showPleaseWait();
    $('#example').dataTable().fnClearTable();
    if ( (document.getElementById("status").selectedIndex) == 1 ){
        alert("HOA ID ");
    }
    else if ( (document.getElementById("status").selectedIndex) == 2 ){
        alert("F&L");
    }
    else if ( (document.getElementById("status").selectedIndex) == 3 ){
        alert("F ");
    }
    else if ( (document.getElementById("status").selectedIndex) == 1 ){
        alert("L");
    }
    hidePleaseWait();
//     var request = new XMLHttpRequest();
//     request.open("POST","https://hoaboardtime.com/getInspectionData.php?id="+(document.getElementById("status").selectedIndex),true);
//     request.send(null);
//     request.onreadystatechange = function(){
//     hidePleaseWait();
//     if (request.readyState == XMLHttpRequest.DONE){
//     let data = request.responseText;
//     let data2 = JSON.parse(data);
//     var dataSet = new Array();
//     for (var i = 0; i < data2.length; i++) {
//         var dataSet2 = new Array();
//         dataSet2.push(data2[i]['home_id']);
//         dataSet2.push(data2[i]['hoa_id']);
//         dataSet2.push(data2[i]['description']);
//         dataSet2.push(data2[i]['inspection_category_id']);
//         dataSet2.push(data2[i]['inspection_sub_category_id'])
//         dataSet2.push(data2[i]['location_id']);
//         dataSet2.push(data2[i]['inspection_notice_type_id']);
//         dataSet2.push(data2[i]['inspection_status']);
//         dataSet.push(dataSet2);
//     }
//     if (dataSet.length > 0){
//     $('#example').dataTable().fnAddData(dataSet);
//     }
//     else {
//         alert("Data not found");
//     }
// }
// } 
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
        dataSet2.push(data2[i]['home_id']);
        dataSet2.push(data2[i]['hoa_id']);
        dataSet2.push(data2[i]['description']);
        dataSet2.push(data2[i]['inspection_category_id']);
        dataSet2.push(data2[i]['inspection_sub_category_id'])
        dataSet2.push(data2[i]['location_id']);
        dataSet2.push(data2[i]['inspection_notice_type_id']);
        dataSet2.push(data2[i]['inspection_status']);
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
        dataSet2.push(data2[i]['home_id']);
        dataSet2.push(data2[i]['hoa_id']);
        dataSet2.push(data2[i]['description']);
        dataSet2.push(data2[i]['inspection_category_id']);
        dataSet2.push(data2[i]['inspection_sub_category_id'])
        dataSet2.push(data2[i]['location_id']);
        dataSet2.push(data2[i]['inspection_notice_type_id']);
        dataSet2.push(data2[i]['inspection_status']);
        dataSet.push(dataSet2);
}
$(document).ready(function() {
   var table =  $('#example').DataTable( {
        data: dataSet,
        select: true,
        columns: [
            { title: "HOA ID " },
            { title: "First Name" },
            { title: "Last name",
            "width" : "30%" },
            { title: "Amount" },
            { title: "Authorization Code" },
            { title: "Date ",
            "width" : "15%" },
            { title: "Entered by " },
            { title: "Status",
            "width" : "20%" }
            
        ]
    } );

     $('#example tbody').on('click', 'td:not(:first-child)', function () {
        $(this).closest('tr').toggleClass('selected');
        $("#button").text("Send  "+table.rows('.selected').data().length+"  notices");   

        if ( table.rows('.selected').data().length == 0 ){
             $("#button").text("Select Rows to send Multiple");
        }
    });

     $('#button').click( function () {
        if ( table.rows('.selected').data().length == 0 ){
             alert("Please select atleast one row.");
             return;
        }
        showPleaseWait();
        var request = new XMLHttpRequest();
        request.open("POST","https://hoaboardtime.sendMultipleNotices.php",true);
        request.send(null);
        request.onreadystatechange = function(){
            if ( request.readyState == XMLHttpRequest.DONE){
                hidePleaseWait();
            }
        }
    });
} );
hidePleaseWait();
}
}
}
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}
  </script>
  </style>
    </head>
    <body onload="loadData();">
<h1>Inspection Management</h1>
<hr>
<div class="container"> 
        <div>
      <h4>Search by:</h4>
      <select class="selectpicker" data-show-subtext="true" data-live-search="true" id="status" onchange="changeOptions3();">
        <option disabled="disabled" selected="selected">Select Search Options</option>
        <option data-subtext="">HOAID</option>
        <option data-subtext="">First name & Last name</option>
        <option>First name</option>
        <option>Last name</option>
      </select>
      <br>
      <br>
      <!-- <button type="button" id="button" class="btn btn-primary" >Select Rows to send Multiple</button> -->
    </div>
        <br>
        <div>
        <table id="example" class="display" cellspacing="0" width="100%"></table>   
        </div>
        <br><br>
  </div>
  <div class="modal" id="pleaseWaitDialog2" data-backdrop="static" data-keyboard="false" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" >
                <div class="modal-header">
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Edit Inspection</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="reset" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveChanges();">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          
        </div>
        <div class="modal-body" id="previewBody">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    </body>
</html>

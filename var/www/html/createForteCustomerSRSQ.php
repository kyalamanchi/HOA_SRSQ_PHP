<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forte Create Customer</title>
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

function cancel(){
  window.location = "https://hoaboardtime.com/forteMangeCustomersSRSQ.php";
}
</script>
</head>
<body>
<div class="container">
  <h2>Forte Edit Customer</h2>
  <hr>
</div>
<div class="container"> 
      <h3>Basic Information</h3>
      <hr>
      <div class="form-group" style="float: left;">
        <label for="fname">First Name:</label>
        <input type="text" class="form-control" id="fname" >
      </div>
      <div class="form-group" style="float: left;padding-left:10px">
        <label for="lname">Last Name:</label>
        <input type="text" class="form-control" id="lname" >
      </div>
      <div class="form-group" style="float: left; padding-left:10px">
        <label for="cname">Company Name:</label>
        <input type="text" class="form-control" id="cname" >
      </div>
      <div style="clear: both;"></div>
      <br>
      
      <h3>Address</h3>
      <hr>
      <div class="form-group" style="width: 40%">
        <label for="adlabel">Address Label:</label>
        <input type="text" class="form-control" id="adlabel" >
      </div>
      <br>

      <div class="form-group" style="float: left;">
        <label for="afname">First Name:</label>
        <input type="text" class="form-control" id="afname" >
      </div>
      <div class="form-group" style="float: left; padding-left:10px">
        <label for="alname">Last Name:</label>
        <input type="text" class="form-control" id="alname" >
      </div>
      <div class="form-group" style="float: left; padding-left:10px">
        <label for="acname">Company Name:</label>
        <input type="text" class="form-control" id="acname" >
      </div>
      <div style="clear: both;"></div>
      <br>

      <div class="form-group" style="float: left;">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phones" >
      </div>
      <div class="form-group" style="float: left; padding-left:10px">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" >
      </div>
      <div style="clear: both;"></div>
      <br>
      <div class="form-group" style="float: left; padding-left:10px">
        <label for="satype">Shipping Address Type</label>
        <input type="text" class="form-control" id="satype" >
      </div>
      <div class="form-group" style="float: left; padding-left:10px">
        <label for="atype"> Address Type</label>
        <input type="text" class="form-control" id="atype" >
      </div>
      <div style="clear: both;"></div>
      <br>


      
</div>
</body>
</html>
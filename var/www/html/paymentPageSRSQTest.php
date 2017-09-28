<html>
  <head>
  <title>Create Payment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src='https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js'></script>
  <script type="text/javascript">
    <?php
    $connection = pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database");
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
function hidePleaseWait() {
    $("#pleaseWaitDialog").modal("hide");
}

function payNow(){

  var letters = /^[A-Za-z]+$/;  
  var format = /[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

  if ( document.getElementById("auth_amount").value.match(letters)  || document.getElementById("auth_amount").value.match(format)){
    alert("Invalid amount");
    return;
  }

  if ( document.getElementById("routingNumber").value.match(letters) || document.getElementById("routingNumber").value.match(format) ){
    alert("Invalid routing number");
    return;
  }

  if ( document.getElementById("accountNumber").value.match(letters) || document.getElementById("accountNumber").value.match(format) ){
    alert("Invalid Account  Number");
    return;
  }
  if( document.getElementById("auth_amount").value <= 0 ){
    alert("Invalid amount");
    return;
  }

  if ( !document.getElementById("routingNumber").value ){
    alert("Invalid routing number");
    return;
  }

  if ( !document.getElementById("accountNumber").value ){
    alert("Invalid Account  Number");
    return;
  }
  showPleaseWait();
  jsonObj = [];
  item = {};
  item["customer_id"] = document.getElementById("customerId").value;
  item["auth_amount"] = document.getElementById("auth_amount").value;
  item["routing_number"] = document.getElementById("routingNumber").value;
  item["account_number"] = document.getElementById("accountNumber").value;
  item["account_holder"] = document.getElementById("accountHolder").value;
  jsonObj.push(item);
  lol = JSON.stringify(jsonObj);
  var request  = new  XMLHttpRequest();
  request.open("POST","https://hoaboardtime.com/processPaymentSRSQ.php",true);
  request.send(lol.toString());
  request.onreadystatechange = function(){
    if ( request.readyState == XMLHttpRequest.DONE ){
      hidePleaseWait();
      alert(request.responseText);
    }
    hidePleaseWait();
  }
}
function verifyUser(){
// showPleaseWait();
var url = "https://hoaboardtime.com/verifyUser.php?id="+<?php echo $_GET['id'];?>;
$("#pleaseWaitDialog2").find('.modal-header').html('<h4>Please wait</h4>');
var pleaseWaitData = '<div class="progress">\
                      <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                      aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                      </div>\
                    </div>';
$("#pleaseWaitDialog2").find('.modal-body').html(pleaseWaitData);
$("#pleaseWaitDialog2").modal("show");
var source = new EventSource(url);
source.onmessage = function(event){
        $("#pleaseWaitDialog2").find('.modal-header').html('<h4>'+event.data+'</h4>');
        if ( (event.data == "email") ){
        source.close();
        var data  = event.lastEventId.split(' ');
        var str = Array(parseInt(data[0])).join("*");
        str = str.toString();
        str = str.concat(data[1]);
        $("#pleaseWaitDialog2").find('.modal-header').html('<h3>Verify to continue</h3>')
        $("#pleaseWaitDialog2").find('.modal-body').html('<div><h4><span class="notbold">Enter your email  to verify. </span><b>'+str+'</b></h4><br><div class="form-group">\
    <input class="form-control input-lg" id="inputsm" type="text" maxlength="'+data[0]+'">\
  </div><br><button type="button" class="btn btn-success" onclick="closeModal();">Verify</button></div>');
        }
        if (  (event.data == "number") ){
        source.close();
        var data  = event.lastEventId.split(' ');
        var str = Array(parseInt(data[0])).join("*");
        str = str.toString();
        str = str.concat(data[1]);
        $("#pleaseWaitDialog2").find('.modal-header').html('<h3>Verify to continue</h3>')
        $("#pleaseWaitDialog2").find('.modal-body').html('<div><h4><span class="notbold">Enter your phone number to verify.</span><b>'+str+'</b></h4><br><div class="form-group">\
    <input class="form-control input-lg" id="cellnum" type="text" maxlength="'+data[0]+'">\
  </div><br><button type="button" class="btn btn-success" onclick="closeModal();">Verify</button></div>');
        }
}




}
function closeModal(){
  $("#pleaseWaitDialog2").modal("hide");
}

$(document).ready(function () {
  $("#cellnum").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        
        $("#errmsg").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
});
</script>
<style type="text/css">
  .notbold{
    font-weight:normal
}​
#errmsg
{
color: red;
}
</style>
  </head>
  <body onload="verifyUser();">
    <?php
          $query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
          $queryResult =  pg_query($query);
          $row = pg_fetch_assoc($queryResult);
          $communityID = $row['community_id'];
          $query = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$communityID;
          $queryResult = pg_query($query);
          $row2 = pg_fetch_assoc($queryResult);
          $legalName = $row2['legal_name'];
          echo '<h1>'.$legalName.'</h1>';
    ?>
    <hr>
    <br><br>
  <div class="container" style=" margin: 0 auto;" >
    <div class="row">
        <div style="width:40%; margin:0 auto; float: left;">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                      <center>
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        </center>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form role="form">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="amount">AMOUNT</label>
                                   <?php 
                                   date_default_timezone_set('America/Los_Angeles');
                                    $query  = "SELECT * FROM CURRENT_CHARGES WHERE HOA_ID=".$_GET['id']."AND ASSESSMENT_YEAR=".date("Y");
                                    $queryResult = pg_query($query);
                                    $currentChargesTotal  = 0;
                                    while ($row = pg_fetch_assoc($queryResult)) {
                                      $currentChargesTotal = $currentChargesTotal+$row['amount'];
                                    }
                                    $query = "SELECT * FROM CURRENT_PAYMENTS WHERE HOA_ID=".$_GET['id']." AND EXTRACT(YEAR FROM PROCESS_DATE)=".date("Y");
                                    $queryResult = pg_query($query);
                                    $currentPaymentsTotal = 0;
                                    while ($row = pg_fetch_assoc($queryResult)) {
                                      $currentPaymentsTotal = $currentPaymentsTotal + $row['amount'];
                                    }
                                    if ( $currentChargesTotal-$currentPaymentsTotal > 0 ){
                                    echo '<input type="text" class="form-control" name="amount" id="auth_amount" value="'.($currentChargesTotal-$currentPaymentsTotal).'" disabled="disabled"/>';
                                    }
                                    else {
                                      echo '<input type="text" class="form-control" id="auth_amount" name="amount" />';
                                    }
                                    ?>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="routingNumber">ROUTING NUMBER</label>
                                    <input type="text" class="form-control" name="routingNumber" id="routingNumber" />
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="accountNumber">ACCOUNT NUMBER</label>
                                    <input type="text" class="form-control" name="accountNumber" id="accountNumber" />
                                </div>                            
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="accountHolder">ACCOUNT HOLDER</label>
                                    <?php
                                    $query = "SELECT firstname,lastname from hoaid where hoa_id=".$_GET['id'];
                                    $queryRes = pg_query($query);
                                    $row = pg_fetch_row($queryRes);
                                    $name = $row[0].' '.$row[1];
                                    echo '<input type="text" class="form-control" name="accountHolder" id="accountHolder" value="'.$name.'" />'; 
                                    ?>
                                </div>                            
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="customerId">CUSTOMER ID</label>
                                    <?php
                                    echo '<input type="text" class="form-control" name="customerId" id="customerId" value="'.$_GET['id'].'" disabled="disabled"/>';
                                    ?>
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-lg btn-block" type="button" onclick="payNow();">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>            
        <div style="float: left; padding-left: 30px;">

          <h4>Contact Us</h4>
          <br>
          <?php
          $query = "SELECT * FROM HOAID WHERE HOA_ID=".$_GET['id'];
          $queryResult =  pg_query($query);
          $row = pg_fetch_assoc($queryResult);
          $communityID = $row['community_id'];
          $query = "SELECT * FROM COMMUNITY_INFO WHERE COMMUNITY_ID=".$communityID;
          $queryResult = pg_query($query);
          $row2 = pg_fetch_assoc($queryResult);
          $legalName = $row2['legal_name'];
          $address = $row2['mailing_address'];
          $query = "SELECT CITY_NAME FROM CITY WHERE CITY_ID=".$row2['mailing_addr_city'];
          $queryResult = pg_query($query);
          $row = pg_fetch_row($queryResult);
          $cityName  = $row[0];
          $query = "SELECT STATE_CODE FROM STATE WHERE STATE_ID=".$row2['mailing_addr_state'];
          $queryResult = pg_query($query);
          $row  = pg_fetch_row($queryResult);
          $stateName = $row[0];
          $query = "SELECT ZIP_CODE FROM ZIP WHERE ZIP_ID=".$row2['mailing_addr_zip'];
          $queryResult = pg_query($query);
          $row =  pg_fetch_row($queryResult);
          $zipCode = $row[0];
          $finalAddress = '<span class=\'notbold\'>'.$legalName.'<br><br>'.$address.','.$cityName.','.$stateName.' '.$zipCode.'</span>';
          if ( $communityID == 1){
            $finalAddress = $finalAddress.'<br><br>'.'<a href="mailto:board@stoneridgeplace.org">board@stoneridgesquare.org</a>';
          }
          else if  ( $communityID == 2){
            $finalAddress = $finalAddress.'<br><br>Phone : <a href="tel:9253996642">(925) 399-6642</a>'.'<br>'.'Email : <a href="mailto:board@stoneridgesquare.org">board@stoneridgesquare.org</a>';

          }


          echo '<h4>'.$finalAddress.'</h4>';
          echo '<br>';
          ?>
          <center><img  style="padding-left: 10px;" src="FortePaymentSystemsLogo.png"></center>
        </div>
        </div>
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
  </body>
</html>
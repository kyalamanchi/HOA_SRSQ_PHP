<!DOCTYPE html>
<html>
    <head>
      <title>Automated Jobs</title>
  




<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    function updatePayments(){
        document.getElementById("payResult").innerHTML = "";
        var url = "https://hoaboardtime.com/automationBackgroundHandlerSRP.php?id=1";
        var source = new EventSource(url);
        source.onmessage  = function(e){
            if ( e.data == "Done!!!"){
                source.close();
              document.getElementById("pltime").innerHTML = "Last ran on : " + event.lastEventId;
            }
            document.getElementById("payResult").innerHTML += event.data + "<br>";
        }
    }
    function updateAgreements(){
        document.getElementById("agreementResult").innerHTML = "";
        var url = "https://hoaboardtime.com/automationBackgroundHandlerSRP.php?id=2";
        var source = new EventSource(url);
        source.onmessage  = function(e){
            if ( e.data == "Done!!!"){
                source.close();
              document.getElementById("altime").innerHTML = "Last ran on : " + event.lastEventId;
            }
            document.getElementById("agreementResult").innerHTML += event.data + "<br>";
        }
    }
    function updateBillingStatements(){
        document.getElementById("bsResult").innerHTML = "";
        var url = "https://hoaboardtime.com/automationBackgroundHandlerSRP.php?id=3";
        var source = new EventSource(url);
        source.onmessage  = function(e){
            if ( e.data == "Done!!!"){
                source.close();
              document.getElementById("bsltime").innerHTML = "Last ran on : " + event.lastEventId;
              document.getElementById("bsResult").innerHTML += event.data + "<br>";
            }
            document.getElementById("bsResult").innerHTML += event.data + "<br>";
        }
    }
    function updateAll(){
      document.getElementById("agreementsButton").disabled = true;
      document.getElementById("paymentsButton").disabled  = true;
      document.getElementById("billingStatementsButton").disabled = true;
      document.getElementById("emailsButton").disabled = true;
      document.getElementById("runAllJobsButton").disabled = true;
      swal("Payments,Agreements,Emails sent, SMS sent and Billing Statements will be updated.","","success");
      var request = new XMLHttpRequest();
      request.open("POST","https://hoaboardtime.com/automationBackgroundHandlerSRP.php",true);
      request.send(null);
      request.onreadystatechange  = function(){
      if ( request.readyState == XMLHttpRequest.DONE ){
          swal("Updation Complete","","success");
          document.getElementById("agreementsButton").disabled = false;
          document.getElementById("paymentsButton").disabled  = false;
          document.getElementById("billingStatementsButton").disabled = false;
          document.getElementById("emailsButton").disabled = false;
          document.getElementById("runAllJobsButton").disabled = false;
      }
    }
  }
  function updateEmailsSent(){

    document.getElementById("emailResult").innerHTML = "";
        var url = "https://hoaboardtime.com/automationBackgroundHandlerSRP.php?id=4";
        var source = new EventSource(url);
        source.onmessage  = function(e){
            if ( e.data == "Done!!!"){
              source.close();
              document.getElementById("eltime").innerHTML = "Last ran on : " + event.lastEventId;
              document.getElementById("emailResult").innerHTML += event.data + "<br>";
            }
            document.getElementById("emailResult").innerHTML += event.data + "<br>";
        }
  }
    function addCharges(){  
    var request = new XMLHttpRequest();
      request.open("POST","https://hoaboardtime.com/addCurrentChargesSRP.php",true);
      request.send(null);
      request.onreadystatechange  = function(){
      if ( request.readyState == XMLHttpRequest.DONE ){
          if ( request.responseText.includes("CHARGES ADDED") ){
            swal("Charges Added","","success");
          }
          else {
            swal(request.responseText,"","error");
          }
      }
    }
  }

   function updateSMSSent(){

    document.getElementById("emailResult").innerHTML = "";
        var url = "https://hoaboardtime.com/automationBackgroundHandlerSRP.php?id=5";
        var source = new EventSource(url);
        source.onmessage  = function(e){
            if ( e.data == "Done!!!"){
              source.close();
              document.getElementById("smstime").innerHTML = "Last ran on : " + event.lastEventId;
              document.getElementById("smsResult").innerHTML = event.data + "<br>";
            }
            document.getElementById("smsResult").innerHTML = event.data + "<br>";
        }
  }
  
</script>
<style type="text/css">
  .pull-right{
    float: right;
  }
</style>
</head>
<body>  
    <h1 style="padding-left: 10px;">Automated Jobs</h1>
    <hr>
    <br>
    <div class="container">
        <div class="pull-right">
        <button type="button" class="btn btn-outline-primary" id="runAllJobsButton" onclick="updateAll();">Run All Jobs</button>
        </div>
        <br>
        <br>
        <div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h4>Payments</h4>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="card-block">
        <?php
        $connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
        $query = "SELECT * FROM BACKGROUND_JOBS WHERE \"JOB_CATEGORY_ID\" = 1 ORDER BY \"START_TIME\" DESC";
        $queryResult = pg_query($query);
        $row = pg_fetch_assoc($queryResult);
        echo '<font size="4" style="float: right;" id="pltime">Last ran on :'.$row['START_TIME'].'</font>';
        ?>
        Updates transactions, paymethods, deposits and deposit  transactions.
        <br>
        <br>
        <button type="button" class="btn btn-outline-primary" id="paymentsButton" onclick="updatePayments();">Update Now</button>
        <div id="payResult">
            
        </div>
        <br>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingTwo">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <h4>Agreements</h>
        </a>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="card-block">
        <?php 
        $connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
        $query = "SELECT * FROM BACKGROUND_JOBS WHERE \"JOB_CATEGORY_ID\" = 2 ORDER BY \"START_TIME\" DESC";
        $queryResult = pg_query($query);
        $row = pg_fetch_assoc($queryResult);
        echo '<font size="4" style="float: right;" id="altime">Last ran on :'.$row['START_TIME'].'</font>';
        ?>
         Updates agreements, mega sign agreements and mega sign child agreements.
        <br>
        <br>
        <button type="button" class="btn btn-outline-primary" id="agreementsButton" onclick="updateAgreements();">Update Now</button>
        <div id="agreementResult">
            
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab" id="headingThree">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <h4>Billing Statements</h4>
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="card-block">
        <?php 
        $connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
        $query = "SELECT * FROM BACKGROUND_JOBS WHERE \"JOB_CATEGORY_ID\" = 3 ORDER BY \"START_TIME\" DESC";
        $queryResult = pg_query($query);
        $row = pg_fetch_assoc($queryResult);
        echo '<font size="4" style="float: right;" id="bsltime">Last ran on :'.$row['START_TIME'].'</font>';
        ?>
         Generates billing statements and uploads to Dropbox. SRP path : /Billing_Statements/SRP/2017/ .
         <br>SRSQ Path /Billing_Statements/SRSQ/2017/ . 
        <br>
        <br>
        <button type="button" class="btn btn-outline-primary" id="billingStatementsButton" onclick="updateBillingStatements();">Update Now</button>
        <div id="bsResult">
        </div>
      </div>
    </div>
  </div>


  <div class="card">
    <div class="card-header" role="tab" id="headingFour">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          <h4>Emails Sent</h4>
        </a>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="card-block">
        <?php 
        $connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
        $query = "SELECT * FROM BACKGROUND_JOBS WHERE \"JOB_CATEGORY_ID\" = 4 ORDER BY \"START_TIME\" DESC";
        $queryResult = pg_query($query);
        $row = pg_fetch_assoc($queryResult);
        echo '<font size="4" style="float: right;" id="eltime">Last ran on :'.$row['START_TIME'].'</font>';
        ?>
         Inserts sent email(s) data. If exists, updates status.
        <br>
        <br>
        <button type="button" class="btn btn-outline-primary" id="emailsButton" onclick="updateEmailsSent();">Update Now</button>
        <div id="emailResult">
        </div>
      </div>
    </div>
  </div>

<div class="card">
    <div class="card-header" role="tab" id="headingFive">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <h4>Charges</h4>
        </a>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="card-block">
         Adds regular assessment amount to all the members.
        <br>
        <br>
        <button type="button" class="btn btn-outline-primary" id="chargesButton" onclick="addCharges();">Update Now</button>
      </div>
    </div>
  </div>


<div class="card">
    <div class="card-header" role="tab" id="headingFive">
      <h5 class="mb-0">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
          <h4>SMS Sent</h4>
        </a>
      </h5>
    </div>
    <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="card-block">
        <?php 
        $connection =  pg_connect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy") or die("Failed to connect to database.......");
        $query = "SELECT * FROM BACKGROUND_JOBS WHERE \"JOB_CATEGORY_ID\" = 6 ORDER BY \"START_TIME\" DESC";
        $queryResult = pg_query($query);
        $row = pg_fetch_assoc($queryResult);
        echo '<font size="4" style="float: right;" id="smstime">Last ran on :'.$row['START_TIME'].'</font>';
        ?>
         Inserts sent SMS(s) data. If exists, updates status.
        <br>
        <br>
        <button type="button" class="btn btn-outline-primary" id="smsButton" onclick="updateSMSSent();">Update Now</button>
        <div id="smsResult">
        </div>
      </div>
    </div>
  </div>


</div>  
    </div>
</body>
</html>                                                                                                         
<!DOCTYPE html>
<html>
    <head>
      <title>Automated Jobs</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script type="text/javascript">
    function updatePayments(){
        document.getElementById("payResult").innerHTML = "";
        var url = "https://hoaboardtime.com/automationBackgroundHandler.php?id=1";
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
        var url = "https://hoaboardtime.com/automationBackgroundHandler.php?id=2";
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
        var url = "https://hoaboardtime.com/automationBackgroundHandler.php?id=3";
        var source = new EventSource(url);
        source.onmessage  = function(e){
            if ( e.data == "Done!!!"){
                source.close();
              document.getElementById("bsltime").innerHTML = "Last ran on : " + event.lastEventId;
              document.getElementById("bsResult").innerHTML += event.data + "<br>";
            }
            document.getElementById("bsResult").innerHTML = event.data + "<br>";
        }
    }
</script>
</head>
<body>  
    <h1 style="padding-left: 10px;">Automated Jobs</h1>
    <hr>
    <br>
    <div class="container">
        <button type="button" class="btn btn-outline-primary">Run Now</button>
        <div id="accordion" role="tablist" aria-multiselectable="true">
  <div class="card">
    <div class="card-header" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h4>Payments</h4>
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
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
        <button type="button" class="btn btn-outline-primary" onclick="updatePayments();">Update Now</button>
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
        <button type="button" class="btn btn-outline-primary" onclick="updateAgreements();">Update Now</button>
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
        <button type="button" class="btn btn-outline-primary" onclick="updateBillingStatements();">Update Now</button>
        <div id="bsResult">
        </div>
      </div>
    </div>
  </div>
</div>  
    </div>
</body>
</html>                                                                                                         
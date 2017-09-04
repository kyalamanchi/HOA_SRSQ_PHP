<!DOCTYPE html>
<html>
    <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Automation</title>
    <script type="text/javascript">
        function updateTransactions1(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/forteTransactions.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
            }
            }
            updateTransactions2();
        }
        function updateTransactions2(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/srpforteTransactions.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                alert("Update Transactions Request Completed");
            }
            }
        }
        
        function updatePayMethods1(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateHomePayMethodSRP.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
            }
            }
            updatePayMethods2();
        }
        function updatePayMethods2(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateHomePayMethodSRSQ.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                alert("Update Paymethods Request Completed");
            }
            }
        }
        
        function updateAgreeements1(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateAgreementsSRP.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
            }
            }
            updateAgreements2();
        }
        function updateAgreements2(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateAgreementsSRSQ.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                alert("Agreements Updated");
            }
            }
        }

        function updateMegaSign1(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateMegaSignAgreementsSRP.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                
            }
            }

        }

        function updateMegaSign2(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateMegaSignAgreementsSRSQ.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                alert("Mega Sign Agreements Updated");
            }
            }
        }
        
        function generateBillingStatements1(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/billingStatementsSRP.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
            }
            }
            generateBillingStatements2();

        }
        function generateBillingStatements2(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/billingStatementsSRSQ.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                alert("Generated Billing Statements");
            }
            }
        }
        function generateInspectionNotices(){
            var request = new XMLHttpRequest();
            request.open("POST","https://hoaboardtime.com/updateHomePayMethodSRP.php",true);
            request.send(null);
            request.onreadystatechange = function (){
            if (request.readyState == XMLHttpRequest.DONE) {
                alert("Inspection Notices Generated");
            }
            }
            
        }
    </script>
    </head>
    <body>
    <h1>Automated Jobs</h1>
    <hr>
    <div class="container">
        <h3>Payments</h3>
        <hr>
         <div class="col-md-3" style="float: left;">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="updateTransactions1();">Update Transactions</a>
        </div>
        <div class="col-md-3" style="float: left; padding-left: 40">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="updatePayMethods1();">Update Pay Methods</a>
        </div>
        <div style="clear: both;"></div>
        <br>
        </div>
        <div class="container">
        <h3>Agreements</h3>
        <hr>
        <div class="col-md-3" style="float: left;">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="updateAgreeements1();">Update Agreements</a>
        </div>
        <div class="col-md-3" style="float: left;">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge  " onclick="updateMegaSign1();">Update MegaSign</a>
        </div>
        <div style="clear: both;"></div>
        <br>
        </div>
        <div class="container">
        <h3>Billing Statements</h3>
        <hr>
         <div class="col-md-3" style="float: left;">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="generateBillingStatements1();">Generate Billing Statements</a>
        </div>
        <br>
        </div>
        <div class="container">
        <h3>Inspection Notices</h3>
        <hr>
         <div class="col-md-3" style="float: left;">
            <a href="#" class="btn btn-primary btn-lg btn-block btn-huge" onclick="generateInspectionNotices();">Generate Inspection Notices</a>
        </div>
        <br>
        </div>
    </body>
</html>

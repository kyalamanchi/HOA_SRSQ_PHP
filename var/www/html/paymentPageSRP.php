<html>
  <head>
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
}</script>
  </head>
  <body>
    <br><br>

  <div class="container" style=" margin: 0 auto;" >
    <div class="row">
        <div style="width:40%; margin:0 auto;">
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
                                    <label for="routingNumber">ROUTING NUMBER</label>
                                    <input type="text" class="form-control" name="routingNumber" />
                                </div>                            
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="accountNumber">ACCOUNT NUMBER</label>
                                    <input type="text" class="form-control" name="accountNumber" />
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
                                    echo '<input type="text" class="form-control" name="accountHolder" value="'.$name.'" />'; 
                                    ?>
                                </div>                            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="subscribe btn btn-success btn-lg btn-block" type="button" onclick="showPleaseWait();">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>            
        
      
        </div>
        
    </div>

  </body>
</html>
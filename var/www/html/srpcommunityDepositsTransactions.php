<!DOCTYPE html>
<html>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>Transactions</title>
        <link rel="stylesheet" href="bootstrap.css"/>
        <link rel="stylesheet" href="../bower_components/Font-Awesome/css/font-awesome.css"/>
        <link rel="stylesheet" href="build.css"/>
        <link rel="stylesheet" href="dist/css/bootstrap-select.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel='stylesheet' href='vendor/metisMenu/dist/metisMenu.css' />
        <link rel='stylesheet' href='vendor/animate.css/animate.css' />
        <link rel='stylesheet' href='fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css' />
        <link rel='stylesheet' href='fonts/pe-icon-7-stroke/css/helper.css' />
        <link rel='stylesheet' href='styles/style.css'>
        <script src="dist/js/bootstrap-select.js"></script>
        <script type="text/javascript">
        var id = "";
        function test(checkbox){
            if (checkbox.checked == false) {
                if (!checkbox.disabled) {
                    document.getElementById("setreminder").disabled = true;
                }
            }
            else  if(checkbox.checked == true){
                document.getElementById("setreminder").disabled = false;
                id = checkbox.id;
            }
        }
        function buttonPressed() {
            // alert(id);
            var date = document.getElementById('inputdefault').value;
            // window.location  = "localhost/forteTransactions.php?id=".date;
            window.location = "http://localhost/forteTransactions.php?date=".concat(date);
        }
        function todayButtonPressed() {
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            window.location = "http://localhost/forteTransactions.php?date=".concat(date);
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
    <body>
        <div class='splash'> 
            <div class='color-line'></div>
            <div class='splash-title'>
                <h1></h1>
                <div class='spinner'> 
                    <div class='rect1'></div>
                    <div class='rect2'></div>
                    <div class='rect3'></div> 
                    <div class='rect4'></div>
                    <div class='rect5'></div>
                </div>
            </div>
        </div>
        <h1>Fundings</h1>
<hr>
<div class="container">

		<div class="form-group" style="width: 200px;">
    </div>
    
        <br>
        <div>
    </div>
       
                               <?php
                               $dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
                               //If Connected to database
                               if ( $dbconn3 ) {
                                $getQuery = "SELECT funding_id,number_of_transactions FROM community_deposits WHERE community_id=1";
                                $getResults = pg_query($getQuery);
                                $getQuery2 = "SELECT transaction_id FROM community_funding_transactions";
                                $getResults2 = pg_query($getQuery2);
                                $transactionArray = array();
                                $fundingArray  = array();

                                try {
                                //Outer if 
                                if ($getResults2) {
                                //Start of while #1
                                while ($row = pg_fetch_row($getResults2)) {
                                    $transactionArray[$row[0]] = '1';
                                }//End of while #1
                                }//End of outer if #1

                                while ($row = pg_fetch_row($getResults)) {
                                if ( $row[1] != 0){   
                                date_default_timezone_set('America/Los_Angeles');
                                $url  = 'https://api.forte.net/v3/organizations/org_335357/fundings/FND_'.$row[0].'/transactions';
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','X-Forte-Auth-Organization-Id:org_335357','Authorization:Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                $result = curl_exec($ch);
                                $result = json_decode($result,TRUE);
                                curl_close($ch);
                                $number_of_results = $result['number_results'];
                                $url = $url.'?page_size='.$number_of_results;
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','X-Forte-Auth-Organization-Id:org_335357','Authorization:Basic NjYxZmM4MDdiZWI4MDNkNTRkMzk5MjUyZjZmOTg5YTY6NDJhNWU4ZmNjYjNjMWI2Yzc4N2EzOTY2NWQ4ZGMzMWQ='));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                $result = curl_exec($ch);
                                $result = json_decode($result,TRUE);
                                curl_close($ch);
                                $writeFundingID = str_replace("fnd_","",$result['search_criteria']['resource_specific']['funding_id']);
                                foreach ($result['results'] as $transactions) {
                                if ( $transactionArray[$transactions['transaction_id']] == '1') {
                                        $updateQuery = "UPDATE community_funding_transactions SET status = '".$transactions['status']."' WHERE transaction_id='".$transactions['transaction_id']."'";
                                        pg_query($updateQuery);
                                        print_r("Updating a existing record ");
                                        echo nl2br("\n");

                                }
                                //Start of else
                                else {
                                    $writeTransactionID = $transactions['transaction_id'];
                                    $writeStatus = $transactions['status'];
                                    $writeAction = $transactions['action'];
                                    $writeAmount = $transactions['authorization_amount'];
                                    if ($writeAction == 'credit'){
                                        $writeAmount = -$writeAmount;
                                    }
                                    $writeAuthCode = $transactions['authorization_code'];
                                    $writeEnteredBy = $transactions['entered_by'];
                                    $writeReceivedDate = $transactions['received_date'];
                                    $writeHOAID = $transactions['reference_id'];
                                    $writeFirstName = $transactions['billing_address']['first_name'];
                                    $writeLastName = $transactions['billing_address']['last_name'];
                                    $writeEmail = $transactions['billing_address']['email'];
                                    $wrirtePostalCode = $transactions['billing_address']['postal_code'];
                                    $writePhone = $transactions['billing_address']['phone'];
                                    $writeLocality = $transactions['billing_address']['locality'];
                                    $writeRegion = $transactions['billing_address']['region'];
                                    $writeStreet = $transactions['billing_address']['street'];
                                    $writeSettlementURL = $transactions['links']['settlements'];
                                    //Inner if 
                                    if ( $transactions['reference_id']){
                                    $insertQuery = 'INSERT INTO community_funding_transactions("funding_id","transaction_id","status","action","amount","authorization_code","entered_by","received_date","hoa_id","settlement_url") VALUES(';
                                        $insertQuery = $insertQuery."'".$writeFundingID."',";
                                        $insertQuery = $insertQuery."'".$writeTransactionID."',";
                                        $insertQuery = $insertQuery."'".$writeStatus."',";
                                        $insertQuery = $insertQuery."'".$writeAction."',";
                                        $insertQuery = $insertQuery."".$writeAmount.",";
                                        $insertQuery = $insertQuery."".$writeAuthCode.",";
                                        $insertQuery = $insertQuery."'".$writeEnteredBy."',";
                                        $insertQuery = $insertQuery."'".$writeReceivedDate."',";
                                        //Inner most if
                                        if ( $transactions['reference_id'] == '471'){
                                            $insertQuery = $insertQuery."1247,";
                                        }//End of inner most if
                                        //Inner most else 
                                        else {
                                        $insertQuery = $insertQuery."".$transactions['reference_id'].",";
                                        }//End of inner most else
                                        $insertQuery = $insertQuery."'".$writeSettlementURL."')";

                                    }//End of inner if 
                                    //Start of inner else
                                    else {
                                        $insertQuery = 'INSERT INTO community_funding_transactions("funding_id","transaction_id","status","action","amount","authorization_code","entered_by","received_date","settlement_url","first_name","last_name","phone","email","street","locality","region","postal_code") VALUES(';
                                    
                                        $insertQuery = $insertQuery."'".$writeFundingID."',";
                                        $insertQuery = $insertQuery."'".$writeTransactionID."',";
                                        $insertQuery = $insertQuery."'".$writeStatus."',";
                                        $insertQuery = $insertQuery."'".$writeAction."',";
                                        $insertQuery = $insertQuery."".$writeAmount.",";
                                        $insertQuery = $insertQuery."".$writeAuthCode.",";
                                        $insertQuery = $insertQuery."'".$writeEnteredBy."',";
                                        $insertQuery = $insertQuery."'".$writeReceivedDate."',";
                                        $insertQuery = $insertQuery."'".$writeSettlementURL."',";
                                        $insertQuery = $insertQuery."'".$writeFirstName."',";
                                        $insertQuery = $insertQuery."'".$writeLastName."',";
                                        $insertQuery = $insertQuery."'".$writePhone."',";
                                        $insertQuery = $insertQuery."'".$writeEmail."',";
                                        $insertQuery = $insertQuery."'".$writeStreet."',";
                                        $insertQuery = $insertQuery."'".$writeLocality."',";
                                        $insertQuery = $insertQuery."'".$writeRegion."',";
                                        $insertQuery = $insertQuery."'".$wrirtePostalCode."')";
                                    }
                                    //End if inner else
                                    print_r("Inserting a new record");
                                    print_r(nl2br("\n"));
                                    pg_query($insertQuery);
                                   }
                                }
                                }
                            }
                            }
                            catch(Exception $e ){
                                print_r($e);
                                print_r(nl2br("Transacation ID is \n").$transactions['transaction_id'].nl2br("\n"));
                                print_r($writeTransactionID.nl2br("\n"));

                            }
                            }
                               ?>
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
        <script src='vendor/slimScroll/jquery.slimscroll.min.js'></script>
        <script src='vendor/metisMenu/dist/metisMenu.min.js'></script>
        <script src='scripts/homer.js'></script>
        <script src='//code.jquery.com/jquery-1.12.4.js'></script>
        <script src='https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js'></script>
        <script src='https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js'></script>
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
    <script src='scripts/homer.js'></script>
          <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
    </body>
</html>

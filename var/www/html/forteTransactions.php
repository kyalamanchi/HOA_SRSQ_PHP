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
        <h1>Forte Transactions</h1>
<hr>
<div class="container">

        <div class="form-group" style="width: 200px;">
      <label for="inputdefault">Enter Date</label>
      <input class="form-control" id="inputdefault" type="text" placeholder="YYYY-MM-DD">
      <input type="button" name="Some Button" value="Get Transactions" onclick="buttonPressed()">
      <input type="button" name="Current Date" value="Today Transactions" oncancel="buttonPressed()">
    </div>
    
        <br>
        <div>
        <input type="button" name="" value="Update Database" style="float: right;" onclick="updateDatabase();">
    </div>
        <table id="example" class="table table-striped" cellspacing="0" width="100%" style="font-size: 16px;">
                                <thead>
                                    <tr>
                                        <th>HOAID</th>
                                        <th>HOMEID</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Entered By</th>
                                        <th>Origination Date</th>
                                    </tr>
                                </thead>
                                <tbody>      
                               <?php
                               error_reporting(E_ALL);
                                ini_set('display_errors', 1);
                               date_default_timezone_set('America/Los_Angeles');

                                $d = new DateTime('first day of this month');
                                $d = $d->format('Y-m-d');
                                $dbconn3 = pg_pconnect("host=hoapgtest.crsa3tdmtcll.us-west-1.rds.amazonaws.com port=5432 dbname=SRP user=HOA_serviceID password=hoaalchemy");
                                if ($dbconn3) {
                                    $query = "select hoa_id,home_id,email from hoaid where community_id=2";
                                    $databaseResult = pg_query($query);
                                    $userData  = array();
                                    $userEmailsArray = array();
                                    if ($databaseResult){
                                    while ( $row = pg_fetch_row($databaseResult)) {
                                        $userData[$row[0]] = $row[1];
                                        $userEmailsArray[$row[2]] = $row[0];
                                    }
                                    }
                                    $bankTransactions = "SELECT bank_transaction_id,hoa_id FROM current_payments WHERE community_id=2 AND bank_transaction_id IS NOT NULL";
                $bankTransactionsResult = pg_query($bankTransactions);
                $bankData = array();
                if ( $bankTransactionsResult){
                while ($row = pg_fetch_row($bankTransactionsResult)) {
                    $bankData[$row[0]]  = $row[1];
                }
            }
                                }
                                
                                if (isset($_GET['date'])) {
                                $date = $_GET['date'];
                               }


                                $date = date('Y-m-d');
                               
                               $homeIDS = array();
                               $hoaIDS = array();
                               $paymentCustomerIDSDetails = array();
                               $payment_type_ids = array();
                               $paymentAmount = array();
                               $paymentProcessDate = array();
                               $paymentDocNum = array();
                               $paymentCommunity  = array();
                               $paymentStatusIDS = array();
                               $paymentStatusInformation = array();
                               $paymentTransactionIDS = array();
                                if ( !isset($_GET['date'])) {
                                $url = 'https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions?filter=start_received_date+eq+'.$d.'+and+end_received_date+eq+'.$date.'';
                                }
                                else {
                                    $url = 'https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions?filter=received_date eq '.$date.'&page_size='.$result['number_results'];
                                    $url = str_replace(' ', '%20',$url);
                                }
                                $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','X-Forte-Auth-Organization-Id:org_332536','Authorization:Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU='));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                $result = curl_exec($ch);
        $result = json_decode($result,TRUE);
        curl_close($ch);
        echo nl2br("\n");
        if ( !$result['number_results'] ) {
            echo "<h4><b>No payments received on this date. Please try with a different date.</b></h4>";
            echo "<br>";
        }
        else {
            if ( isset($_GET['date'])){
            $url = 'https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions?filter=received_date eq '.$date.'&page_size='.$result['number_results'];
            $url = str_replace(' ', '%20',$url);
        }
        else 
        {
            $url = 'https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions?filter=start_received_date+eq+'.$d.'+and+end_received_date+eq+'.$date.'&page_size='.$result['number_results'];
        }
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','X-Forte-Auth-Organization-Id:org_332536','Authorization:Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU='));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $result = curl_exec($ch);
            $result = json_decode($result,TRUE);
            curl_close($ch);
            if ( isset($_GET['date'])) {
            echo "<center><b><h3>A total of  ".$result['number_results']." payments were received on ".$date."</h3></b></center>";
            }
            else {
                echo "<center><b><h3>A total of  ".$result['number_results']." payments were received by ".$date."</h3></b></center>";
            }
            echo "<br><br>";
            foreach ($result['results'] as $transaction) {
                echo '<tr>';
                echo '<td>';
                if ( $transaction['entered_by'] == 'Scheduled'){
                echo $transaction['customer_id'];
                }
                else
                {
                    echo "";
                }
                echo '</td>';
                if ($transaction['entered_by'] == 'Scheduled' ){
                if ( $transaction['customer_id']) {
                echo '<td>';
                echo strtoupper($userData[$transaction['customer_id']]);
                echo '</td>';
                }
                else {
                    echo '<td>';
                    echo " ";
                    echo '</td>';
                }
                }
                else {
                    echo '<td>';
                    echo '</td>';
                }
                echo '<td>';
              
                print_r(strtoupper($transaction['billing_address']['first_name'].' '.$transaction['billing_address']['last_name']));
                
                echo '</td>';
                echo '<td>';
                print_r('$ '.$transaction['authorization_amount']);
                echo '</td>';
                array_push($paymentCustomerIDSDetails,$transaction['customer_id']);
                array_push($paymentStatusInformation,$transaction['status']);
                if ( ( $transaction['status']=='rejected' ) || ($transaction['status'] == 'declined') ) {
                echo '<td> <font color="red">';
                print_r(strtoupper($transaction['status']));
                array_push($paymentStatusIDS, 2);
                echo '</font></td>';
                }
                else if (($transaction['status']=='settling')){
                    echo '<td> <font color="orange">';
                print_r(strtoupper($transaction['status']));
                array_push($paymentStatusIDS,8);
                echo '</font></td>';
                }
                else if ( $transaction['status'] == 'funded'){
                    echo '<td> <font color="green">';
                print_r(strtoupper($transaction['status']));
                array_push($paymentStatusIDS, 1);
                echo '</font></td>';
                }

                else if ( $transaction['status'] == 'refund') {
                        array_push($paymentStatusIDS, 4);
                }

                else if ( $transaction['status'] == 'in process') {
                        array_push($paymentStatusIDS, 3);
                }



                else if ( $transaction['status'] == 'declined') {
                        array_push($paymentStatusIDS, 5);
                }


                else if ( $transaction['status'] == 'un funded') {
                        array_push($paymentStatusIDS, 7);
                }

                else if ( $transaction['status'] == 'completed') {
                        array_push($paymentStatusIDS, 6);
                }

                else if ( $transaction['status'] == 'voided') {
                        array_push($paymentStatusIDS, 9);
                }

                if (($transaction['entered_by']) == 'Scheduled'){
                    echo '<td>';
                    strtoupper(print_r("Scheduled"));
                    echo '</td>';
                }
                else {
                    echo '<td>';
                    if ( $transaction['entered_by']=='Ezhkr7')
                    print_r("Krishna Yalamanchi");
                    else 
                        print_r("Entered by Customer API");
                    echo '</td>';
                }
                echo '<td>';
                echo date("Y-m-d",strtotime($transaction['origination_date']));
                echo '</td>';
                        
                if ( $transaction ['customer_id'] ){
                array_push($hoaIDS, $transaction ['customer_id']);
                }
                        else {
                            array_push($hoaIDS, -1);
                        }

                        array_push($homeIDS, $userData[$transaction['customer_id']]);
                        array_push($payment_type_ids, 1);
                        array_push($paymentAmount, $transaction['authorization_amount']);
                        if ( isset($_GET['date'])){
                        array_push($paymentProcessDate,$_GET['date']);
                        }
                        else {
                            array_push($paymentProcessDate,date("Y-m-d",strtotime($transaction['received_date'])));
                        }
                        array_push($paymentDocNum, $transaction['response']['authorization_code']);
                        array_push($paymentCommunity, 2);
                        array_push($paymentTransactionIDS, $transaction['transaction_id']);
                
                echo '</tr>';

            }

            $val = 0;
                $insertCount = 1;
                $updateCount = 0;
                foreach ($paymentAmount as $idS) {
                    if ($bankData[$paymentTransactionIDS[$val]]){
                        $update = "UPDATE current_payments SET payment_status_id=".$paymentStatusIDS[$val].",last_updated_on='".date("Y-m-d")."',transaction_balance=0 WHERE bank_transaction_id='".$paymentTransactionIDS[$val]."'";
                        pg_query($update);
                    }
                    else {
                        if ( $hoaIDS[$val] != -1) {
                           $payID = $hoaIDS[$val].$homeIDS[$val];
                            $query2 = "INSERT INTO current_payments(\"payment_id\",\"home_id\",\"payment_type_id\",\"amount\",\"process_date\",\"document_num\",\"community_id\",\"hoa_id\",\"referred_to_attorney\",\"payment_status_id\",\"transaction_balance\",\"last_updated_on\",\"email_notification_sent\",\"updated_by\",\"bank_transaction_id\") VALUES(".$payID.",".$homeIDS[$val].",".$payment_type_ids[$val].",".$paymentAmount[$val].",'".$paymentProcessDate[$val]."',".$paymentDocNum[$val].",".$paymentCommunity[$val].",".$hoaIDS[$val].",FALSE,".$paymentStatusIDS[$val].",".$paymentAmount[$val].",'".date("Y-m-d")."',TRUE,401,'".$paymentTransactionIDS[$val]."')";
                            try {
                            $result = pg_query($query2);
                            if (!$result) {
                                echo nl2br("\n");
                                print_r($query2);
                                echo nl2br("\n");
                                print_r("Payment Status".$paymentStatusInformation[$val]);
                                echo nl2br("\n");
                                print_r("Customer IDS ".$paymentCustomerIDSDetails[$val]."Customer Home ID = ".$userData[$paymentCustomerIDSDetails[$val]]);
                                echo nl2br("\n\n\n\n");
                            }
                            }
                            catch( Exception $ex ){
                                    print_r($query2);
                                    echo nl2br("\n");
                            }

                        }
                        else {
                            $url  = 'https://api.forte.net/v3/organizations/org_332536/locations/loc_190785/transactions/'.$paymentTransactionIDS[$val];
                            $ch = curl_init($url);
                                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','X-Forte-Auth-Organization-Id:org_332536','Authorization:Basic ZjNkOGJhZmY1NWM2OTY4MTExNTQ2OTM3ZDU0YTU1ZGU6Zjc0NzdkNTExM2EwNzg4NTUwNmFmYzIzY2U2MmNhYWU='));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                $result = curl_exec($ch);
                            $result = json_decode($result,TRUE);
                            curl_close($ch);
                            $hoaIDlocal = $result['xdata']['xdata_1'];
                            if ($hoaIDlocal){
                            $int = intval(preg_replace('/[^0-9]+/', '', $hoaIDlocal), 10);
                            }
                            else {
                                $hoaIDlocal = $result['echeck']['item_description'];
                                $int = intval(preg_replace('/[^0-9]+/', '', $hoaIDlocal), 10);
                            }

                            if ( $hoaIDlocal ){

                            }
                            else {
                                $email = $result['billing_address']['email'];
                                $hoaIDlocal = $userEmailsArray[$email];
                                $hoaIDlocal = (int)$hoaIDlocal;
                                $int = intval(preg_replace('/[^0-9]+/', '', $hoaIDlocal), 10);

                            }
                            $homeIDlocal = $userData[(int)($int)];
                            $payID = $int.$homeIDlocal;
                            if ( $hoaIDlocal){
                            $query2 = "INSERT INTO current_payments(\"payment_id\",\"home_id\",\"payment_type_id\",\"amount\",\"process_date\",\"document_num\",\"community_id\",\"hoa_id\",\"referred_to_attorney\",\"payment_status_id\",\"transaction_balance\",\"last_updated_on\",\"email_notification_sent\",\"updated_by\",\"bank_transaction_id\") VALUES(".$payID.",".$homeIDlocal.",".$payment_type_ids[$val].",".$paymentAmount[$val].",'".$paymentProcessDate[$val]."',".$paymentDocNum[$val].",".$paymentCommunity[$val].",".$int.",FALSE,".$paymentStatusIDS[$val].",".$paymentAmount[$val].",'".date("Y-m-d")."',TRUE,401,'".$paymentTransactionIDS[$val]."')";
                            
                            pg_query($query2);
                        }
                        else {
                            print_r("Problem with Transaction. Transactionid :".$paymentTransactionIDS[$val].nl2br("\n"));
                            
                        }
                        }

                    }
                    
                    $val  = $val + 1 ; 

                }

        }
        function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
        $scheduleUpdateQuery = "INSERT INTO SCHEDULED_JOBS(\"JOB_TITLE\",\"START_TIME\",\"RUN_BY\",\"IP_ADDRESS\") VALUES('SRSQ FORTE TRANSACTIONS','".date('Y-m-d H:i:s')."','MANUAL','".get_client_ip()."')";
        pg_query($scheduleUpdateQuery);
?>
        </tbody>
        </table>
        <script type="text/javascript">
            
            function updateDatabase() {
                window.alert("Some message");
           
            }
        </script>
        <br><br>
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

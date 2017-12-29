<?php

  ini_set("session.save_path","/var/www/html/session/");

  session_start();

?>

<!DOCTYPE html>
<html>
  <head>
    
    <?php

      include 'includes/dbconn.php';

      if(@!$_SESSION['hoa_username'])
      	header("Location: https://hoaboardtime.com/logout.php");

      $community_id = $_SESSION['hoa_community_id'];
      $user_id=$_SESSION['hoa_user_id'];

      $board = pg_num_rows(pg_query("SELECT * FROM board_committee_details WHERE user_id=$user_id AND community_id=$community_id"));

		  if($board == 0)
			 header("Location: https://hoaboardtime.com/residentDashboard.php");
      
      if($_SESSION['hoa_mode'] == 2)
        $_SESSION['hoa_mode'] = 1;

    ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <title><?php echo $_SESSION['hoa_community_name']; ?></title>
    
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="dist/js/googleanalytics.js"></script>

    <script type="text/javascript">
      var dimensionValue1 = "${userDetails.user.memberInfo.hoaId.hoaId}";
      var dimensionValue2 = "${communityInfo.communityCode}";
      if(<?php echo $community_id; ?> == 1)
        ga('create', 'UA-102881886-1', 'auto');
      else if(<?php echo $community_id; ?> == 2)
        ga('create', 'UA-102881886-2', 'auto');
      ga('set', 'dimension1', dimensionValue1);
      ga('set', 'dimension2', dimensionValue2);
      ga('send', 'pageview');
    </script>

  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    
    <div class="wrapper">

      <?php include 'boardHeader.php'; ?>
      
      <?php include 'boardNavigationMenu.php'; ?>

      <?php include 'zenDeskScript.php'; ?>

      <div class="content-wrapper">

        <?php

        	$year = date("Y");
        	$month = date("m");
        	$end_date = date("t");

        	$row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-$month-1' AND process_date<='$year-$month-$end_date'"));

        	$amount_recieved = $row['sum'];

          if($amount_recieved == "")
            $amount_recieved = 0.0;

        	$row = pg_fetch_assoc(pg_query("SELECT count(hoa_id) FROM hoaid WHERE community_id=$community_id"));

        	$total_customers = $row['count'];

        	$row = pg_fetch_assoc(pg_query("SELECT amount FROM assessment_amounts WHERE community_id=$community_id"));

        	$assessment_amount = $row['amount'];

        	$total_amount = ( $total_customers * $assessment_amount );
        	$amount_percentage = (( $amount_recieved / $total_amount ) * 100 );

        	$paid_customers = pg_num_rows(pg_query("SELECT DISTINCT hoa_id FROM current_payments WHERE community_id=$community_id AND payment_status_id=1 AND process_date>='$year-$month-1' AND process_date<='$year-$month-$end_date'"));

        	$paid_percentage = (( $paid_customers / $total_customers) * 100 );

        	$del_acc = 0;
          $del = 3;

          $del_amount = $assessment_amount * $del;

          $result = pg_query("SELECT home_id, sum(amount) FROM current_charges WHERE assessment_rule_type_id=1 AND community_id=$community_id GROUP BY home_id ORDER BY home_id");

          while($row = pg_fetch_assoc($result))
          {

            $home_id = $row['home_id'];
            $assessment_charges = $row['sum'];

            $query2 = "SELECT hoa_id, firstname, lastname, cell_no, email FROM hoaid WHERE home_id=".$home_id;
            $result2 = pg_query($query2);
            $row2 = pg_fetch_assoc($result2);

            $firstname = $row2['firstname'];
            $lastname = $row2['lastname'];
            $hoa_id = $row2['hoa_id'];
            $cell_no = $row2['cell_no'];
            $email = $row2['email'];

            $query2 = "SELECT sum(amount) FROM current_charges WHERE hoa_id=".$hoa_id;
            $result2 = pg_query($query2);
            $row2 = pg_fetch_assoc($result2);
            $charges = $row2['sum'];

            $query2 = "SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND hoa_id=".$hoa_id;
            $result2 = pg_query($query2);
            $row2 = pg_fetch_assoc($result2);
            $payments = $row2['sum'];

            $balance = $charges - $payments;

            $query2 = "SELECT address1 FROM homeid WHERE home_id=".$home_id;
            $result2 = pg_query($query2);
            $row2 = pg_fetch_assoc($result2);
            $address1 = $row2['address1'];

            if($del_amount <= ($assessment_charges - $payments) && $balance >= $del_amount)
              $del_acc++;

          }

          $result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND document_to!=';' AND agreement_status='SIGNED'");
          $signed_agreements = pg_num_rows($result);

          $result = pg_query("SELECT * FROM community_sign_agreements WHERE community_id=$community_id AND document_to!=';' AND agreement_status='OUT_FOR_SIGNATURE'");
          $pending_agreements = pg_num_rows($result);

          $inspections = 0;

          $result = pg_query("SELECT * FROM inspection_notices WHERE community_id=$community_id");

          while($row = pg_fetch_assoc($result))
          {
            $status = $row['inspection_status_id'];

            if($status != 2 && $status != 6 && $status != 9 && $status != 14 && $status != 13)
              $inspections++;
          }

          $deposits = pg_num_rows(pg_query("SELECT * FROM community_deposits WHERE community_id=$community_id"));

          $settling_customers = pg_num_rows(pg_query("SELECT * FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-1' AND process_date<='$year-$month-$end_date' AND payment_status_id=8"));

          $ress = pg_query("UPDATE reminders SET reminder_status_id=2 WHERE reminder_status_id=1 AND due_date<='".date('Y-m-d')."'");

        ?>
        
        <section class="content-header">

          <h1><strong>Finance Dashboard</strong><small> - <?php echo date("F").", ".$year; ?></small></h1>

          <ol class="breadcrumb">
            
            <li><i class="fa fa-dollar"></i> Finance Dashboard</li>
          
          </ol>

        </section>

        <section class="content">
          
          <div class="row">

          	<section class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
            
	            <div class="box box-info">
	                
	                <div class="box-header">
	                  
	                  	<i class="fa fa-pie-chart"></i>

	                  	<h3 class="box-title">Payment Status</h3>
	                  
	                  	<div class="pull-right box-tools">
	                    
	                    	<button type="button" class="btn btn-info btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>

	                  	</div>
	                  
	                </div>

	                <div class="box-body container-fluid" style='text-align: justify;'>
	                  
                    <div class='row container-fluid'>
	                    
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center" style="border-right: 1px solid #f4f4f4">
	                  
	                  		<a href="boardCurrentMonthAmountRecieved.php">
	                  		 
                         <input type="text" class="knob" data-thickness="0.2" value="<?php if($amount_percentage < 100) echo round($amount_percentage, 1); else echo "100"; ?>" data-width="100" data-height="100" data-fgColor="#00c0ef" data-readonly="true">

	                  		 <div class="knob-label" style="font-size: 15pt;"><strong>Amount Received</strong><sup>( % )</sup></div>
	                  		
                        </a>

	                	  </div>

	                	  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
	                  
	                  		<a href='boardCurrentMonthPaidMembers.php'>
	                  		
                          <input type="text" class="knob" data-thickness="0.2" value="<?php echo round($paid_percentage, 1); ?>" data-width="100" data-height="100" data-fgColor="#00c0ef" data-readonly="true">

	                  		 <div class="knob-label" style="font-size: 15pt;"><strong>Members Paid</strong><sup>( % )</sup></div>
	                  		
                        </a>

	                	  </div>

                    </div>

                    <br><br>

                    <div class='row text-center container-fluid'>

                      <a href='https://hoaboardtime.com/boardHomePayMethod.php'>
                      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3"  style="border: solid; border-right: none;">

                        <strong>ACH : <?php $row=pg_fetch_assoc(pg_query("SELECT count(home_id) FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=1")); $ach = $row['count']; echo $ach; ?></strong>

                      </div>

                      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border: solid; border-right: none; border-left: none;">

                        <strong>BillPay : <?php $row=pg_fetch_assoc(pg_query("SELECT count(home_id) FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=2")); $billpay = $row['count']; echo $billpay; ?></strong>

                      </div>

                      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border: solid; border-right: none; border-left: none;">

                        <strong>Check : <?php $row=pg_fetch_assoc(pg_query("SELECT count(home_id) FROM home_pay_method WHERE community_id=$community_id AND payment_type_id=3")); $check = $row['count']; echo $check; ?></strong>

                      </div>

                      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3" style="border: solid; border-left: none;">

                        <strong>Others : <?php echo $total_customers-$ach-$billpay-$check; ?></strong>

                      </div>
                      </a>

                    </div>

	                </div>

	            </div>

            </section>

            <section class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
            
	            <div class="info-box">
                  
                <div class='row container-fluid text-center'>

                  <br>

                  <span class="info-box-text"><strong>Bank Account Balance</strong></span>

                  <br>

                </div>
                      	
                <div class="row text-center">

                  <?php 

                    if($community_id == 1)
                    { 
                      
                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/77?minorversion=8');      
                      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="jzXGHD9VKI6fxwrXaWg90HQgFuI%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
                      $result = curl_exec($ch);
                      $json_decode = json_decode($result,TRUE);
                      $srp_primarySavings = $json_decode['Account'];
                      $srp_current_balance = $srp_primarySavings['CurrentBalance'];
                            
                      curl_close($ch);

                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145854171542/account/74?minorversion=8');      
                            
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprd0JzDPeMNuATqXcic8hnusenW2",oauth_token="qyprdxuMeT1noFaS5g6aywjSOkFQo16WnvwigzPbxQ01LPYF",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1508539532",oauth_nonce="2nX9kd69aNw",oauth_version="1.0",oauth_signature="5ZScoTRHF28D3YT0kHO27%2Br8Hvo%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                            
                      $result2 = curl_exec($ch);
                      $json_decode2 = json_decode($result2,TRUE);
                      $srp = $json_decode2['Account'];
                      $srp_savings_balance = $srp['CurrentBalance'];

                      echo "<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>Savings</div><div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>Checkings</div></div><div class='row text-center'>";

                      echo "<div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><strong><a href='https://hoaboardtime.com/boardCommunityDeposits.php'>$ ".$srp_savings_balance."</a></strong></div><div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'><strong><a href='https://hoaboardtime.com/boardCommunityDeposits.php'>$ ".$srp_current_balance."</a></strong></div>";
                    }
                    else if($community_id == 2)
                    {
                      
                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/33?minorversion=8');      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506682054",oauth_nonce="skPZikoZJCt",oauth_version="1.0",oauth_signature="aEBIdXcJdXSWiLp5k9gxlVuvsbs%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                      $result = curl_exec($ch);
                      $json_decode = json_decode($result,TRUE);
                      $srp_primarySavings = $json_decode['Account'];
                      $srp_primary_Savings_CurrentBalance = $srp_primarySavings['CurrentBalance'];

                      curl_close($ch);

                      $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/32?minorversion=8');      
                      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="5IDpz%2F%2FItyjMYbh4Ke3JoBx3YGY%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                      $result2 = curl_exec($ch);
                      $json_decode2 = json_decode($result2,TRUE);
                      $srp = $json_decode2['Account'];
                      $srp_savings = $srp['CurrentBalance'];

                      curl_close($ch);

                      $ch  = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/account/31?minorversion=8');
                      
                      curl_setopt($ch, CURLOPT_CUSTOMREQUEST , 'GET');
                      curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1506681985",oauth_nonce="H7DXVHb2Qdp",oauth_version="1.0",oauth_signature="HDWt%2BfIz3NrAhJE9fO9G%2FI8Q%2Fcg%3D"'));
                      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

                      $result3 = curl_exec($ch);
                      $json_decode3 = json_decode($result3,TRUE);
                      $srsq_third_Account = $json_decode3['Account'];
                      $srsq_third_Account_Balance = $srsq_third_Account['CurrentBalance'];

                      echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>Checkings</div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>Savings</div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>Investments</div></div><div class='row text-center'>";

                      echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong><a href='https://hoaboardtime.com/boardCommunityDeposits.php'>$ ".$srp_primary_Savings_CurrentBalance."</a></strong></div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong><a href='https://hoaboardtime.com/boardCommunityDeposits.php'>$ ".$srp_savings."</a></strong></div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong><a href='https://hoaboardtime.com/boardCommunityDeposits.php'>$ ".$srsq_third_Account_Balance."</a></strong></div>";
                    }

                    $documents = pg_num_rows(pg_query("SELECT * FROM document_management WHERE community_id=$community_id"));

                  ?>

                  <br><br>
                  
                </div>

              </div>

              <div class="info-box">
                  
                <div class='row container-fluid text-center'>

                  <br>

                  <span class="info-box-text"><strong>Payment Information</strong> - <?php echo date('F').", ".date('Y'); ?></span>

                  <br>

                </div>
                        
                <div class="row text-center">

                  <?php 

                    echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>Amount<br>Received</div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>Paid<br>Customers</div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'>Settling<br>Payments</div></div><div class='row text-center'>";

                    echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong><a href='https://hoaboardtime.com/boardCurrentMonthAmountRecieved.php'>$ ".$amount_recieved."</a></strong></div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong><a href='https://hoaboardtime.com/boardCurrentMonthPaidMembers.php'>".$paid_customers."</a></strong></div><div class='col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4'><strong><a href='https://hoaboardtime.com/boardCurrentMonthSettlingMembers.php'>".$settling_customers."</a></strong></div>";
                  ?>

                  <br><br>
                  
                </div>

              </div>

            </section>

          </div>

          <div class="row container-fluid" style="background-color: #ffffff;">

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <div class="row container-fluid">

                <br>

                <div class="row container-fluid text-left">

                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                    <?php

                      $total_needed = $assessment_amount * 12 * $total_customers;

                      $row = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE payment_status_id=1 AND community_id=$community_id"));
                      $total_received = $row['sum'];

                    ?>

                    <h1 class="text-info"><strong><?php echo round((($total_received/$total_needed)*100), 2); ?>%</strong></h1>

                  </div>

                </div>

                <div class="row container-fluid text-center">

                  <h5><strong>Amount Received (<?php echo $year; ?>)</strong></h5>

                </div>

                <br>

              </div>

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCommunityDeposit.php'-->

                <div class="row container-fluid">

                  <br>

                  <div class="row container-fluid text-left">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCommunityDeposit.php'>

                        <h1 class="text-info"><strong><?php echo $deposits; ?></strong></h1>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Community Deposits</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCommunityDocuments.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCommunityDocuments.php'>

                        <h1 class="text-info"><strong><?php echo $documents; ?></strong></h1>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Community Documents</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardDelinquentAccounts.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardDelinquentAccounts.php'>

                        <?php 

                          if($del_acc == 0 || $del_acc == "")
                            echo "<h1 class='text-green'><strong>".$del_acc."</strong></h1>"; 
                          else
                            echo "<h1 class='text-red'><strong>".$del_acc."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Delinquent Accounts</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardViolationHomes.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardViolationHomes.php'>

                        <?php 

                          $inspection_homes = 0;
                          $res = pg_query("SELECT DISTINCT home_id FROM inspection_notices WHERE community_id=$community_id");

                          while ($r = pg_fetch_assoc($res)) 
                          {
                            $status = $r['inspection_status_id'];

                            if($status != 2 && $status != 6 && $status != 9 && $status != 14 && $status != 13)
                              $inspection_homes++;
                          }

                          if($inspection_homes > 0)
                            echo "<h1 class='text-orange'><strong>".$inspection_homes."</strong></h1>"; 
                          else
                            echo "<h1 class='text-green'><strong>".$inspection_homes."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Inspection Homes</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardViolationCitations.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardViolationCitations.php'>

                        <?php 

                          if($inspections > 0)
                            echo "<h1 class='text-orange'><strong>".$inspections."</strong></h1>"; 
                          else
                            echo "<h1 class='text-green'><strong>".$inspections."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Inspection Notices</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCurrentMonthLatePayments.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCurrentMonthLatePayments.php'>

                        <?php 
                          
                          $result = pg_query("SELECT distinct home_id FROM current_payments WHERE payment_status_id=1 AND community_id=".$community_id." AND process_date>='$year-$month-16' AND process_date<='$year-$month-$end_date'");
                          $late = pg_num_rows($result);

                          if($late > 0)
                            echo "<h1 class='text-orange'><strong>".$late."</strong></h1>"; 
                          else
                            echo "<h1 class='text-green'><strong>".$late."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Late Payments - <?php echo date("F"); ?></strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardParkingTags.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardParkingTags.php'>

                        <?php 

                          $row = pg_num_rows(pg_query("SELECT * FROM home_tags WHERE community_id=$community_id AND type=1"));

                          echo "<h1 class='text-info'><strong>".$row."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Parking Tags</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCommunityPendingAgreements.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCommunityPendingAgreements.php'>

                        <?php 

                          if($pending_agreements > 0)
                            echo "<h1 class='text-orange'><strong>".$pending_agreements."</strong></h1>"; 
                          else
                            echo "<h1 class='text-green'><strong>".$pending_agreements."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Pending Agreements</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCurrentMonthPendingPayments.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCurrentMonthPendingPayments.php'>

                        <?php 

                          $pending = 0;

                          $result = pg_query("SELECT * FROM homeid WHERE community_id=$community_id AND home_id NOT IN (SELECT home_id FROM current_payments WHERE community_id=$community_id AND process_date>='$year-$month-1' AND process_date<='$year-$month-$end_date')");

                          while($row = pg_fetch_assoc($result))
                          {

                            $home_id = $row['home_id'];
                            
                            $row1 = pg_fetch_assoc(pg_query("SELECT * FROM hoaid WHERE home_id=$home_id"));

                            $hoa_id = $row1['hoa_id'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_charges WHERE hoa_id=$hoa_id AND home_id=$home_id"));
                            $charges = $row1['sum'];

                            $row1 = pg_fetch_assoc(pg_query("SELECT sum(amount) FROM current_payments WHERE hoa_id=$hoa_id AND home_id=$home_id"));
                            $payments = $row1['sum'];

                            $balance = $charges - $payments;

                            if($balance > 0)
                              $pending++;
                              
                          }

                          if($pending > 0)
                            echo "<h1 class='text-orange'><strong>".$pending."</strong></h1>"; 
                          else
                            echo "<h1 class='text-green'><strong>".$pending."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Pending Payments</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCurrentMonthPrePaidMembers.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCurrentMonthPrePaidMembers.php'>

                        <?php

                          $ma = 0 - $assessment_amount;

                          $result = pg_query("SELECT h.home_id FROM homeid h WHERE community_id=$community_id AND (SELECT sum(amount) FROM current_charges WHERE home_id=h.home_id)-(SELECT sum(amount) FROM current_payments WHERE home_id=h.home_id AND payment_status_id=1)<=$ma");

                          $rows = pg_num_rows($result);

                          if($rows > 0)
                            echo "<h1 class='text-orange'><strong>".$rows."</strong></h1>"; 
                          else
                            echo "<h1 class='text-green'><strong>".$rows."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Pre-Paid Members</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">

              <!--a href='https://hoaboardtime.com/boardCommunitySignedAgreements.php'-->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                      <a href='https://hoaboardtime.com/boardCommunitySignedAgreements.php'>

                        <?php 

                          if($pending_agreements > 0)
                            echo "<h1 class='text-green'><strong>".$signed_agreements."</strong></h1>"; 
                          else
                            echo "<h1 class='text-info'><strong>".$signed_agreements."</strong></h1>";

                        ?>

                      </a>

                    </div>

                  </div>

                  <div class="row container-fluid text-center">

                    <h5><strong>Signed Agreements</strong></h5>

                  </div>

                  <br>

                </div>

              <!--/a-->

            </div>

            <br>

          </div>

        </section>

        <section class="content-header">

          <h1><strong>QuickBooks Reports</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">

          <div class="row container-fluid">

            <?php
        
              $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLoss?minorversion=8');
              
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
              curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="z5lf3IXAgwz5xXVG11yFEYKkvqw%3D"'));
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

              $profitandloss = curl_exec($ch);
              $jsonprofitandloss = json_decode($profitandloss,TRUE);
              $data = $jsonprofitandloss['Rows']['Row'];

              foreach ($data as $key ) {

                foreach ($key['Summary'] as $Summary) {
                  
                  $count = 0;
                  
                  foreach ($Summary as $summary) {
    
                    if ($summary['value'] == 'Total Revenue') {
                      
                      $count = 1;
                      continue;

                    }
                    if ( $count == 1 ) {
                      
                      $income = $summary['value'];
                      continue;

                    } 

                    if ( $summary['value'] == 'Total Expenditures') {
                      
                      $count = 2;
                      continue;

                    }

                    if ( $count == 2) {
                      
                      $expenditure = $summary['value'];
                      continue;

                    }

                    if ( $summary['value'] == 'Net Revenue') {
                      
                      $count = 3;
                      continue;

                    }

                    if ( $count == 3) {
                      
                      $revenue = $summary['value'];
                      continue;

                    }

                    if ( $summary['value'] == 'Total Office Supplies & Software'){
                      
                      $count = 4;
                      continue;

                    }
                    if( $count == 4) {
                      
                      $officetotal = $summary['value'];
                      continue;

                    }

                  }

                }

                foreach ($key['Rows'] as $allRows) {
                  
                  foreach ($allRows as $individualRows) {
  
                    foreach ($individualRows as $colData) {
      
                      foreach ($colData as $keyColData) {
                        
                        $count = 0;
         
                        foreach ($keyColData as $keyColData2) {
           
                          if ( $keyColData2['value'] == 'Total 6410 Office/General Administrative Expenses') {
                            
                            $count = 1;
                            continue;

                          }
                          else if ( $keyColData2['value'] == 'Total 5420 Repairs & Maintenance') {
                            
                            $count = 2;
                            continue;

                          }

                          if ( $count == 2 ){
                            
                            $repair = $keyColData2['value'];
                            $count = 0;
                            continue;

                          }

                          if ( $count == 1) {
            
                            $officegeneral = $keyColData2['value'];
                            $count = 0;
                            continue;
                          
                          }
                        
                        }
                      
                      }  
      
                    }
                  
                  }

                }
              
              }
            
            ?>

            <section style="background-color: white;">

              <br>
            
              <div class="row container-fluid">
                
                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12' style="border-right: 1px solid #f4f4f4">

                  <div class='row text-center container-fluid'>

                    <h4><strong>Income vs Expenditure</strong></h4>

                  </div>

                  <br>

                  <div class='row text-center container-fluid'>

                    <canvas id="myChart3"></canvas>

                  </div>

                  <br>

                  <div class='row text-center container-fluid'>
                    
                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6' style="border-right: 1px solid #f4f4f4">
                    
                      <a href="https://hoaboardtime.com/boardCommunityDeposits.php" title='Click to view community deposits'><h5>INCOME : <b>$ <?php echo round($income, 0); ?></b></h5></a>

                    </div>

                    <div class='col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6'>
                    
                      <a href='https://hoaboardtime.com/boardCommunityExpenditureSummary.php' title='Click to view expenditure summary'><h5>EXPENDITURE : <b>$ <?php echo round($expenditure, 0); ?></b></h5></a>

                    </div>

                  </div>

                </div>

                <div class='col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12'>

                  <div class='row text-center container-fluid'>

                    <h4><strong>Top 3 Spendings</strong></h4>

                  </div>

                  <br>

                  <div class='row text-center container-fluid' >

                    <canvas id="myChart4"></canvas>

                  </div>

                  <br>

                  <div class='row text-center container-fluid'>
                    
                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12' style="border-right: 1px solid #f4f4f4">
                    
                      <h5>5420 Repair &amp; Maintainance : <b style="color: black;">$ <?php echo round($repair, 0); ?></b></h5>

                    </div>

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12' style="border-right: 1px solid #f4f4f4">
                    
                      <h5>6410 Office/General Administrative Expenses : <b style="color: black;">$ <?php echo round($officegeneral, 0); ?></b></h5>

                    </div>

                    <div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12'>
                    
                      <h5>Others : <b style="color: black;">$ <?php echo round($expenditure - ($officegeneral+$repair), 0); ?></b></h5>

                    </div>

                  </div>

                </div>
              
              </div>

              <br>

              <?php

                $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/query?minorversion=8');
                
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="qyprdwVPs6UkPK3Xrpe9XMGvlGdJa6EUg0s65QPt2Cgsr14v",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="XuTqhe0Pc3l6ByJNHpbyp1P8W0k%3D"'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "Select * from CompanyInfo");
                
                $companyInfo = curl_exec($ch);
                
                curl_close($ch);
                
                $companyInfo = json_decode($companyInfo,TRUE);
                $companyInfo  = $companyInfo['QueryResponse'];
                $companyInfo = $companyInfo['CompanyInfo'];
                
                curl_close($ch);
              
                $ch = curl_init('https://quickbooks.api.intuit.com/v3/company/123145844183384/reports/ProfitAndLossDetail?minorversion=8');
                
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent:Intuit-qbov3-postman-collection1','Content-Type:application/text','Content-Type:application/text','Accept:application/json','Authorization:OAuth oauth_consumer_key="qyprdRAm244oPXhP3miXslnVdpDfWF",oauth_token="lvprdiCkEnJlsgkPzDkDsjOm2FUoYTc3zHCb41tu6wjN21AP",oauth_signature_method="HMAC-SHA1",oauth_timestamp="1492203509",oauth_nonce="Q2Ck7t",oauth_version="1.0",oauth_signature="dF10iisxl3QVmuZhGLd4pIA9GAQ%3D"'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                
                $result = curl_exec($ch);
                $json_Decode = json_decode($result,TRUE);
                $header = $json_Decode['Header'];
                $startDate  = $header['StartPeriod'];
                $endDate = $header['EndPeriod'];
                $startDate = strtotime($startDate);
                $endDate = strtotime($endDate);
                $startDate = date('F jS ',$startDate);
                $endDate = date('F jS, Y',$endDate);
                
                curl_close($ch);

              ?>

              <br>

            </section>

          </div>

          <script>
            
            var ctx = document.getElementById("myChart3");
            ctx.width  = 2;
            ctx.height = 1;
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: [
                      "INCOME ($)",
                      "EXPENDITURE ($)"
                  ],
                  datasets: [
                      {
                          data: [<?php echo round($income, 0); ?>, <?php echo round($expenditure, 0); ?>],
                          backgroundColor: [
                              "green",
                              "orange"
                          ]
                      }]
              },
                options: {
                        legend:{
                          position:'right'
                        },
                        cutoutPercentage:70,
                        animation:{
                            animateScale:true
                        }
                    }
            });

            $(document).ready( 
                function () {
                    var ctx = document.getElementById("myChart3").getContext("2d");
                    var myNewChart = new Chart(ctx).Pie(data);

                    $("#myChart3").click( 
                        function(evt){
                            var activePoints = myNewChart.getSegmentsAtEvent(evt);
                            var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
                            alert(url);
                        }
                    );                  
                }
            );

          </script>

          <script>
            
            var ctx = document.getElementById("myChart4");
            ctx.width  = 2;
            ctx.height = 1;
            var myDoughnutChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                  labels: [
                      "5420 Repair & Maintainance ($)",
                      "6410 Office/General Administrative Expenses ($)",
                      "Others ($)"
                  ],
                  datasets: [
                      {
                          data: [<?php echo round($repair, 0); ?>, <?php echo round($officegeneral, 0); ?>, <?php echo round($expenditure - ($officegeneral+$repair), 0); ?>],
                          backgroundColor: [
                              "rgba(75, 192, 192, 99)",
                              "rgba(143, 102, 144, 99)",
                              "rgba(153, 102, 255, 99)"
                          ]
                      }]
              },
                options: {
                        legend:{
                          position:'right'
                        },
                        cutoutPercentage:70,
                        animation:{
                            animateScale:true
                        }
                    }
            });

          </script>

        </section>

        <section class="content-header">

          <h1><strong>Reserves Dashboard</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">

          <div class="row container-fluid" style="background-color: #ffffff;">

            <br>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a ><!-- href='https://hoaboardtime.com/boardCommunityAssets.php' -->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="pending_payments.png" height=75 width=75 alt='Number of Assets'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr>
                    <h4><strong>Add New Asset</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a ><!-- href='https://hoaboardtime.com/boardCommunityAssets.php' -->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="pending_payments.png" height=75 width=75 alt='Recommended Reserve Allocation'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND fisc_yr_end<='$year-12-31'"));

                        $minimum_monthly_allocation_units = $row['min_mthly_alloc_unit'];
                        $cur_bal_vs_ideal_bal = $row['cur_bal_vs_ideal_bal'];

                        $reserve_allocation = $minimum_monthly_allocation_units * $month;

                        $reserve_allocation = round($reserve_allocation, 0);

                        if($cur_bal_vs_ideal_bal >= 70)
                          echo "<h3 class='text-orange'><strong>$ ".$reserve_allocation."</strong></h3>";
                        else
                          echo "<h3 class='text-red'><strong>$ ".$reserve_allocation."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr style="color: white;">
                    <h4><strong>Minimum Reserve Allocation</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a ><!-- href='https://hoaboardtime.com/boardCommunityAssets.php' -->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="pending_payments.png" height=75 width=75 alt='Minimum Reserve Allocation'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id AND fisc_yr_end<='$year-12-31'"));

                        $recommended_monthly_allocation_units = $row['rec_mthly_alloc_unit'];
                        $cur_bal_vs_ideal_bal = $row['cur_bal_vs_ideal_bal'];

                        $reserve_allocation = $recommended_monthly_allocation_units * $month;

                        $reserve_allocation = round($reserve_allocation, 0);

                        if($cur_bal_vs_ideal_bal >= 70)
                          echo "<h3 class='text-green'><strong>$ ".$reserve_allocation."</strong></h3>";
                        else
                          echo "<h3 class='text-orange'><strong>$ ".$reserve_allocation."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr style="color: white;">
                    <h4><strong>Recommended Reserve Allocation</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/boardReserveRepairs.php'>

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="pending_payments.png" height=75 width=75 alt='Reserve Repairs'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $row = pg_fetch_assoc(pg_query("SELECT sum(invoice_amount) FROM community_invoices WHERE reserve_expense='t' AND community_id=$community_id"));

                        $repairs = $row['sum'];

                        $repairs = round($repairs, 0);

                        if($repairs > 0)
                          echo "<h3><strong>$ ".$repairs."</strong></h3>";
                        else
                          echo "<h3><strong>$ ".$repairs."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr style="color: white;">
                    <h4><strong>Reserve Repairs</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a ><!-- href='https://hoaboardtime.com/boardCommunityAssets.php' -->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="pending_payments.png" height=75 width=75 alt='Reserves Funded'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $row = pg_fetch_assoc(pg_query("SELECT * FROM community_reserves WHERE community_id=$community_id"));

                        $res_funded = $row['cur_bal_vs_ideal_bal'];

                        if($res_funded > 0)
                          echo "<h3 class='text-green'><strong>".$res_funded."%</strong></h3>"; 
                        else
                          echo "<h3 class='text-info'><strong>".$res_funded."%</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr style="color: white;">
                    <h4><strong>Reserves Funded</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a href='https://hoaboardtime.com/boardViewCommunityAssets.php'><!-- href='https://hoaboardtime.com/boardCommunityAssets.php' -->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="community_assets.png" height=75 width=75 alt='Number of Assets'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      <?php 

                        $no_assets = pg_num_rows(pg_query("SELECT * FROM community_assets WHERE community_id=$community_id"));

                        if($no_assets > 0)
                          echo "<h3 class='text-green'><strong>".$no_assets."</strong></h3>"; 
                        else
                          echo "<h3 class='text-info'><strong>".$no_assets."</strong></h3>";

                      ?>

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr>
                    <h4><strong>Total # of Assets</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">

              <a ><!-- href='https://hoaboardtime.com/boardCommunityAssets.php' -->

                <div class="row container-fluid text-left">

                  <br>

                  <div class="row container-fluid">

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">

                      <img src="update_assets.png" height=75 width=75 alt='Update Assets'>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 text-left">

                      

                    </div>

                  </div>

                  <div class="row container-fluid text-left">

                    <hr>
                    <h4><strong>Update Assets</strong></h4>

                  </div>

                  <br>

                </div>

              </a>

            </div>

            <br>

          </div>

        </section>

        <section class="content-header">

          <h1><strong><?php echo $year; ?> Yearly Statistics</strong><small> - <?php echo $_SESSION['hoa_community_name']; ?></small></h1>

        </section>

        <section class="content">

          <div class="row container-fluid">

            <section style="background-color: white;">

              <br>
            
              <div class="row container-fluid">
                
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12" style="border-right: 1px solid #f4f4f4">
                      
                  <canvas id="myChart1"></canvas>

                </div>
                  
                <div class="col-lg-6 col-xl-6 col-md-6 col-xs-12">
                      
                  <canvas id="myChart2"></canvas>

                </div>

              </div>

              <br>

            </section>

            <!--My Chart 1-->
            <script>
              var ctx = document.getElementById("myChart1");
              ctx.width  = 1;
              ctx.height = 1;
              var myChart = new Chart(ctx, {
              
              type: 'bar',
              data: {
                  labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                  datasets: [{
                    label: ' Amount Received ($) ',
                    data: [<?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-01-01' AND process_date<='".$y."-01-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); if($y%4 == 0) $da=29; else $da=28; $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-02-01' AND process_date<='".$y."-02-".$da."'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-03-01' AND process_date<='".$y."-03-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-04-01' AND process_date<='".$y."-04-30'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-05-01' AND process_date<='".$y."-05-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-06-01' AND process_date<='".$y."-06-30'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-07-01' AND process_date<='".$y."-07-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-08-01' AND process_date<='".$y."-08-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-09-01' AND process_date<='".$y."-09-30'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-10-01' AND process_date<='".$y."-10-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-11-01' AND process_date<='".$y."-11-30'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>, <?php $y = date("Y"); $result = pg_query("SELECT sum(amount) FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-12-01' AND process_date<='".$y."-12-31'"); $row = pg_fetch_assoc($result); echo $row['sum']; ?>],
                    backgroundColor: [
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                  }, 
                  {
                    label: 'Amount to be Received ($)',
                    data: [<?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>, <?php echo $total_amount; ?>],
                    borderColor: "rgba(100,100,255,100)",
                    // Changes this dataset to become a line
                    type: 'line'
                  }]
              },
              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                            beginAtZero:true
                        }
                    }]
                  }
                }
              });
            </script>

            <!--My Chart 2-->
            <script>
              var ctx = document.getElementById("myChart2");
              ctx.width  = 1;
              ctx.height = 1;
              var myRadarChart = new Chart(ctx, {
                  type: 'radar',
                  data: {
                      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                      datasets: [{
                          label: 'Paid Customers',
                          data: [<?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-01-01' AND process_date<='".$y."-01-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); if($y%4 == 0) $da=29; else $da=28; $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-02-01' AND process_date<='".$y."-02-".$da."'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-03-01' AND process_date<='".$y."-03-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-04-01' AND process_date<='".$y."-04-30'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-05-01' AND process_date<='".$y."-05-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-06-01' AND process_date<='".$y."-06-30'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-07-01' AND process_date<='".$y."-07-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-08-01' AND process_date<='".$y."-08-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-09-01' AND process_date<='".$y."-09-30'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-10-01' AND process_date<='".$y."-10-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-11-01' AND process_date<='".$y."-11-30'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>, <?php $y = date("Y"); $result = pg_query("SELECT DISTINCT home_id FROM current_payments WHERE community_id=".$community_id." AND payment_status_id=1 AND process_date>='".$y."-12-01' AND process_date<='".$y."-12-31'"); $row = pg_num_rows($result); if($row != 0) echo $row; ?>],
                          fill: false,
                          pointStyle: 'circle',
                          pointBackgroundColor: 'green',
                          borderColor: '#BCF5A9'
                      },
                      {
                          label: 'Total Customers',
                          data: [<?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>, <?php echo $total_customers; ?>],
                          fill: false,
                          pointStyle: 'circle',
                          pointBackgroundColor: 'orange',
                          borderColor: '#F3E2A9'
                      }]
                  }
              });
            </script>

          </div>

        </section>

      </div>

      <?php include "footer.php"; ?>

      <div class="control-sidebar-bg"></div>

    </div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="plugins/knob/jquery.knob.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/pages/dashboard.js"></script>
    <script src="dist/js/demo.js"></script>

  </body>

</html>